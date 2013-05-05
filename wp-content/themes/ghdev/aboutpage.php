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
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>

				
			</div><!-- #content -->
		</div><!-- #primary -->
		<div id="sidebar" role="sidebar"><?php get_sidebar(); ?></div>

<?php get_footer(); ?>
