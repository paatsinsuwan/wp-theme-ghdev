<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'blog');//get_post_format() ); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

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
			            action: 'hover',                          //options: 'click' or 'hover', action to trigger animation
			            topPos: '60px',                          //position from the top/ use if tabLocation is left or right
			            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
			            fixedPosition: true                    //options: true makes it stick(fixed position) on scroll
			        });
			});

			</script>
		</div>

<?php get_sidebar("ads"); ?>
<?php get_footer(); ?>