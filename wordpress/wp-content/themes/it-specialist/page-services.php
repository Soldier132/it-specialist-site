<?php
/**
 * Services page template.
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
		<h1><?php esc_html_e('Services', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('End-to-end IT support and project delivery, adapted to your team size and business goals.', 'it-specialist'); ?></p>
	</section>

	<section class="section grid">
		<article class="card"><h2><?php esc_html_e('Managed IT Support', 'it-specialist'); ?></h2><p><?php esc_html_e('Monitoring, user support, patching, and issue resolution.', 'it-specialist'); ?></p></article>
		<article class="card"><h2><?php esc_html_e('Cloud & DevOps', 'it-specialist'); ?></h2><p><?php esc_html_e('Cloud setup, CI/CD integration, and performance optimization.', 'it-specialist'); ?></p></article>
		<article class="card"><h2><?php esc_html_e('Security & Backup', 'it-specialist'); ?></h2><p><?php esc_html_e('Security baseline, backup strategy, and disaster readiness.', 'it-specialist'); ?></p></article>
	</section>

	<section class="section card">
		<h2><?php esc_html_e('Service Request Form', 'it-specialist'); ?></h2>
		<p class="field-note"><?php esc_html_e('Fields: name, phone, email, request description.', 'it-specialist'); ?></p>
		<?php it_specialist_form_notice('service'); ?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<input type="hidden" name="action" value="it_specialist_service">
			<?php wp_nonce_field('it_specialist_service_form', 'it_specialist_service_nonce'); ?>
			<input type="text" name="website" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px" aria-hidden="true">
			<div>
				<label for="service-name"><?php esc_html_e('Name', 'it-specialist'); ?></label>
				<input id="service-name" name="name" type="text" required>
			</div>
			<div>
				<label for="service-phone"><?php esc_html_e('Phone', 'it-specialist'); ?></label>
				<input id="service-phone" name="phone" type="tel" required>
			</div>
			<div>
				<label for="service-email"><?php esc_html_e('Email', 'it-specialist'); ?></label>
				<input id="service-email" name="email" type="email" required>
			</div>
			<div>
				<label for="request-description"><?php esc_html_e('Request Description', 'it-specialist'); ?></label>
				<textarea id="request-description" name="request_description" required></textarea>
			</div>
			<button class="btn btn-primary" type="submit"><?php esc_html_e('Send Request', 'it-specialist'); ?></button>
		</form>
	</section>
</div>
<?php
get_footer();
