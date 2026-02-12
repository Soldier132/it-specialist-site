# SEO, Indexing, and Analytics Requirements

## URL and Information Architecture
- Clean, human-readable URLs (e.g., `/services/server-setup`).
- Consistent canonical host policy (`www` <-> non-`www`) with redirects.
- Production URL structure must remain stable after launch.

## On-Page SEO
- Per-page configurable `<title>` and `<meta description>`.
- Exactly one `H1` per page and correct `H2/H3` hierarchy.
- All meaningful images must include `alt` attributes.
- Content should be unique and relevant to services.

## Technical SEO
- XML sitemap generation enabled and accessible.
- `robots.txt` present and configured by environment:
  - staging/dev: noindex behavior allowed;
  - production: indexing allowed with sitemap reference.
- Canonical URLs enabled to prevent duplicate content issues.
- Redirect rules configured for canonical domain consistency.

## Structured Data (Schema)
- Add schema.org markup where applicable (minimum: Organization/Person + Contact page context).
- Validate structured data after deployment.

## Performance-Related SEO
- Optimize images (compression and modern formats where possible).
- Enable caching (application/server level as available).
- Minimize render-blocking assets where practical.
- Run post-launch performance checks (PageSpeed / Core Web Vitals baseline).

## SEO Monitoring and Analytics
- Google Analytics integrated for traffic and behavior insights.
- Google Search Console configured for indexing/error monitoring.
- Sitemap submitted in Search Console.
- Track index coverage and resolve critical indexing issues.

## References
- URL/page inventory: `docs/spec/sitemap.md`
- External service integration details: `docs/spec/integrations.md`
- Acceptance checks: `docs/spec/acceptance.md`
