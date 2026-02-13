<?php
/**
 * Header template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="container header-inner">
		<div class="site-branding">
			<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
		</div>
		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
			Menu
		</button>
		<nav id="primary-navigation" class="site-navigation" aria-label="<?php esc_attr_e('Main navigation', 'it-specialist'); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'primary-menu',
					'fallback_cb'    => 'wp_page_menu',
				)
			);
			?>
		</nav>
	</div>
</header>
<main class="site-main">
