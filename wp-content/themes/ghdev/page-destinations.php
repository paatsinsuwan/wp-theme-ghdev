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
			            action: 'hover',                          //options: 'click' or 'hover', action to trigger animation
			            topPos: '60px',                          //position from the top/ use if tabLocation is left or right
			            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
			            fixedPosition: true                    //options: true makes it stick(fixed position) on scroll
			        });
			});

			</script>
		</div>
<?php get_footer(); ?>