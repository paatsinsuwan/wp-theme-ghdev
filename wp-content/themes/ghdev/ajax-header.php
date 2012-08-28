<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php do_action( 'pre_wp_head' ); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php wp_head(); ?>
	<style type="text/css" media="screen">
		html {
			margin: 0px !important;
		}
	</style>
</head>