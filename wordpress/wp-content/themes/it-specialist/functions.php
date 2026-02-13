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

function it_specialist_default_demo_content() {
	return array(
		'site'         => array(
			'title'   => 'Alex Carter IT Specialist',
			'tagline' => 'Practical IT support, automation, and cloud operations for small business teams.',
		),
		'contacts'     => array(
			'phone'         => '+1 (646) 555-0142',
			'email'         => 'hello@alexcarter-it.com',
			'telegram_url'  => 'https://t.me/alexcarterit',
			'whatsapp_url'  => 'https://wa.me/16465550142',
			'address'       => '350 5th Ave, New York, NY 10118, USA',
			'city'          => 'New York',
			'linkedin_url'  => 'https://www.linkedin.com/in/alexcarterit',
			'forms_email'   => 'hello@alexcarter-it.com',
		),
		'homepage'     => array(
			'hero_h1'       => 'IT support that keeps your business online and predictable',
			'hero_subtitle' => 'I help teams reduce incidents, speed up onboarding, and keep infrastructure healthy with measurable service routines.',
			'services_cards' => array(
				array(
					'title'       => 'Managed IT Support',
					'description' => 'Daily monitoring, ticket handling, patching, and end-user support with clear SLAs.',
				),
				array(
					'title'       => 'Cloud and DevOps',
					'description' => 'Migration planning, CI/CD setup, and cloud cost optimization for stable releases.',
				),
				array(
					'title'       => 'Security and Backup',
					'description' => 'Security baselines, backup policies, and recovery drills to reduce business risk.',
				),
			),
		),
		'about'        => array(
			'intro' => 'I am a systems-focused IT specialist with 8+ years of hands-on support for product teams, agencies, and local businesses.',
			'sections' => array(
				array(
					'title'   => 'How I work',
					'text'    => 'I prioritize reliability first: stabilize, document, automate, then scale.',
					'bullets' => array(
						'Incident prevention through monitoring and runbooks',
						'Clear communication with business-friendly status updates',
						'Security-first defaults for access and backups',
					),
				),
				array(
					'title'   => 'Typical outcomes',
					'text'    => 'Most clients see faster issue resolution and lower downtime within the first month.',
					'bullets' => array(
						'Fewer repeated support tickets',
						'Faster onboarding for new employees',
						'Predictable change windows and release quality',
					),
				),
			),
		),
		'services'     => array(
			'intro' => 'Service packages are adapted to your team size, current stack, and growth stage.',
			'pricing_policy' => 'Final pricing depends on scope, urgency, and current infrastructure maturity.',
			'items' => array(
				array(
					'name'    => 'Managed IT Support',
					'includes'=> array(
						'Monitoring and alert triage',
						'Patch management and routine maintenance',
						'User support for hardware/software issues',
					),
					'result'  => 'Stable day-to-day operations and fewer unplanned outages.',
					'notes'   => 'Best for teams needing a reliable technical partner.',
				),
				array(
					'name'    => 'Cloud Migration and Optimization',
					'includes'=> array(
						'Current-state infrastructure assessment',
						'Migration roadmap with rollback strategy',
						'Post-migration performance and cost tuning',
					),
					'result'  => 'Safer cloud adoption with minimal business disruption.',
					'notes'   => 'Works for both first-time migrations and cleanup projects.',
				),
				array(
					'name'    => 'Security and Backup Program',
					'includes'=> array(
						'Access policy hardening',
						'Backup schedule design and validation',
						'Recovery scenario testing',
					),
					'result'  => 'Reduced impact from incidents and stronger compliance posture.',
					'notes'   => 'Recommended for regulated or customer-facing environments.',
				),
			),
		),
		'reviews'      => array(
			'intro' => 'Recent client feedback after support, migration, and hardening projects.',
			'items' => array(
				array(
					'author' => 'Operations Lead, eCommerce Team',
					'rating' => 5,
					'text'   => 'Response times improved quickly. We now have predictable maintenance and fewer urgent outages.',
				),
				array(
					'author' => 'Founder, SaaS Startup',
					'rating' => 5,
					'text'   => 'Cloud migration was organized and low-risk. Deployment became more stable within two weeks.',
				),
				array(
					'author' => 'Office Manager, Healthcare Clinic',
					'rating' => 4,
					'text'   => 'Communication was clear and practical. Backup verification gave us real confidence.',
				),
			),
			'profile_link_placeholder' => '#',
		),
		'contacts_page' => array(
			'intro'              => 'Send a message with your current issue or project goal. I typically reply within one business day.',
			'preferred_channels' => array('Email', 'WhatsApp', 'Telegram'),
			'availability'       => 'Mon-Fri, 9:00-18:00 (Eastern Time). Emergency support by prior agreement.',
			'google_maps_embed'  => 'https://www.google.com/maps?q=350+5th+Ave,+New+York,+NY+10118&output=embed',
		),
		'pages_meta'   => array(
			'home'      => array(
				'title'       => 'IT Specialist in New York | Managed Support and Cloud Services',
				'description' => 'Reliable IT specialist services: support, cloud migration, security, and automation for growing teams.',
			),
			'about'     => array(
				'title'       => 'About Alex Carter | IT Specialist',
				'description' => 'Learn about experience, approach, and outcomes from practical IT operations and automation projects.',
			),
			'services'  => array(
				'title'       => 'IT Services | Support, Cloud, Security',
				'description' => 'Explore managed IT support, cloud migration, and security/backup services tailored to business goals.',
			),
			'portfolio' => array(
				'title'       => 'Portfolio | IT Projects and Case Results',
				'description' => 'Review selected IT projects including migrations, support automation, and infrastructure hardening.',
			),
			'reviews'   => array(
				'title'       => 'Client Reviews | IT Specialist Feedback',
				'description' => 'Read client feedback on reliability, response quality, and project outcomes.',
			),
			'contacts'  => array(
				'title'       => 'Contacts | Talk to an IT Specialist',
				'description' => 'Contact by email, Telegram, or WhatsApp to discuss support tasks and project scope.',
			),
		),
		'blog_posts'   => array(
			array(
				'title'   => 'How to Reduce Repeated IT Incidents in 30 Days',
				'slug'    => 'reduce-repeated-it-incidents',
				'excerpt' => 'A practical runbook-first process to reduce recurring support tickets and downtime.',
				'content' => '<p>Start with incident categories and count repeats weekly. Then build one actionable runbook per top category.</p><p>Track response time, resolution time, and repeat rate. After two weeks, enforce change windows and backup checks.</p>',
			),
			array(
				'title'   => 'Small Business Cloud Migration Checklist',
				'slug'    => 'small-business-cloud-migration-checklist',
				'excerpt' => 'Key checks before, during, and after migration to avoid common outages.',
				'content' => '<p>Document dependencies, define rollback, and test backups before moving production workloads.</p><p>After migration, validate monitoring, access policies, and spending alerts in the first 72 hours.</p>',
			),
			array(
				'title'   => 'Backup Validation: What Most Teams Miss',
				'slug'    => 'backup-validation-what-teams-miss',
				'excerpt' => 'Backups are only useful if restore steps are tested and timed.',
				'content' => '<p>Pick critical systems and perform scheduled restore drills. Record exact restore time and blockers.</p><p>Use findings to improve runbooks and set realistic recovery expectations with stakeholders.</p>',
			),
		),
	);
}

