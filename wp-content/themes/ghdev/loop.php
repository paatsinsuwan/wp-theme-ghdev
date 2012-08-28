<?php if (have_posts()): ?>
	<?php do_action('loop_open') ?>
		<?php while(have_posts()) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" class="post">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<p class="post-content"><?php the_content(); ?></p>
			</div>
		<?php endwhile; ?>
	<?php do_action('loop_close') ?>
<?php endif ?>