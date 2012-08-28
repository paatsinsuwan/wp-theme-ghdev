<?php
/**
 * WordPress Template: Single-Work
 *
 **/
?>

<?php get_template_part('ajax-header'); ?>

<?php $embeded_object_id = get_post_meta($post->ID, 'embeded_id', true); ?>
<?php $embeded_host_type = get_post_meta($post->ID, 'host_type', true); ?>
<?php $work_types = get_the_term_list($post->ID, 'work_type', '', ', ', ''); ?>
<div id="fancybox-container">
		<div id="content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="work">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				
				<!-- <div class="entry-meta">
					<span>Work Type: <?php echo $work_types; ?>
				</div>-->
				<div class="entry-content">
					<?php if(!empty($embeded_object_id)) : ?>
						<?php
							$iframe_url = "<iframe width='800' height='450' frameborder='' allowfullscreen ";
							switch($embeded_host_type){
								case "youtube":
									$iframe_url .= "src='http://www.youtube.com/embed/$embeded_object_id'></iframe>";
									break;
								case "vimeo":
									$iframe_url .= "src='http://player.vimeo.com/video/$embeded_object_id?title=0&amp;byline=0&amp;portrait=0></iframe>'";
									break;
								default :
									echo "<span class=''>Host of the content is not found.</span>";
									break;
							}
						?>
						<?php echo $iframe_url; ?>
					<?php endif; ?>
					<?php the_content();?>
				</div>
			</div>

		<?php endwhile; ?>
		</div>
	</div>
