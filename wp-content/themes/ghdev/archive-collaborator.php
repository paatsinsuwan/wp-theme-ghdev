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
		<div class="collaborator-wrapper">
			<ul>
			<?php while(have_posts()) : the_post(); ?>
				<a class="fancybox fancybox.iframe" href="<?php the_permalink(); ?>">
				<li class="collaborator">
					<?php the_post_thumbnail(array(120, 120)); ?>
					<p><?php the_title(); ?></p>
				</li>
				</a>
			<?php endwhile; ?>
			</ul>
		</div>
	<?php do_action('loop_close') ?>
<?php endif ?>

<?php get_template_part( 'footer' ); ?>