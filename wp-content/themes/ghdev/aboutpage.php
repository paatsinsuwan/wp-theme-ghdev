<?php
/**
 * Template Name: About Page Template
 * The homepage template file.
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

		<div id="about_primary">
			<div id="content" role="main" class="clearfix">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_sidebar(); ?>
					<?php $content = get_the_content();//get_template_part( 'content', get_post_format() ); ?>
					<p><?php echo $content; ?></p>
				<?php endwhile; ?>

				
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
