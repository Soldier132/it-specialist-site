# WordPress Stack Decisions

## 1) Goal
Define a pragmatic WordPress stack that satisfies acceptance criteria for:
- SEO
- Forms
- Security
- Caching/performance

## 2) Selected Stack (Primary)
### SEO
- **Yoast SEO**

Why:
- Mature per-page title/meta controls
- XML sitemap generation
- Canonical URL management
- Broad compatibility and documentation

Covers acceptance:
- Unique title/meta per page
- sitemap.xml availability
- Basic on-page SEO controls

### Forms
- **Fluent Forms**

Why:
- Fast setup for multiple forms
- Built-in validation and confirmation states
- Honeypot and anti-spam integrations
- Optional entry storage in WP admin

Forms to implement:
- Feedback: name, email, message
- Service request: name, phone, email, request description
- Optional newsletter: email

### SMTP / Mail Delivery
- **FluentSMTP**

Why:
- Reliable SMTP/API relay support
- Better email deliverability than default `wp_mail`
- Logging and troubleshooting support

Notes:
- Use environment variables/secrets for credentials
- Prefer transactional providers with SPF/DKIM/DMARC

### Security
- **Wordfence Security**

Why:
- Firewall + malware scanning baseline
- Login protection (rate limiting / brute force controls)
- Good default hardening for small business sites

Baseline config:
- Enable firewall and scan schedule
- Rate limit login attempts
- Alerting to admin email

### Caching / Performance
- **WP Super Cache** (default)

Why:
- Stable page caching with low complexity
- Good compatibility on generic shared/VPS hosting

Hosting-specific alternative:
- If server is LiteSpeed, use **LiteSpeed Cache** instead for tighter server integration.

### Redirects
- **Redirection**

Why:
- Easy management of canonical redirects and URL changes
- Helps enforce host consistency (www/non-www) with server rules

### Image Optimization
- **Converter for Media** (or equivalent WebP/AVIF plugin)

Why:
- Improves page speed with modern image formats
- Supports SEO performance goals from spec

## 3) Optional / Situational Plugins
- **Site Kit by Google** for GA + Search Console integration if non-technical admin users need guided setup.
- If analytics is configured manually in theme, Site Kit can be skipped to reduce plugin count.

## 4) Plugin Policy
- Keep plugin set minimal to reduce security/performance risk.
- Prefer well-maintained plugins with active updates and large install base.
- Remove inactive plugins and unused themes.
- Run updates first in staging when available.

## 5) Theme Strategy Decision
Chosen: **custom lightweight theme**.

Rationale:
- Better performance and cleaner semantic HTML than heavy multipurpose themes.
- Full control of H1/H2/H3 structure required by acceptance criteria.
- Lower long-term maintenance complexity for a focused 6-page site.

Fallback:
- If timeline becomes critical, use a minimal block theme (e.g., Twenty Twenty-Four child) with strict CSS/JS constraints.

## 6) Hosting Requirements
### Required
- PHP 8.2+
- MySQL 8.0+ or MariaDB 10.6+
- HTTPS certificate
- Cron enabled
- Outbound SMTP/API mail support

### Recommended
- 2 vCPU / 2-4 GB RAM
- 10+ GB SSD
- HTTP/2 or HTTP/3
- Brotli/Gzip compression
- Daily offsite backups with at least 14-day retention
- Staging environment

### Operational requirements
- Secret management via environment variables (SMTP creds, analytics IDs)
- Access logging and backup restore test at least once before launch

## 7) Acceptance Mapping (Stack to Criteria)
- Pages/responsive: handled by custom theme templates + QA process.
- Forms: Fluent Forms + FluentSMTP + anti-spam settings.
- SEO: Yoast SEO + template heading rules + alt text workflow.
- Security: HTTPS + Wordfence + secret management in env vars.

## 8) Alternatives Snapshot
- SEO alternative: Rank Math (feature-rich, but keep one SEO plugin only).
- Forms alternative: Contact Form 7 + Flamingo (lean but more manual UX/config).
- Security alternative: Solid Security (good hardening, choose one security plugin only).
- Cache alternative: WP Rocket (paid, easier tuning, good for tighter performance targets).

Decision rule:
- Start with selected primary stack; switch only for hard hosting constraints or documented compatibility issues.
