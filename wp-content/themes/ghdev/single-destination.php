<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="destination-primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'single_destination' ); ?>

					<?php 
						// The $tax
						$tax = get_post_custom_values('taxonomy');
						// The $agrs
						$args = array('post_type' => 'post', 'tag' => $tax[0]);
						// The Query
						query_posts( $args );

						// The Loop
						echo '<ul>';
						while ( have_posts() ) : the_post();
							echo '<li>';
							echo "<a href='".get_permalink()."'>" . get_the_post_thumbnail() . "</a>";
							echo '</li>';
						endwhile;
						echo '</ul>';

						// Reset Query
						wp_reset_query();
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>