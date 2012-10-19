<?php
/**
 * The template for displaying all destinations.
 *
 * Template Name: Destinations Template
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

	<section id="featured-destinations-primary">
		<div id="content" role="main">
		<?php query_posts(array('post_type'=>'destination', 'posts_per_page' => -1)); ?>
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<ul id="featured-destinations">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<li>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
					echo "<a href='".get_permalink()."'>" . get_the_post_thumbnail() . "</a>";

				?>
					<h1><?php the_title(); ?></h1>
					<div id="content-wrapper"><?php the_excerpt();//get_template_part( 'content', get_post_format()); ?></div>
				</li>
			<?php endwhile; ?>
			</ul>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

		<!-- <div id="primary"> -->
			<!-- <div id="content" role="main"> -->

				<?php //query_posts(array('post_type'=>'destination')); ?>

				<?php //while ( have_posts() ) : the_post(); ?>

					<?php //get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', true ); ?>

				<?php //endwhile; // end of the loop. ?>

			<!-- </div>#content -->
		<!-- </div>#primary -->

<?php get_footer(); ?>