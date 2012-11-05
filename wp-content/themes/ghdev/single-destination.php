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
						$args = array('post_type' => 'post', 'tag' => $tax[0], 'posts_per_page' => 3);
						// The Query
						query_posts( $args );

						echo '<h1>Latest ' . str_replace('-', " ", $tax[0]) . ' blog posts</h1>';
						// The Loop
						echo '<ul>';
						while ( have_posts() ) : the_post();
							echo '<li>';
							echo "<a href='".get_permalink()."'>" . get_the_post_thumbnail() . "</a>";
							echo the_excerpt();
							echo '</li>';
						endwhile;
						echo '</ul>';

						// Reset Query
						wp_reset_query();
					?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		<script src="<?php bloginfo('template_url'); ?>/js/jquery.tabSlideOut.v1.3.js"></script>
		<style type="text/css">
		.slide-out-div {
			background: #e4e4e4;
			width: 300px;
			padding: 10px;
			z-index: 9999;
			height: 380px;
			border-bottom-left-radius: 5px;
			border-top: 1px solid rgba(0, 0, 0, 0.3);
			border-left: 1px solid rgba(0, 0, 0, 0.3);
			border-bottom: 1px solid rgba(0, 0, 0, 0.3);
		}
		.slide-out-div .handle {
			border-bottom-left-radius: 5px;
			border-top-left-radius: 5px;
			border-top: 1px solid rgba(0, 0, 0, 0.3);
			border-left: 1px solid rgba(0, 0, 0, 0.3);
			border-bottom: 1px solid rgba(0, 0, 0, 0.3);
			top: -1px !important;
		}
		.slide-out-div #secondary {
			width: 60%;
			margin-top: 1em;
			margin-right: 10em;
		}
		</style>
		<div class="slide-out-div">
			<a class="handle" href="http://link-for-non-js-users.html">Content</a>
			<?php get_sidebar(); ?>
			<script type="text/javascript">

			jQuery(function(){
			        jQuery('.slide-out-div').tabSlideOut({
			            tabHandle: '.handle',                     //class of the element that will become your tab
			            pathToTabImage: '<?php bloginfo("template_url"); ?>/images/Book_Now_Tab.png', //path to the image for the tab //Optionally can be set using css
			            imageHeight: '179px',                     //height of tab image           //Optionally can be set using css
			            imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
			            tabLocation: 'right',                      //side of screen where tab lives, top, right, bottom, or left
			            speed: 300,                               //speed of animation
			            action: 'click',                          //options: 'click' or 'hover', action to trigger animation
			            topPos: '60px',                          //position from the top/ use if tabLocation is left or right
			            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
			            fixedPosition: true                    //options: true makes it stick(fixed position) on scroll
			        });
			});

			</script>
		</div>
<?php get_footer(); ?>