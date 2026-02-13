<?php
/**
 * Footer template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

$phone    = it_specialist_get_contact_value('it_specialist_phone', 'it_specialist_contact_phone', 'phone', '+1 (000) 000-0000');
$email    = it_specialist_get_contact_value('it_specialist_email', 'it_specialist_contact_email', 'email', 'contact@example.com');
$telegram = it_specialist_get_contact_value('it_specialist_telegram_url', 'it_specialist_telegram', 'telegram_url', 'https://t.me/yourusername');
$whatsapp = it_specialist_get_contact_value('it_specialist_whatsapp_url', 'it_specialist_whatsapp', 'whatsapp_url', 'https://wa.me/10000000000');
$linkedin = it_specialist_get_contact_value('it_specialist_linkedin', 'it_specialist_linkedin', 'linkedin_url', 'https://linkedin.com/in/yourprofile');
?>
</main>
<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<section>
				<h2><?php bloginfo('name'); ?></h2>
				<p><?php bloginfo('description'); ?></p>
			</section>
			<section>
				<h2>Contacts</h2>
				<p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p>
				<p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
			</section>
			<section>
				<h2>Social</h2>
				<p><a href="<?php echo esc_url($telegram); ?>">Telegram</a></p>
				<p><a href="<?php echo esc_url($whatsapp); ?>">WhatsApp</a></p>
				<p><a href="<?php echo esc_url($linkedin); ?>">LinkedIn</a></p>
			</section>
		</div>
		<p class="copyright">&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
