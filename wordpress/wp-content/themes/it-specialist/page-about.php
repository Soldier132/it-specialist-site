<?php
/**
 * About page template.
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
		<h1><?php esc_html_e('About', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('I am an IT specialist focused on stable operations, secure infrastructure, and practical automation that helps teams ship faster with fewer incidents.', 'it-specialist'); ?></p>
	</section>

	<section class="section grid">
		<article class="card">
			<h2><?php esc_html_e('Experience', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Hands-on work with small businesses and enterprise teams across support, systems administration, and cloud operations.', 'it-specialist'); ?></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Approach', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Clear communication, measurable improvements, and security-first decisions in every project stage.', 'it-specialist'); ?></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Certifications', 'it-specialist'); ?></h2>
			<p><?php esc_html_e('Add your current certifications and vendor credentials here.', 'it-specialist'); ?></p>
		</article>
	</section>
</div>
<?php
get_footer();
