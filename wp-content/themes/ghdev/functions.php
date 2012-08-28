<?php
/**
 * WordPress Template: Functions
 * 
 * This file is automatically loaded by WordPress.
 * functions.php bootstraps and initialization WP Framework.
 *
 * @package 7thaven
 * @subpackage Template
 */

/**
 * NOTE: USE custom-functions.php instead of this file.
 */

add_theme_support('post-thumbnails', array( 'collaborator', 'work' ));
add_action('init', 'custom_define');
add_action('init', 'custom_enqueue_style');
add_action('init', 'custom_enqueue_script');

require_once( TEMPLATEPATH . '/work-type.php');
require_once( TEMPLATEPATH . '/collaborators-type.php');

function custom_enqueue_style(){
	wp_enqueue_style('boiler-plate',  THEME_LIBRARY . '/css/boiler_plate.css', '', '');
	wp_enqueue_style('font', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,300,600,800', '', '');
	wp_enqueue_style('7thaven',  THEME_LIBRARY . '/css/7thaven.css', array('boiler-plate', 'font'), '');
	wp_enqueue_style('fancybox', THEME_LIBRARY . '/css/jquery.fancybox.css', '', '');
}
function custom_enqueue_script(){
	wp_enqueue_script('jquery', THEME_LIBRARY . '/js/libs/jquery-1.7.1.min.js', '', '');
	wp_enqueue_script('modernizr', THEME_LIBRARY . '/js/libs/modernizr-2.5.3.min.js', '', '');
	wp_enqueue_script('plugins', THEME_LIBRARY . '/js/plugins.js', '', '');
	wp_enqueue_script('jquery-color', THEME_LIBRARY . '/js/libs/jquery.color.js', '', '');
	wp_enqueue_script('jquery-mousewheel', THEME_LIBRARY . '/js/libs/jquery.mousewheel-3.0.6.pack.js', '', '');
	wp_enqueue_script('fancybox', THEME_LIBRARY . '/js/libs/jquery.fancybox.js', '', '');
	wp_enqueue_script('flip', THEME_LIBRARY . '/js/libs/jquery.flip.min.js', '', '');
	wp_enqueue_script('script', THEME_LIBRARY . '/js/script.js', '', '');
	wp_enqueue_script('analytics', THEME_LIBRARY . '/js/ga.js', '', '');
}
function custom_define(){
	if(!defined('THEME_LIBRARY')){
		define('THEME_LIBRARY', get_template_directory_uri() . '/Library');
	}
	if(!defined('THEME_IMG')){
		define('THEME_IMG', THEME_LIBRARY . '/img');
	}
}

function seventhaven_nav_menu() { ?>
	<ul class="main-navigation">
		<?php $is_home = is_page('team') || is_page('clients'); ?>
		<li <?php if(is_home() || $is_home || get_post_type() == 'collaborator')  echo "class='current-menu-item'"; ?>>
			<?php $blog_home_url = home_url( '/' )."7thaven/"; ?>
			<a href="<?php echo $blog_home_url; ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<ul class="sub-navigation">
				<li><a href="<?php echo $blog_home_url."team";?>">team</a></li>
				<li><a href="<?php echo home_url( '/' )."collaborators";?>">collaborators</li>
				<li><a href="<?php echo $blog_home_url."clients";?>">clients</a></li>
			</ul>
		</li>
		<li <?php if(is_page('about')) echo "class='current-menu-item'"; ?>><a href="<?php echo home_url( '/' ).'about'; ?>">about</a></li>
		<?php $work_type = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
		<li <?php if(get_post_type() == 'work' || !empty($work_type)) echo "class='current-menu-item'"; ?>>
			<?php $work_type_url = home_url( '/' )."work_type/"; ?>
			<a style="cursor: pointer;">work</a>
			<ul class="sub-navigation">
				<?php
					// auto populate for all types
					//list terms in a given taxonomy using wp_list_categories  (also useful as a widget)
					$orderby = 'name';
					$show_count = 0; // 1 for yes, 0 for no
					$pad_counts = 0; // 1 for yes, 0 for no
					$hierarchical = 1; // 1 for yes, 0 for no
					$taxonomy = 'work_type';
					$title = '';
					$hide_empty = 0;

					$args = array(
					  'orderby' => $orderby,
					  'show_count' => $show_count,
					  'pad_counts' => $pad_counts,
					  'hierarchical' => $hierarchical,
					  'taxonomy' => $taxonomy,
					  'title_li' => $title,
					  'hide_empty' => $hide_empty,
					  'echo' => 0
					);
					$list = wp_list_categories($args);
					echo $list;
				?>
				<!-- <li><a href="<?php //echo $work_type_url."music/";?>">music</a></li> -->
				<!-- <li><a href="<?php //echo $work_type_url."fashion/";?>">fashion</a></li> -->
				<!-- <li><a href="<?php //echo $work_type_url."film/";?>">film</a></li> -->
				<!-- <li><a href="<?php //echo $work_type_url."print/";?>">print</a></li> -->
			</ul>
		</li>
		<li <?php if(is_page('contact')) echo "class='current-menu-item'"; ?>><a href="<?php echo home_url( '/' ).'contact'; ?>">contact us</a></li>
	</ul>
<?php } ?>