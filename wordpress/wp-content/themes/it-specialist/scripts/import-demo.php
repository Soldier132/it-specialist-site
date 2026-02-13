<?php
if (!defined('ABSPATH')) {
	exit("Run via: wp eval-file wp-content/themes/it-specialist/scripts/import-demo.php --allow-root\n");
}

$json_path = ABSPATH . 'docs/demo-content.json';
if (!file_exists($json_path)) {
	WP_CLI::error('Missing docs/demo-content.json inside container.');
}

$raw  = file_get_contents($json_path);
$data = json_decode($raw, true);
if (!is_array($data)) {
	WP_CLI::error('Invalid JSON in docs/demo-content.json.');
}

switch_theme('it-specialist');
update_option('it_specialist_demo_content', $data);

$site = isset($data['site']) && is_array($data['site']) ? $data['site'] : array();
if (!empty($site['title'])) {
	update_option('blogname', sanitize_text_field($site['title']));
}
if (!empty($site['tagline'])) {
	update_option('blogdescription', sanitize_text_field($site['tagline']));
}

update_option('permalink_structure', '/%postname%/');
flush_rewrite_rules(true);

$page_ids = array();
$pages    = isset($data['pages']) && is_array($data['pages']) ? $data['pages'] : array();
foreach ($pages as $key => $page) {
	$title   = isset($page['title']) ? sanitize_text_field($page['title']) : ucfirst($key);
	$slug    = isset($page['slug']) ? sanitize_title($page['slug']) : sanitize_title($key);
	$content = isset($page['content']) ? wp_kses_post($page['content']) : '';

	$existing = get_page_by_path($slug, OBJECT, 'page');
	$postarr  = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'page',
	);

	if ($existing) {
		$postarr['ID'] = $existing->ID;
		$page_id       = wp_update_post($postarr, true);
	} else {
		$page_id = wp_insert_post($postarr, true);
	}

	if (is_wp_error($page_id)) {
		WP_CLI::warning('Failed page: ' . $slug . ' -> ' . $page_id->get_error_message());
		continue;
	}
	$page_ids[$slug] = (int) $page_id;
}

if (!empty($page_ids['home'])) {
	update_option('show_on_front', 'page');
	update_option('page_on_front', $page_ids['home']);
}

$menu_name = 'Primary';
$menu_obj  = wp_get_nav_menu_object($menu_name);
$menu_id   = $menu_obj ? (int) $menu_obj->term_id : wp_create_nav_menu($menu_name);
if (!is_wp_error($menu_id)) {
	$existing_items = wp_get_nav_menu_items($menu_id);
	if (is_array($existing_items)) {
		foreach ($existing_items as $item) {
			wp_delete_post($item->ID, true);
		}
	}

	$menu_order = array('home', 'about', 'services', 'portfolio', 'reviews', 'contacts');
	foreach ($menu_order as $slug) {
		if (empty($page_ids[$slug])) {
			continue;
		}
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => get_the_title($page_ids[$slug]),
				'menu-item-object'    => 'page',
				'menu-item-object-id' => $page_ids[$slug],
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
			)
		);
	}

	$locations            = (array) get_theme_mod('nav_menu_locations', array());
	$locations['primary'] = $menu_id;
	set_theme_mod('nav_menu_locations', $locations);
}

$contacts = isset($data['contacts']) && is_array($data['contacts']) ? $data['contacts'] : array();
set_theme_mod('it_specialist_phone', isset($contacts['phone']) ? sanitize_text_field($contacts['phone']) : '');
set_theme_mod('it_specialist_email', isset($contacts['email']) ? sanitize_email($contacts['email']) : '');
set_theme_mod('it_specialist_telegram_url', isset($contacts['telegram_url']) ? esc_url_raw($contacts['telegram_url']) : '');
set_theme_mod('it_specialist_whatsapp_url', isset($contacts['whatsapp_url']) ? esc_url_raw($contacts['whatsapp_url']) : '');
set_theme_mod('it_specialist_address', isset($contacts['address']) ? sanitize_text_field($contacts['address']) : '');
set_theme_mod('it_specialist_city', isset($contacts['city']) ? sanitize_text_field($contacts['city']) : '');
set_theme_mod('it_specialist_linkedin', isset($contacts['linkedin_url']) ? esc_url_raw($contacts['linkedin_url']) : '');
set_theme_mod('it_specialist_forms_email', isset($contacts['forms_email']) ? sanitize_email($contacts['forms_email']) : '');

$posts = isset($data['blog_posts']) && is_array($data['blog_posts']) ? $data['blog_posts'] : array();
foreach ($posts as $post) {
	$title   = isset($post['title']) ? sanitize_text_field($post['title']) : '';
	$slug    = isset($post['slug']) ? sanitize_title($post['slug']) : '';
	$content = isset($post['content']) ? wp_kses_post($post['content']) : '';
	$excerpt = isset($post['excerpt']) ? sanitize_text_field($post['excerpt']) : '';
	if (!$title || !$slug) {
		continue;
	}

	$existing = get_page_by_path($slug, OBJECT, 'post');
	$postarr  = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
		'post_excerpt' => $excerpt,
		'post_status'  => 'publish',
		'post_type'    => 'post',
	);

	if ($existing) {
		$postarr['ID'] = $existing->ID;
		$post_id       = wp_update_post($postarr, true);
	} else {
		$post_id = wp_insert_post($postarr, true);
	}

	if (is_wp_error($post_id)) {
		WP_CLI::warning('Failed post: ' . $slug . ' -> ' . $post_id->get_error_message());
	}
}

WP_CLI::success('Demo content imported and configured.');
