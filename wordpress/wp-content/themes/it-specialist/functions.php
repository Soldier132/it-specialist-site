<?php
/**
 * Theme functions.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

function it_specialist_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

	register_nav_menus(
		array(
			'primary' => __('Primary Menu', 'it-specialist'),
		)
	);
}
add_action('after_setup_theme', 'it_specialist_setup');

function it_specialist_enqueue_assets() {
	wp_enqueue_style('it-specialist-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
	wp_enqueue_script(
		'it-specialist-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('wp_enqueue_scripts', 'it_specialist_enqueue_assets');

function it_specialist_register_customizer($wp_customize) {
	$wp_customize->add_section(
		'it_specialist_contact_section',
		array(
			'title'    => __('IT Specialist Contacts', 'it-specialist'),
			'priority' => 40,
		)
	);

	$settings = array(
		'it_specialist_contact_phone' => '+1 (000) 000-0000',
		'it_specialist_contact_email' => 'contact@example.com',
		'it_specialist_telegram'      => 'https://t.me/yourusername',
		'it_specialist_whatsapp'      => 'https://wa.me/10000000000',
		'it_specialist_linkedin'      => 'https://linkedin.com/in/yourprofile',
	);

	foreach ($settings as $setting => $default) {
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			$setting,
			array(
				'section' => 'it_specialist_contact_section',
				'label'   => ucwords(str_replace(array('it_specialist_', '_'), array('', ' '), $setting)),
				'type'    => 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'it_specialist_forms_email',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_email',
		)
	);

	$wp_customize->add_control(
		'it_specialist_forms_email',
		array(
			'section'     => 'it_specialist_contact_section',
			'label'       => __('Forms Recipient Email (optional)', 'it-specialist'),
			'description' => __('If empty, WordPress admin email is used.', 'it-specialist'),
			'type'        => 'email',
		)
	);
}
add_action('customize_register', 'it_specialist_register_customizer');

function it_specialist_get_forms_email() {
	$custom_email = get_theme_mod('it_specialist_forms_email', '');
	return $custom_email ? sanitize_email($custom_email) : get_option('admin_email');
}

function it_specialist_get_remote_ip() {
	return isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
}

function it_specialist_redirect_with_notice($status, $type, $fallback_slug = '') {
	$url = wp_get_referer();
	if (!$url) {
		$url = $fallback_slug ? home_url('/' . trim($fallback_slug, '/') . '/') : home_url('/');
	}
	$url = add_query_arg(
		array(
			'form_status' => $status,
			'form_type'   => $type,
		),
		$url
	);

	wp_safe_redirect($url);
	exit;
}

function it_specialist_can_submit_form($form_key) {
	$rate_key = 'it_specialist_form_' . md5($form_key . '|' . it_specialist_get_remote_ip());
	if (get_transient($rate_key)) {
		return false;
	}
	set_transient($rate_key, '1', MINUTE_IN_SECONDS * 2);
	return true;
}

function it_specialist_handle_feedback_form() {
	if (!isset($_POST['it_specialist_feedback_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['it_specialist_feedback_nonce'])), 'it_specialist_feedback_form')) {
		it_specialist_redirect_with_notice('error', 'feedback');
	}

	$honeypot = isset($_POST['website']) ? sanitize_text_field(wp_unslash($_POST['website'])) : '';
	if (!empty($honeypot) || !it_specialist_can_submit_form('feedback')) {
		it_specialist_redirect_with_notice('error', 'feedback');
	}

	$name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
	$email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

	if (!$name || !is_email($email) || !$message) {
		it_specialist_redirect_with_notice('error', 'feedback');
	}

	$sent = wp_mail(
		it_specialist_get_forms_email(),
		'New Feedback Request',
		"Name: {$name}\nEmail: {$email}\n\nMessage:\n{$message}",
		array('Reply-To: ' . $name . ' <' . $email . '>')
	);

	it_specialist_redirect_with_notice($sent ? 'success' : 'error', 'feedback');
}
add_action('admin_post_nopriv_it_specialist_feedback', 'it_specialist_handle_feedback_form');
add_action('admin_post_it_specialist_feedback', 'it_specialist_handle_feedback_form');

function it_specialist_handle_service_request_form() {
	if (!isset($_POST['it_specialist_service_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['it_specialist_service_nonce'])), 'it_specialist_service_form')) {
		it_specialist_redirect_with_notice('error', 'service', 'services');
	}

	$honeypot = isset($_POST['website']) ? sanitize_text_field(wp_unslash($_POST['website'])) : '';
	if (!empty($honeypot) || !it_specialist_can_submit_form('service')) {
		it_specialist_redirect_with_notice('error', 'service', 'services');
	}

	$name        = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
	$phone       = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
	$email       = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
	$description = isset($_POST['request_description']) ? sanitize_textarea_field(wp_unslash($_POST['request_description'])) : '';

	if (!$name || !$phone || !is_email($email) || !$description) {
		it_specialist_redirect_with_notice('error', 'service', 'services');
	}

	$sent = wp_mail(
		it_specialist_get_forms_email(),
		'New Service Request',
		"Name: {$name}\nPhone: {$phone}\nEmail: {$email}\n\nRequest Description:\n{$description}",
		array('Reply-To: ' . $name . ' <' . $email . '>')
	);

	it_specialist_redirect_with_notice($sent ? 'success' : 'error', 'service', 'services');
}
add_action('admin_post_nopriv_it_specialist_service', 'it_specialist_handle_service_request_form');
add_action('admin_post_it_specialist_service', 'it_specialist_handle_service_request_form');

function it_specialist_handle_newsletter_form() {
	if (!isset($_POST['it_specialist_newsletter_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['it_specialist_newsletter_nonce'])), 'it_specialist_newsletter_form')) {
		it_specialist_redirect_with_notice('error', 'newsletter', 'reviews');
	}

	$honeypot = isset($_POST['website']) ? sanitize_text_field(wp_unslash($_POST['website'])) : '';
	if (!empty($honeypot) || !it_specialist_can_submit_form('newsletter')) {
		it_specialist_redirect_with_notice('error', 'newsletter', 'reviews');
	}

	$email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
	if (!is_email($email)) {
		it_specialist_redirect_with_notice('error', 'newsletter', 'reviews');
	}

	$sent = wp_mail(
		it_specialist_get_forms_email(),
		'New Newsletter Subscription',
		"Email: {$email}"
	);

	it_specialist_redirect_with_notice($sent ? 'success' : 'error', 'newsletter', 'reviews');
}
add_action('admin_post_nopriv_it_specialist_newsletter', 'it_specialist_handle_newsletter_form');
add_action('admin_post_it_specialist_newsletter', 'it_specialist_handle_newsletter_form');

function it_specialist_form_notice($form_type) {
	$status = isset($_GET['form_status']) ? sanitize_text_field(wp_unslash($_GET['form_status'])) : '';
	$type   = isset($_GET['form_type']) ? sanitize_text_field(wp_unslash($_GET['form_type'])) : '';

	if ($type !== $form_type || !in_array($status, array('success', 'error'), true)) {
		return;
	}

	if ('success' === $status) {
		echo '<div class="form-notice form-notice-success">Form submitted successfully. We will contact you soon.</div>';
		return;
	}

	echo '<div class="form-notice form-notice-error">Submission failed. Check your input and try again.</div>';
}
