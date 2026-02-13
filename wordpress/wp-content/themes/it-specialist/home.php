<?php
/**
 * Blog home template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<div class="container">
	<section class="hero">
		<h1><?php esc_html_e('Latest Articles', 'it-specialist'); ?></h1>
		<p><?php esc_html_e('Updates and notes from IT practice.', 'it-specialist'); ?></p>
	</section>
	<section class="section grid">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="card">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<article class="card">
				<h2><?php esc_html_e('No posts yet', 'it-specialist'); ?></h2>
			</article>
		<?php endif; ?>
	</section>
</div>
<?php
get_footer();
