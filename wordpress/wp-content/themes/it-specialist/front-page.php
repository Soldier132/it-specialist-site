<?php
/**
 * Front page template.
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
		<span class="pill">IT Services</span>
		<h1><?php esc_html_e('Reliable IT support for teams and businesses', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('From proactive maintenance to cloud migration and incident response, this website presents the complete service profile of your IT specialist.', 'it-specialist'); ?></p>
		<div class="cta-row">
			<a class="btn btn-primary" href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('View Services', 'it-specialist'); ?></a>
			<a class="btn btn-outline" href="<?php echo esc_url(home_url('/contacts/')); ?>"><?php esc_html_e('Contact Now', 'it-specialist'); ?></a>
		</div>
	</section>

	<section class="section">
		<h2><?php esc_html_e('Core expertise', 'it-specialist'); ?></h2>
		<div class="grid">
			<article class="card"><h3><?php esc_html_e('Infrastructure', 'it-specialist'); ?></h3><p><?php esc_html_e('Server setup, monitoring, and lifecycle support.', 'it-specialist'); ?></p></article>
			<article class="card"><h3><?php esc_html_e('Cloud', 'it-specialist'); ?></h3><p><?php esc_html_e('Migration planning and managed cloud operations.', 'it-specialist'); ?></p></article>
			<article class="card"><h3><?php esc_html_e('Security', 'it-specialist'); ?></h3><p><?php esc_html_e('Baseline hardening, backups, and access controls.', 'it-specialist'); ?></p></article>
		</div>
	</section>

	<section class="section card">
		<h2><?php esc_html_e('Feedback Form', 'it-specialist'); ?></h2>
		<?php it_specialist_form_notice('feedback'); ?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<input type="hidden" name="action" value="it_specialist_feedback">
			<?php wp_nonce_field('it_specialist_feedback_form', 'it_specialist_feedback_nonce'); ?>
			<input type="text" name="website" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px" aria-hidden="true">
			<div>
				<label for="feedback-name"><?php esc_html_e('Name', 'it-specialist'); ?></label>
				<input id="feedback-name" name="name" type="text" required>
			</div>
			<div>
				<label for="feedback-email"><?php esc_html_e('Email', 'it-specialist'); ?></label>
				<input id="feedback-email" name="email" type="email" required>
			</div>
			<div>
				<label for="feedback-message"><?php esc_html_e('Message', 'it-specialist'); ?></label>
				<textarea id="feedback-message" name="message" required></textarea>
			</div>
			<button class="btn btn-primary" type="submit"><?php esc_html_e('Send Feedback', 'it-specialist'); ?></button>
		</form>
	</section>
</div>
<?php
get_footer();
