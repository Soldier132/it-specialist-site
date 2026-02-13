<?php
/**
 * Portfolio page template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Portfolio', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('Selected infrastructure, migration, and optimization projects delivered for clients.', 'it-specialist'); ?></p>
	</section>

	<section class="section grid">
		<article class="card">
			<h2><?php esc_html_e('Cloud Migration', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Moved business workloads to cloud with minimal downtime and full backup coverage.', 'it-specialist'); ?></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Support Automation', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Implemented scripts and workflow automation to reduce support queue time.', 'it-specialist'); ?></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Security Hardening', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Introduced access policies, audit logging, and backup validation process.', 'it-specialist'); ?></p>
		</article>
	</section>
</div>
<?php
get_footer();
