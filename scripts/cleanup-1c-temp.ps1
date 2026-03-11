[CmdletBinding()]
param()

$ErrorActionPreference = 'Stop'
$script:FailedItems = New-Object System.Collections.Generic.List[string]

function Add-FailedItem {
    param(
        [Parameter(Mandatory = $true)]
        [string]$Path,

        [Parameter(Mandatory = $true)]
        [string]$Reason
    )

    $script:FailedItems.Add("$Path :: $Reason") | Out-Null
}

function Get-SelectionFromMenu {
    param(
        [Parameter(Mandatory = $true)]
        [System.Collections.IList]$Items,

        [Parameter(Mandatory = $true)]
        [string]$Title
    )

    if ($Items.Count -eq 0) {
        throw "Список для выбора пуст: $Title"
    }

    Write-Host "`n$Title"
    for ($i = 0; $i -lt $Items.Count; $i++) {
        $item = $Items[$i]
        Write-Host ("[{0}] {1}" -f ($i + 1), $item.Display)
    }

    while ($true) {
        $rawChoice = Read-Host "Введите номер (1-$($Items.Count))"
        $choice = 0

        if ([int]::TryParse($rawChoice, [ref]$choice) -and $choice -ge 1 -and $choice -le $Items.Count) {
            return $Items[$choice - 1].Value
        }

        Write-Warning 'Некорректный ввод. Попробуйте снова.'
    }
}

function Remove-UnwantedChildren {
    param(
        [Parameter(Mandatory = $true)]
        [string]$Path,

        [Parameter(Mandatory = $true)]
        [string[]]$AllowedNames,

        [Parameter(Mandatory = $true)]
        [string]$Label
    )

    Write-Host "`n[$Label] Проверка: $Path"

    try {
        if (-not (Test-Path -LiteralPath $Path)) {
            Write-Warning "Путь не найден, пропускаю: $Path"
            return
        }
    }
    catch {
        $reason = $_.Exception.Message
        Write-Warning "Нет доступа к пути, пропускаю: $Path`
Причина: $reason"
        Add-FailedItem -Path $Path -Reason $reason
        return
    }

    try {
        $children = Get-ChildItem -LiteralPath $Path -Force
    }
    catch {
        $reason = $_.Exception.Message
        Write-Warning "Не удалось прочитать содержимое, пропускаю: $Path`
Причина: $reason"
        Add-FailedItem -Path $Path -Reason $reason
        return
    }

    $toRemove = $children | Where-Object {
        $isAllowedByName = $_.Name -in $AllowedNames
        $isPflFile = -not $_.PSIsContainer -and $_.Extension -ieq '.pfl'
        -not ($isAllowedByName -or $isPflFile)
    }

    if (-not $toRemove) {
        Write-Host "[$Label] Лишних объектов не найдено."
        return
    }

    Write-Host "[$Label] Будут удалены:" -ForegroundColor Yellow
    $toRemove | ForEach-Object {
        Write-Host (" - {0}" -f $_.FullName)
    }

    $removedCount = 0
    foreach ($item in $toRemove) {
        try {
            Remove-Item -LiteralPath $item.FullName -Recurse -Force
            $removedCount++
        }
        catch {
            $reason = $_.Exception.Message
            Write-Warning "Не удалось удалить: $($item.FullName)`
Причина: $reason"
            Add-FailedItem -Path $item.FullName -Reason $reason
            continue
        }
    }

    Write-Host "[$Label] Очистка завершена. Удалено: $removedCount из $($toRemove.Count)"
}

Write-Host 'Очистка временных папок 1C (Local/Roaming\1C\1cv8)' -ForegroundColor Cyan

$computerName = Read-Host 'Введите имя ПК (например, ARM)'
if ([string]::IsNullOrWhiteSpace($computerName)) {
    throw 'Имя ПК не может быть пустым.'
}

$usersRoot = "\\$computerName\c$\Users"
try {
    $usersRootExists = Test-Path -LiteralPath $usersRoot
}
catch {
    $reason = $_.Exception.Message
    Write-Error "Нет доступа к пути $usersRoot. Причина: $reason"
    exit 1
}

if (-not $usersRootExists) {
    Write-Error "Путь недоступен: $usersRoot"
    exit 1
}

try {
    $userFolders = Get-ChildItem -LiteralPath $usersRoot -Directory -Force |
        Sort-Object LastWriteTime -Descending
}
catch {
    $reason = $_.Exception.Message
    Write-Error "Не удалось получить список профилей в $usersRoot. Причина: $reason"
    exit 1
}

if (-not $userFolders) {
    Write-Error "В $usersRoot не найдено папок пользователей."
    exit 1
}

$menuItems = foreach ($folder in $userFolders) {
    [PSCustomObject]@{
        Display = "{0} (изменено: {1})" -f $folder.Name, $folder.LastWriteTime.ToString('yyyy-MM-dd HH:mm')
        Value   = $folder.Name
    }
}

$selectedUser = Get-SelectionFromMenu -Items $menuItems -Title "Найдены профили в $usersRoot (сортировка по дате изменения):"

$basePath = Join-Path $usersRoot $selectedUser
$local1cPath = Join-Path $basePath 'AppData\Local\1C\1cv8'
$roaming1cPath = Join-Path $basePath 'AppData\Roaming\1C\1cv8'

Write-Host "`nВыбран пользователь: $selectedUser"
Write-Host "Local:   $local1cPath"
Write-Host "Roaming: $roaming1cPath"

$allowedLocal = @(
    'conf',
    'dumps',
    'logs',
    '1cv8u.pfl'
)

$allowedRoaming = @(
    'ExtCompT',
    '1cv8c.pfl',
    '1cv8ccmn.pfl',
    '1cv8strt.pfl',
    '1cv8u.pfl'
)

$confirm = Read-Host "`nПродолжить удаление лишних файлов/папок? (Y/N)"
if ($confirm -notmatch '^(Y|y|Д|д)$') {
    Write-Host 'Операция отменена пользователем.' -ForegroundColor Yellow
    exit 0
}

Remove-UnwantedChildren -Path $local1cPath -AllowedNames $allowedLocal -Label 'Local'
Remove-UnwantedChildren -Path $roaming1cPath -AllowedNames $allowedRoaming -Label 'Roaming'

if ($script:FailedItems.Count -gt 0) {
    Write-Host "`nБыли элементы, к которым не удалось получить доступ или удалить:" -ForegroundColor Yellow
    foreach ($failed in $script:FailedItems) {
        Write-Host (" - {0}" -f $failed)
    }
}

Write-Host "`nГотово." -ForegroundColor Green
