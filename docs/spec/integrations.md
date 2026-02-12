# Integrations

## Communication Channels
- Telegram button/link to open chat with specialist.
- WhatsApp button/link to open chat with specialist.
- `mailto:` links for direct email contact.

## Form Delivery and Notifications
- Form submissions delivered to configured mailbox (SMTP preferred).
- Optional: store form entries in CMS admin.
- Optional: notification routing to messenger/CRM if required later.

## Google Services
- Google Analytics integration (tracking enabled in production).
- Google Search Console readiness:
  - ownership verification support,
  - sitemap submission workflow,
  - indexing monitoring.
- Google Maps embed on `/contacts` with specialist location.

## Social Platforms
- Social profile links (e.g., LinkedIn, Telegram channel, other active profiles).

## Optional Growth Integrations
- Newsletter platforms (e.g., Mailchimp, UniSender) for subscription workflows.
- CRM integration via API/webhooks for lead processing automation.

## Integration Configuration Rules
- Secrets/keys/tokens are stored in environment variables or hosting secret storage.
- No integration credentials in repository.
- Integration settings must be environment-aware (staging vs production).

## References
- SEO and indexing requirements: `docs/spec/seo.md`
- Acceptance criteria: `docs/spec/acceptance.md`
