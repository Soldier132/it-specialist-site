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

$demo              = it_specialist_get_demo_content();
$reviews_data      = isset($demo['reviews']) && is_array($demo['reviews']) ? $demo['reviews'] : array();
$reviews_intro     = isset($reviews_data['intro']) ? $reviews_data['intro'] : __('Client feedback and outcomes from delivered IT projects.', 'it-specialist');
$review_items      = isset($reviews_data['items']) && is_array($reviews_data['items']) ? $reviews_data['items'] : array();
$reviews_link      = isset($reviews_data['profile_link_placeholder']) ? $reviews_data['profile_link_placeholder'] : '#';
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Reviews', 'it-specialist'); ?></h1>
		<p><?php echo esc_html($reviews_intro); ?></p>
	</section>

	<section class="section grid">
		<?php foreach ($review_items as $review) : ?>
			<article class="card">
				<h2><?php echo esc_html(isset($review['author']) ? $review['author'] : ''); ?></h2>
				<p><strong><?php esc_html_e('Rating:', 'it-specialist'); ?></strong> <?php echo esc_html(isset($review['rating']) ? (string) $review['rating'] : ''); ?>/5</p>
				<p><?php echo esc_html(isset($review['text']) ? $review['text'] : ''); ?></p>
			</article>
		<?php endforeach; ?>
	</section>

	<section class="section">
		<a class="btn btn-outline" href="<?php echo esc_url($reviews_link); ?>"><?php esc_html_e('Add Public Profile Link', 'it-specialist'); ?></a>
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
