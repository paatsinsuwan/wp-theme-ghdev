<?php
/**
 * The template for displaying frequently asked questions.
 *
 * Template Name: FAQs
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

<section id="faqs-primary">
	<div id="content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; // end of the loop. ?>
		<div id="back-to-top">
			<a href="#access">top</a>
		</div>
		<div style="clear:both;"></div>
	</div>
</section>

<?php get_footer(); ?>