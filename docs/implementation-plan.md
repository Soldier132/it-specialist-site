# WordPress Implementation Plan

## 1) Scope and Inputs
This plan is based on:
- `docs/spec/acceptance.md`
- `docs/spec/sitemap.md`
- `docs/spec/seo.md`
- `docs/spec/integrations.md`
- `docs/spec/tech-spec.md` (currently placeholder; assumptions listed below)

Project model: turnkey website for an IT specialist on WordPress with required pages, lead forms, SEO basics, security controls, and integrations.

## 2) Assumptions
Because `docs/spec/tech-spec.md` does not yet contain detailed project text, the following defaults are assumed:
- WordPress 6.x, PHP 8.2+, MySQL 8.0+/MariaDB 10.6+
- Single language (RU) at initial launch
- No WooCommerce, no user accounts, no complex membership features
- Content managed via Pages + custom post types (Portfolio, Reviews)
- SMTP credentials, GA ID, and reCAPTCHA keys are provided at deployment time
- Blog remains optional and can be enabled later without redesign

## 3) Architecture and Build Approach
### 3.1 Theme approach
Chosen approach: **custom lightweight theme** (block-based or classic hybrid) instead of a heavy multipurpose theme.

Rationale:
- Better performance baseline (Core Web Vitals, reduced CSS/JS bloat)
- Precise control over heading hierarchy and semantic HTML (SEO acceptance)
- Easier hardening and maintainability (smaller code surface)
- Predictable UX across required pages and forms

Implementation details:
- Create `it-specialist-theme` child-safe custom theme
- Use minimal template set: `front-page.php`, `page.php`, templates for About/Services/Contacts, archive/single templates for Portfolio and Reviews CPTs
- Register navigation menus and widget/footer areas
- Centralize design tokens (colors, spacing, typography) and responsive breakpoints
- Keep JS minimal; prefer native WP blocks and server-rendered content

### 3.2 Content model
- Pages: Home, About, Services, Portfolio, Reviews, Contacts
- Optional future: Blog index + single posts
- Custom Post Types:
  - `portfolio_item`
  - `review`
- Optional taxonomy for services or portfolio categories if needed for filtering

### 3.3 Form model
- Feedback form (Contacts): name, email, message
- Service request form (Services and/or Contacts): name, phone, email, request description
- Optional newsletter form: email

Submit flow:
- Client + server validation
- Honeypot + CAPTCHA/anti-spam
- SMTP email delivery to configured mailbox
- Success/error states visible inline
- Optional storage in admin (form entries)

## 4) Plugin Plan (Required Categories)
See detailed rationale in `docs/wp-stack.md`.

Baseline selected plugins:
- SEO: Yoast SEO
- Forms: Fluent Forms (free/pro depending on entry/email requirements)
- SMTP mail delivery: FluentSMTP
- Security: Wordfence Security (or Solid Security as alternative)
- Caching/performance: WP Super Cache (or LiteSpeed Cache if LiteSpeed hosting)
- Images: Converter for Media (WebP/AVIF) or equivalent optimizer
- Redirects: Redirection

Integrations support:
- GA + Search Console via Site Kit by Google (or manual script injection in theme)
- Telegram/WhatsApp links via theme CTA buttons (plugin not strictly required)
- Google Maps embed via native iframe block in Contacts page

## 5) Hosting and Infrastructure Requirements
### 5.1 Minimum runtime
- PHP 8.2+
- MySQL 8.0+ or MariaDB 10.6+
- Nginx or Apache with HTTPS support
- Memory limit: 256 MB minimum (512 MB recommended)
- Disk: 5 GB minimum (10+ GB recommended with media backups)

