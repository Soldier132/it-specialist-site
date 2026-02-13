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

$demo            = it_specialist_get_demo_content();
$services_data   = isset($demo['services']) && is_array($demo['services']) ? $demo['services'] : array();
$services_intro  = isset($services_data['intro']) ? $services_data['intro'] : __('End-to-end IT support and project delivery, adapted to your team size and business goals.', 'it-specialist');
$service_items   = isset($services_data['items']) && is_array($services_data['items']) ? $services_data['items'] : array();
$pricing_policy  = isset($services_data['pricing_policy']) ? $services_data['pricing_policy'] : '';
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Services', 'it-specialist'); ?></h1>
		<p><?php echo esc_html($services_intro); ?></p>
	</section>

	<section class="section">
		<div class="grid">
			<?php foreach ($service_items as $item) : ?>
				<article class="card">
					<h2><?php echo esc_html(isset($item['name']) ? $item['name'] : ''); ?></h2>
					<?php if (isset($item['includes']) && is_array($item['includes']) && !empty($item['includes'])) : ?>
						<h3><?php esc_html_e('Includes', 'it-specialist'); ?></h3>
						<ul>
							<?php foreach ($item['includes'] as $include) : ?>
								<li><?php echo esc_html($include); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<p><strong><?php esc_html_e('Result:', 'it-specialist'); ?></strong> <?php echo esc_html(isset($item['result']) ? $item['result'] : ''); ?></p>
					<p><strong><?php esc_html_e('Notes:', 'it-specialist'); ?></strong> <?php echo esc_html(isset($item['notes']) ? $item['notes'] : ''); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<?php if ($pricing_policy) : ?>
			<p class="field-note"><strong><?php esc_html_e('Pricing policy:', 'it-specialist'); ?></strong> <?php echo esc_html($pricing_policy); ?></p>
		<?php endif; ?>
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
