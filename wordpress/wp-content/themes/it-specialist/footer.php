<?php
/**
 * Footer template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

$phone    = get_theme_mod('it_specialist_contact_phone', '+1 (000) 000-0000');
$email    = get_theme_mod('it_specialist_contact_email', 'contact@example.com');
$telegram = get_theme_mod('it_specialist_telegram', 'https://t.me/yourusername');
$whatsapp = get_theme_mod('it_specialist_whatsapp', 'https://wa.me/10000000000');
$linkedin = get_theme_mod('it_specialist_linkedin', 'https://linkedin.com/in/yourprofile');
?>
</main>
<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<section>
				<h2>IT Specialist</h2>
				<p>Infrastructure support, cloud operations, and business IT automation.</p>
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
