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

$demo         = it_specialist_get_demo_content();
$contacts     = isset($demo['contacts_page']) && is_array($demo['contacts_page']) ? $demo['contacts_page'] : array();
$phone        = it_specialist_get_contact_value('it_specialist_phone', 'it_specialist_contact_phone', 'phone', '+1 (000) 000-0000');
$email        = it_specialist_get_contact_value('it_specialist_email', 'it_specialist_contact_email', 'email', 'contact@example.com');
$telegram     = it_specialist_get_contact_value('it_specialist_telegram_url', 'it_specialist_telegram', 'telegram_url', 'https://t.me/yourusername');
$whatsapp     = it_specialist_get_contact_value('it_specialist_whatsapp_url', 'it_specialist_whatsapp', 'whatsapp_url', 'https://wa.me/10000000000');
$linkedin     = it_specialist_get_contact_value('it_specialist_linkedin', 'it_specialist_linkedin', 'linkedin_url', 'https://linkedin.com/in/yourprofile');
$address      = it_specialist_get_contact_value('it_specialist_address', 'it_specialist_address', 'address', '');
$city         = it_specialist_get_contact_value('it_specialist_city', 'it_specialist_city', 'city', '');
$intro        = isset($contacts['intro']) ? $contacts['intro'] : __('Reach out through email, phone, or messenger. Typical response time: same business day.', 'it-specialist');
$availability = isset($contacts['availability']) ? $contacts['availability'] : '';
$channels     = isset($contacts['preferred_channels']) && is_array($contacts['preferred_channels']) ? $contacts['preferred_channels'] : array();
$maps_url     = isset($contacts['google_maps_embed']) ? $contacts['google_maps_embed'] : 'https://www.google.com/maps?q=New+York&output=embed';
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Contacts', 'it-specialist'); ?></h1>
		<p><?php echo esc_html($intro); ?></p>
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
			<?php if ($city || $address) : ?>
				<p><strong><?php esc_html_e('City:', 'it-specialist'); ?></strong> <?php echo esc_html($city); ?></p>
				<p><strong><?php esc_html_e('Address:', 'it-specialist'); ?></strong> <?php echo esc_html($address); ?></p>
			<?php endif; ?>
			<?php if (!empty($channels)) : ?>
				<p><strong><?php esc_html_e('Preferred channels:', 'it-specialist'); ?></strong> <?php echo esc_html(implode(', ', $channels)); ?></p>
			<?php endif; ?>
			<?php if ($availability) : ?>
				<p><strong><?php esc_html_e('Availability:', 'it-specialist'); ?></strong> <?php echo esc_html($availability); ?></p>
			<?php endif; ?>
		</article>
	</section>

	<section class="section">
		<h2><?php esc_html_e('Location', 'it-specialist'); ?></h2>
		<iframe
			class="map-embed"
			title="<?php esc_attr_e('Google Map location', 'it-specialist'); ?>"
			src="<?php echo esc_url($maps_url); ?>"
			loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"></iframe>
	</section>
</div>
<?php
get_footer();
