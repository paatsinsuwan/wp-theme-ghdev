<?php
/**
 * WordPress Template: Collaborator
 *
 * The collaborator template is used for Collaborators.
 *
 * @package 7thaven
 * @subpackage Template
 */

get_template_part( 'header' ); ?>

<h1>Collaborators</h1>
<?php if (have_posts()): ?>
	<?php do_action('loop_open') ?>
		<?php while(have_posts()) : the_post(); ?>
			<div class="collaborator">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php do_action('loop_close') ?>
<?php endif ?>

<?php get_template_part( 'footer' ); ?>