function it_specialist_get_demo_content() {
	$content = get_option('it_specialist_demo_content', array());
	if (!is_array($content) || empty($content)) {
		$content = it_specialist_default_demo_content();
	}
	return $content;
}

function it_specialist_get_contact_value($mod_key, $legacy_key, $content_key, $fallback = '') {
	$demo     = it_specialist_get_demo_content();
	$contacts = isset($demo['contacts']) && is_array($demo['contacts']) ? $demo['contacts'] : array();
	$from_mod = get_theme_mod($mod_key, '');
	if ($from_mod !== '') {
		return $from_mod;
	}

	$from_legacy = get_theme_mod($legacy_key, '');
	if ($from_legacy !== '') {
		return $from_legacy;
	}

	if (isset($contacts[$content_key]) && $contacts[$content_key] !== '') {
		return $contacts[$content_key];
	}

	return $fallback;
}

function it_specialist_register_customizer($wp_customize) {
	$wp_customize->add_section(
		'it_specialist_contact_section',
		array(
			'title'    => __('IT Specialist Contacts', 'it-specialist'),
			'priority' => 40,
		)
	);

	$settings = array(
		'it_specialist_phone'         => '+1 (000) 000-0000',
		'it_specialist_email'         => 'contact@example.com',
		'it_specialist_telegram_url'  => 'https://t.me/yourusername',
		'it_specialist_whatsapp_url'  => 'https://wa.me/10000000000',
		'it_specialist_address'       => 'New York, NY',
		'it_specialist_city'          => 'New York',
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
	if (!$custom_email) {
		$custom_email = it_specialist_get_contact_value('forms_email', 'it_specialist_forms_email', '');
	}
	return $custom_email ? sanitize_email($custom_email) : get_option('admin_email');
}

function it_specialist_get_page_meta() {
	$description = 'IT specialist services: support, cloud, security, and automation.';
	$title       = '';
	if (is_page()) {
		$page = get_queried_object();
		if ($page && isset($page->post_name)) {
			$slug      = sanitize_title($page->post_name);
			$demo      = it_specialist_get_demo_content();
			$pages_meta = isset($demo['pages_meta']) && is_array($demo['pages_meta']) ? $demo['pages_meta'] : array();
			if (isset($pages_meta[$slug]) && is_array($pages_meta[$slug])) {
				$title       = isset($pages_meta[$slug]['title']) ? sanitize_text_field($pages_meta[$slug]['title']) : '';
				$description = isset($pages_meta[$slug]['description']) ? sanitize_text_field($pages_meta[$slug]['description']) : $description;
			}
		}
	}

	return array(
		'title'       => $title,
		'description' => $description,
	);
}

function it_specialist_filter_document_title($title) {
	$meta = it_specialist_get_page_meta();
	return $meta['title'] ? $meta['title'] : $title;
}
add_filter('pre_get_document_title', 'it_specialist_filter_document_title');

function it_specialist_print_meta_description() {
	$meta = it_specialist_get_page_meta();
	echo '<meta name="description" content="' . esc_attr($meta['description']) . '">' . "\n";
}
add_action('wp_head', 'it_specialist_print_meta_description', 1);

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
