<?php
/**
 * Contacts page template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

$phone    = get_theme_mod('it_specialist_contact_phone', '+1 (000) 000-0000');
$email    = get_theme_mod('it_specialist_contact_email', 'contact@example.com');
$telegram = get_theme_mod('it_specialist_telegram', 'https://t.me/yourusername');
$whatsapp = get_theme_mod('it_specialist_whatsapp', 'https://wa.me/10000000000');
$linkedin = get_theme_mod('it_specialist_linkedin', 'https://linkedin.com/in/yourprofile');
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Contacts', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('Reach out through email, phone, or messenger. Typical response time: same business day.', 'it-specialist'); ?></p>
	</section>

	<section class="section grid">
		<article class="card">
			<h2><?php esc_html_e('Direct Contact', 'it-specialist'); ?></h2>
			<p><strong><?php esc_html_e('Phone:', 'it-specialist'); ?></strong> <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
			<p><strong><?php esc_html_e('Email:', 'it-specialist'); ?></strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Messengers', 'it-specialist'); ?></h2>
			<p><a class="btn btn-outline" href="<?php echo esc_url($telegram); ?>"><?php esc_html_e('Open Telegram', 'it-specialist'); ?></a></p>
			<p><a class="btn btn-outline" href="<?php echo esc_url($whatsapp); ?>"><?php esc_html_e('Open WhatsApp', 'it-specialist'); ?></a></p>
		</article>
		<article class="card">
			<h2><?php esc_html_e('Social', 'it-specialist'); ?></h2>
			<p><a href="<?php echo esc_url($linkedin); ?>"><?php esc_html_e('LinkedIn Profile', 'it-specialist'); ?></a></p>
		</article>
	</section>

	<section class="section">
		<h2><?php esc_html_e('Location', 'it-specialist'); ?></h2>
		<iframe
			class="map-embed"
			title="<?php esc_attr_e('Google Map location', 'it-specialist'); ?>"
			src="https://www.google.com/maps?q=New+York&output=embed"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"></iframe>
	</section>
</div>
<?php
get_footer();
