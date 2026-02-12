# Acceptance Criteria (Definition of Done)

Pages:
- All required pages exist and are reachable from main menu.
- Layout works on mobile/tablet/desktop; touch controls are usable.
- Page URLs match the required sitemap structure from `docs/spec/sitemap.md`.
- Required page content blocks are present (hero/services on Home, profile on About, list on Services, items on Portfolio, entries on Reviews, contact data + map on Contacts).

Forms:
- Validation works (required fields, email format).
- Successful submit sends an email to configured mailbox and shows success state.
- Anti-spam enabled (honeypot and/or rate limit and/or captcha).
- Error/success UX is clear.
- Feedback form contains: name, email, message.
- Service request form contains: name, phone, email, request description.
- (If enabled) newsletter form contains: email.

SEO:
- Each page has unique title + meta description.
- One H1 per page, proper heading hierarchy.
- sitemap.xml and robots.txt are present.
- All images have alt.
- Canonical URLs are configured and host redirect policy works (`www` or non-`www`, one canonical variant).
- Structured data validation has no critical errors for implemented schema.

Security:
- HTTPS supported in deployment.
- No secrets committed; env vars used for SMTP keys, analytics IDs.
- Admin access is protected (strong credentials; brute-force protection enabled).
- Regular updates process exists for CMS/theme/plugins.

Integrations:
- Telegram and WhatsApp contact links/buttons work.
- Google Analytics tracking is active in production.
- Google Search Console verification is completed and sitemap submitted.
- Google Maps is embedded and visible on Contacts page.
- Social profile links are present and functional.

Performance and Quality:
- Caching is enabled in production.
- Images are optimized for web delivery.
- Cross-browser smoke test passed (Chrome, Safari, Firefox, Edge latest stable).
- No broken internal links on required pages.
