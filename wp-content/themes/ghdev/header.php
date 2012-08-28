<?php
/**
 * WordPress Template: Header
 *
 * The header template is used as the primary header for your website.
 * Generally, all other WordPress templates rely on this file as it
 * contains all the opening HTML tags closed in the footer.php file.
 * It also executes key functions needed by WordPress,
 * the parent/child theme, and/or plugins.
 *
 * @package 7THAVEN
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php do_action( 'pre_wp_head' ); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<?php do_action( 'body_open' ); ?>
	<?php  ?>
	<header id="header" role="banner">

		<?php do_action( 'header_open' ); ?>

		<div id="branding" class="wrap">

			<?php do_action( 'branding_open' ); ?>

			<div id="site-title-wrap" class="column-7">
				<?php seventhaven_nav_menu(); ?>
			</div><!--#site-title-wrap+#navigation-->

			<?php do_action( 'branding_close' ); ?>

		</div><!--#branding-->

		<?php do_action( 'header_close' ); ?>

	</header><!--header-->
	<div id="container" class="wrap">

		<?php do_action( 'container_open' ); ?>

		<?php do_action( 'between_header_main' ); ?>

		<div id="main" role="main">
		
			<?php do_action( 'main_open' ); ?>

			<div class="wrap">
			
				<?php do_action( 'main_wrap_open' ); ?>