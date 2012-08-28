<?php get_header(); ?>

<?php // Get the data we need
	$worktype = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	$works = new WP_Query(
		array(
			'post_type' => 'work',
			'post_per_page' => '-1',
			'tax_query' => array(
				array(
					'taxonomy' => 'work_type',
					'field' => 'slug',
					'terms' => $worktype->name,
				)
			)
		)
	);
?>

	<div id="container">
		<div id="content" class="work_type">
			<h1 class="entry-title"><?php echo $worktype->name; ?></h1>
			<div class="entry-content">
				<div id="loading-wrapper">
					<img src="http://d1shb4dcbzk6lv.cloudfront.net/loading-gif.gif">
				</div>
				<ul id="work-list">
					<?php if($works->have_posts()): ?>
						<?php while ($works->have_posts()): $works->the_post();?>
							<?php do_action('loop_while_before'); ?>
							<?php $embeded_object_id = get_post_meta($post->ID, 'embeded_id', true); ?>
							<?php $embeded_host_type = get_post_meta($post->ID, 'host_type', true); ?>
							<?php if(!empty($embeded_object_id)) : ?>
								<?php
									$video_url = "<a href='".get_permalink($post->ID)."' class='video-item fancybox fancybox.iframe' video_id='$embeded_object_id' host_name='$embeded_host_type'>";
								?>
								<li id="work-<?php the_ID(); ?>" class="work">
									<?php echo $video_url; ?>
									<div class="work-item-wrapper">
										<div class="work-item-front face">

										</div>
										<div class="work-item-back face">
											<?php $this_post_title = get_the_title(); ?>
											<?php 
												if(empty($this_post_title)) {
													$this_post_title = "Untitled";
												} 
											?>
											<span><?php echo $this_post_title; ?></span>
										</div>
									</div>
									<?php echo "</a>"; ?>
								</li>
							<?php else : ?>
								<?php
									$image_url = "<a href='".get_permalink($post->ID)."' class='image-item fancybox fancybox.iframe'>";
								?>
								<li id="work-<?php the_ID(); ?>" class="work">
									<?php echo $image_url; ?>
									<div class="work-item-wrapper">
										<div class="work-item-front face type-image">
											<?php the_post_thumbnail(array(100, 100)); ?>
										</div>
										<div class="work-item-back face">
											<?php $this_post_title = get_the_title(); ?>
											<?php 
												if(empty($this_post_title)) {
													$this_post_title = "Untitled";
												} 
											?>
											<span><?php echo $this_post_title; ?></span>
										</div>
									</div>
									<?php echo "</a>"; ?>
								</li>
							<?php endif; ?>
							
							<?php do_action('loop_while_after'); ?>
						<?php endwhile; ?>
					<?php else: ?>
						<p>Coming Soon</p>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>

<?php get_footer(); ?>