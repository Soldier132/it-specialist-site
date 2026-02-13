<?php
/**
 * Generic page template.
 *
 * @package it-specialist
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>
<div class="container">
	<?php while (have_posts()) : the_post(); ?>
		<article class="card">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>
</div>
<?php
get_footer();
