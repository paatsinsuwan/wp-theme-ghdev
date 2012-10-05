<?php
/**
 * The template for displaying Featured Destinations Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<?php 
?>

		<section id="featured-destinations-primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<ul id="featured-destinations">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php 
						$tax = get_post_custom_values('taxonomy'); 
					?> 
					<li>
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						//get_template_part( 'content', get_post_format() );
						echo "<a href='".get_bloginfo('siteurl')."/featured-destinations/".$tax[0]."'>" . get_the_post_thumbnail() . "</a>";

					?>
						<h1><?php the_title(); ?></h1>
						<div id="content-wrapper"><?php get_template_part( 'content', get_post_format()); ?></div>
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

<?php get_footer(); ?>
