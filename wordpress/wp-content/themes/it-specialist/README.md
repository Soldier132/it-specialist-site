# IT Specialist Theme

Custom lightweight WordPress theme for the IT specialist website.

## Files Included

- `style.css`
- `functions.php`
- `header.php`
- `footer.php`
- `index.php`
- `page.php`
- `home.php` (optional blog index)
- `front-page.php` (Home)
- `page-about.php`
- `page-services.php`
- `page-portfolio.php`
- `page-reviews.php`
- `page-contacts.php`
- `assets/js/theme.js`

## Activation

1. Open WordPress admin: `Appearance -> Themes`.
2. Find **IT Specialist** and click **Activate**.

## Page Mapping in WordPress Admin

1. Go to `Pages -> Add New` and create these pages with exact slugs:
   - Home (`/`)
   - About (`/about`)
   - Services (`/services`)
   - Portfolio (`/portfolio`)
   - Reviews (`/reviews`)
   - Contacts (`/contacts`)
2. Go to `Settings -> Reading`:
   - Set **Your homepage displays** to **A static page**.
   - Set **Homepage** to **Home**.
3. Go to `Appearance -> Menus`:
   - Create a menu and assign it to **Primary Menu**.
   - Add required pages in this order: Home, About, Services, Portfolio, Reviews, Contacts.

## Theme Options / Placeholders

Go to `Appearance -> Customize -> IT Specialist Contacts` and set:

- Phone
- Contact Email
- Telegram URL
- WhatsApp URL
- LinkedIn URL
- Optional forms recipient email (falls back to WordPress admin email)

## Forms Included

- Feedback form (Home): name, email, message
- Service request form (Services): name, phone, email, request description
- Optional newsletter form (Reviews): email

Forms submit through `admin-post.php`, include nonce validation and honeypot field, and send emails via `wp_mail()` to configured recipient.

## Recommended WordPress Settings

1. `Settings -> Permalinks` -> choose **Post name**.
2. Configure SMTP plugin for reliable outgoing email in production.