### 5.2 Security and operations
- TLS certificate (Let's Encrypt or managed cert)
- Automated daily backups (files + database), 14+ day retention
- WAF/CDN optional but recommended (Cloudflare)
- Staging environment preferred for release validation
- Cron enabled for WP scheduled jobs
- SMTP relay support (provider: Mailgun/SendGrid/SMTP mailbox)

### 5.3 Performance requirements
- Server-level page caching allowed
- Brotli/Gzip compression enabled
- HTTP/2 or HTTP/3 enabled
- Image optimization pipeline supported

## 6) Detailed Task Breakdown Mapped to Acceptance Criteria

### A. Pages
Acceptance:
- All required pages exist and are reachable from main menu.
- Layout works on mobile/tablet/desktop; touch controls are usable.

Tasks:
1. Create WP pages: Home, About, Services, Portfolio, Reviews, Contacts.
2. Build primary navigation and footer navigation with required pages.
3. Implement responsive layout grid and breakpoints (mobile-first).
4. Validate touch targets (buttons/links/forms) for mobile usability.
5. Add Portfolio and Reviews content templates with archive/single behavior.
6. Perform cross-device checks (375px, 768px, 1024px, 1440px).

Deliverables:
- Published pages + menu
- Responsive CSS and templates
- Device QA checklist

### B. Forms
Acceptance:
- Validation works (required fields, email format).
- Successful submit sends an email to configured mailbox and shows success state.
- Anti-spam enabled (honeypot and/or rate limit and/or captcha).
- Error/success UX is clear.

Tasks:
1. Implement feedback form fields: name, email, message.
2. Implement service request form fields: name, phone, email, request description.
3. Implement optional newsletter form (email only).
4. Configure required validation and email format checks.
5. Configure SMTP plugin and test delivery to target mailbox.
6. Enable anti-spam controls: honeypot + CAPTCHA (or equivalent).
7. Design inline success/error states and form-level messages.
8. Add admin visibility for submissions (if selected plugin mode supports entries).
9. Execute end-to-end test cases for valid/invalid submissions.

Deliverables:
- Working forms with validation
- SMTP-configured mail delivery
- Anti-spam controls active
- Form test report

### C. SEO
Acceptance:
- Each page has unique title + meta description.
- One H1 per page, proper heading hierarchy.
- sitemap.xml and robots.txt are present.
- All images have alt.

Tasks:
1. Configure SEO plugin global settings (site name, title templates).
2. Set unique title/meta description for each required page.
3. Enforce one H1 per template and review H2/H3 structure.
4. Enable XML sitemap and verify `/sitemap_index.xml` or `/sitemap.xml`.
5. Ensure `robots.txt` is available and production-safe.
6. Add canonical URL policy and host redirect rule (www/non-www).
7. Validate image alt attributes in media/content workflow.
8. Submit sitemap to Google Search Console (post-launch ops step).

Deliverables:
- Per-page metadata matrix
- Heading hierarchy audit
- Accessible sitemap + robots
- Image alt compliance checklist

### D. Security
Acceptance:
- HTTPS supported in deployment.
- No secrets committed; env vars used for SMTP keys, analytics IDs.

Tasks:
1. Force HTTPS in WordPress and web server configuration.
2. Configure security plugin baseline (firewall, login protection, scan schedule).
3. Store secrets outside VCS: environment variables or host secret manager.
4. Move sensitive config values to `wp-config.php` from env variables.
5. Confirm no secrets in repo history/current files.
6. Restrict admin access hygiene (strong passwords, optional 2FA).

Deliverables:
- HTTPS enforced
- Security plugin baseline active
- Secret-management checklist passed

## 7) Integrations Implementation Tasks
1. Add Telegram and WhatsApp CTA buttons (header/footer/floating action area).
2. Configure mailto links for primary contact email.
3. Install/configure GA tracking (Site Kit or manual GA4 tag).
4. Prepare Search Console verification flow and sitemap submission.
5. Embed Google Maps iframe on Contacts page.
6. Add social profile links (LinkedIn, Telegram channel, others provided by owner).

## 8) Implementation Phases
1. Foundation
- Install WordPress, configure permalinks, baseline security, SMTP, caching
2. Theme and content model
- Build custom theme, register CPTs, create templates and menus
3. Forms and integrations
- Build forms, delivery pipeline, anti-spam, external links/integrations
4. SEO and compliance
- Metadata, headings, sitemap/robots, image alt review
5. QA and launch
- Acceptance checklist verification, performance/security smoke tests, go-live

## 9) QA Checklist (Release Gate)
- All required pages accessible from menu
- Responsive behavior validated on target breakpoints
- Forms validated and SMTP delivery confirmed
- Anti-spam active and tested
- Unique title/meta for each page
- One H1 per page verified
- sitemap.xml and robots.txt reachable
- All key images include alt text
- HTTPS and redirect/canonical policy active
- No secrets in repository

## 10) Risks and Mitigations
- Incomplete technical spec details: mitigate by tracking assumptions and confirming before launch.
- SMTP delivery failures: mitigate by using transactional provider and SPF/DKIM/DMARC setup.
- Plugin conflicts: mitigate via minimal plugin set, staging tests, version pinning strategy.
- Performance regressions from media/content growth: mitigate by image optimization and caching.

## 11) Definition of Done (Project-Level)
- All items in `docs/spec/acceptance.md` are demonstrably met.
- Required integrations from `docs/spec/integrations.md` are active.
- Site is deployed with HTTPS, working forms, and baseline analytics/SEO readiness.
