[CmdletBinding()]
param()

$ErrorActionPreference = 'Stop'

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

    if (-not (Test-Path -LiteralPath $Path)) {
        Write-Warning "Путь не найден, пропускаю: $Path"
        return
    }

    $children = Get-ChildItem -LiteralPath $Path -Force
    $toRemove = $children | Where-Object { $_.Name -notin $AllowedNames }

    if (-not $toRemove) {
        Write-Host "[$Label] Лишних объектов не найдено."
        return
    }

    Write-Host "[$Label] Будут удалены:" -ForegroundColor Yellow
    $toRemove | ForEach-Object {
        Write-Host (" - {0}" -f $_.FullName)
    }

    foreach ($item in $toRemove) {
        Remove-Item -LiteralPath $item.FullName -Recurse -Force
    }

    Write-Host "[$Label] Очистка завершена. Удалено: $($toRemove.Count)"
}

Write-Host 'Очистка временных папок 1C (Local/Roaming\1C\1cv8)' -ForegroundColor Cyan

$computerName = Read-Host 'Введите имя ПК (например, ARM-277)'
if ([string]::IsNullOrWhiteSpace($computerName)) {
    throw 'Имя ПК не может быть пустым.'
}

$usersRoot = "\\$computerName\c$\Users"
if (-not (Test-Path -LiteralPath $usersRoot)) {
    throw "Путь недоступен: $usersRoot"
}

$userFolders = Get-ChildItem -LiteralPath $usersRoot -Directory -Force |
    Sort-Object LastWriteTime -Descending

if (-not $userFolders) {
    throw "В $usersRoot не найдено папок пользователей."
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

Write-Host "`nГотово." -ForegroundColor Green
