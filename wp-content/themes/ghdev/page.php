<?php
/**
 * WordPress Template: Page
 *
 * The page template is used for Pages.
 *
 * @package 7thaven
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

<?php if (have_posts()): ?>
	<?php do_action('loop_open') ?>
		<?php while(have_posts()) : the_post(); ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php do_action('loop_close') ?>
<?php endif ?>

<?php get_template_part( 'footer' ); ?>