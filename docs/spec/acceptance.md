# Acceptance Criteria (Definition of Done)

Pages:
- All required pages exist and are reachable from main menu.
- Layout works on mobile/tablet/desktop; touch controls are usable.

Forms:
- Validation works (required fields, email format).
- Successful submit sends an email to configured mailbox and shows success state.
- Anti-spam enabled (honeypot and/or rate limit and/or captcha).
- Error/success UX is clear.

SEO:
- Each page has unique title + meta description.
- One H1 per page, proper heading hierarchy.
- sitemap.xml and robots.txt are present.
- All images have alt.

Security:
- HTTPS supported in deployment.
- No secrets committed; env vars used for SMTP keys, analytics IDs.
