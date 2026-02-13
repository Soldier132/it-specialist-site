<?php
/**
 * About page template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();

$demo     = it_specialist_get_demo_content();
$about    = isset($demo['about']) && is_array($demo['about']) ? $demo['about'] : array();
$intro    = isset($about['intro']) ? $about['intro'] : __('I am an IT specialist focused on stable operations, secure infrastructure, and practical automation that helps teams ship faster with fewer incidents.', 'it-specialist');
$sections = isset($about['sections']) && is_array($about['sections']) ? $about['sections'] : array();
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('About', 'it-specialist'); ?></h1>
		<p><?php echo esc_html($intro); ?></p>
	</section>

	<section class="section grid">
		<?php foreach ($sections as $section) : ?>
			<article class="card">
				<h2><?php echo esc_html(isset($section['title']) ? $section['title'] : ''); ?></h2>
				<p><?php echo esc_html(isset($section['text']) ? $section['text'] : ''); ?></p>
				<?php if (isset($section['bullets']) && is_array($section['bullets']) && !empty($section['bullets'])) : ?>
					<ul>
						<?php foreach ($section['bullets'] as $bullet) : ?>
							<li><?php echo esc_html($bullet); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</article>
		<?php endforeach; ?>
	</section>
</div>
<?php
get_footer();
