<?php
/**
 * WordPress Template: Single-Work
 *
 **/
?>
<?php get_template_part('ajax-header'); ?>
<div id="fancybox-container">
		<div id="content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="collaborator">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<div class="profile-image">
						<?php if(has_post_thumbnail()): ?>
							<?php the_post_thumbnail('medium'); ?>
						<?php else: ?>
						<?php endif; ?>
					</div>
					<?php the_content();?>
				</div>
			</div>

		<?php endwhile; ?>
		</div>
	</div>