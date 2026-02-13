<?php
/**
 * Reviews page template.
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
		<h1><?php esc_html_e('Reviews', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('Client feedback and outcomes from delivered IT projects.', 'it-specialist'); ?></p>
	</section>

	<section class="section grid">
		<article class="card"><h2><?php esc_html_e('Operations Team', 'it-specialist'); ?></h2><p><?php esc_html_e('"Fast response and clear action plan. Downtime dropped in the first month."', 'it-specialist'); ?></p></article>
		<article class="card"><h2><?php esc_html_e('Startup Founder', 'it-specialist'); ?></h2><p><?php esc_html_e('"The migration was smooth and our deployment process became predictable."', 'it-specialist'); ?></p></article>
		<article class="card"><h2><?php esc_html_e('Retail Business', 'it-specialist'); ?></h2><p><?php esc_html_e('"Excellent support quality and strong communication."', 'it-specialist'); ?></p></article>
	</section>

	<section class="section card">
		<h2><?php esc_html_e('Newsletter (Optional)', 'it-specialist'); ?></h2>
		<p class="field-note"><?php esc_html_e('Subscribe for occasional updates and practical IT tips.', 'it-specialist'); ?></p>
		<?php it_specialist_form_notice('newsletter'); ?>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<input type="hidden" name="action" value="it_specialist_newsletter">
			<?php wp_nonce_field('it_specialist_newsletter_form', 'it_specialist_newsletter_nonce'); ?>
			<input type="text" name="website" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px" aria-hidden="true">
			<div>
				<label for="newsletter-email"><?php esc_html_e('Email', 'it-specialist'); ?></label>
				<input id="newsletter-email" name="email" type="email" required>
			</div>
			<button class="btn btn-primary" type="submit"><?php esc_html_e('Subscribe', 'it-specialist'); ?></button>
		</form>
	</section>
</div>
<?php
get_footer();
