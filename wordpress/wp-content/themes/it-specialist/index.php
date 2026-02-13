<?php
/**
 * Main template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<div class="container">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article class="card">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<article class="card">
			<h1><?php esc_html_e('No content found', 'it-specialist'); ?></h1>
		</article>
	<?php endif; ?>
</div>
<?php
get_footer();
