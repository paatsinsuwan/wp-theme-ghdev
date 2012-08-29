<?php
/*
Plugin Name: S3Slider
Plugin URI: http://vinicius.soylocoporti.org.br/s3slider-wordpress-plugin/
Description: S3Slider front-end for Wordpress. Plugin to manage and generate a nice image sliding effect in your blog. S3Slider and jQuery based.
Version: 0.06
Author: Vinicius Massuchetto
Author URI: http://vinicius.soylocoporti.org.br
*/

// Must be commented to activate plugin
//$wpdb->show_errors();

	
	
if ( function_exists('plugins_url') )
    $url = plugins_url(plugin_basename(dirname(__FILE__)));
else
    $url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));

    
    $s3s_pluginurl = $url;
    wp_enqueue_script( "s3slider",  $s3s_pluginurl."/js/s3slider.js", array( 'jquery' ) );
    
add_action('admin_menu', 's3slider_install');


function s3slider_install() {
    global $wpdb;
    add_menu_page('s3slider', 's3slider', 10, __FILE__, 's3slider_panel', $url.'../wp-content/plugins/s3slider-plugin/img/menu.gif');

    $query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}s3slider` (
        `s3slider_id` INT NOT NULL AUTO_INCREMENT,
        `s3slider_type` TEXT,
        `s3slider_order` INT,
        `s3slider_text` TEXT,
        `s3slider_text_headline` TEXT,
        `s3slider_x` INT,
        `s3slider_y` INT,
        `s3slider_x2` INT,
        `s3slider_y2` INT,
        `s3slider_w` INT,
        `s3slider_h` INT,
        `s3slider_image_link` TEXT,
    PRIMARY KEY ( `s3slider_id` ));";
    $wpdb->query($query);

    add_option('s3slider_width', 640);
    add_option('s3slider_height', 219);
    add_option('s3slider_timeout', 5000);
    add_option('s3slider_quality', 80);

    $s3s_plugindir = ABSPATH.'wp-content/plugins/s3slider-plugin/';
    load_textdomain('s3slider', $s3s_plugindir.'lang/'.WPLANG.'.mo');
}

function s3slider_panel() {
    include 's3slider-panel.php';
}

function s3slider_show() {
    if ( function_exists('plugins_url') )
        $url = plugins_url(plugin_basename(dirname(__FILE__)));
    else
        $url = get_option('siteurl') . '/wp-content/plugins/' . plugin_basename(dirname(__FILE__));
    global $wpdb;
    $s3s_plugindir = ABSPATH.'wp-content/plugins/s3slider-plugin/';
    $s3s_pluginurl = $url;
    $s3s_filesdir = ABSPATH.'wp-content/plugins/s3slider-plugin/files/';
    $s3s_filesurl = $url.'/files/';

    ?>
    <style type="text/css">
        #banner {
            position:relative;
            overflow: hidden;
        }
        #banner ul#bannerContent { width:<?php echo get_option('s3slider_width'); ?>px; position: absolute; top:0; margin: 0; list-style: none; padding: 0; }
        #banner ul#bannerContent li.bannerImage {
            float: left;
            position: relative;
            display: none; }
        #banner ul#bannerContent li.bannerImage span {
            position:absolute;
            bottom:0;
            font:normal 12px Arial, Helvetica, sans-serif;
            padding:10px;
            width:<?php echo get_option('s3slider_width'); ?>px;
            height:58px;
            /*background-color:#000;*/
            filter:alpha(opacity=0);
            -moz-opacity:0;
            -khtml-opacity:0;
            opacity:0;
            color:#fffdd6;
            display:none;}
        #banner ul#bannerContent li.bannerImage span strong { font-size: 14px; }
        #banner ul#bannerContent li.bannerImage div {
            cursor:pointer;
            position: absolute;
            bottom: 10px;
            right: 10px;
            font: normal 12px Arial, Helvetica, sans-serif;
            text-decoration: none;
            color: #fffdd6; }
        #banner ul#bannerContent .clear { clear: both; }
        #banner {
          width:<?php echo get_option('s3slider_width'); ?>px;
            height:<?php echo get_option('s3slider_height'); ?>px;
           position: relative; /* important */
           overflow: hidden; /* important */
           margin: 0 auto;
        }

        #bannerContent {
           width:<?php echo get_option('s3slider_width'); ?>px;
           position: absolute; /* important */
           top: 0; /* important */
           margin-left: 0; /* important */
        }

        .bannerImage {
           float: left; /* important */
           position: relative; /* important */
           display: none; /* important */

        }
        .content .widget ul li.bannerImage{padding:0;}
        .bannerImage span {
           position: absolute; /* important */
           left: 0;
           font: 10px/15px Arial, Helvetica, sans-serif;
           padding: 10px 13px;
           width:<?php echo get_option('s3slider_width'); ?>px;
           /*background-color: #000;*/
           filter: alpha(opacity=0); /* here you can set the opacity of box with text */
           -moz-opacity: 0; /* here you can set the opacity of box with text */
           -khtml-opacity: 0; /* here you can set the opacity of box with text */
           opacity: 0; /* here you can set the opacity of box with text */
           color: #fff;
           display: none; /* important */
           bottom: 0;
        }
        .clear {
           clear: both;
        }
    </style>
                    
    <script type="text/javascript">

        var $b = jQuery.noConflict();

        $b(document).ready(function() {
            $b('#banner').s3Slider({
                timeOut: <?php echo get_option('s3slider_timeout'); ?>,
                faderStat: false 
            });
        });


    </script>

    <div id="banner">
        <ul id="bannerContent">
            <?php $items = $wpdb->get_results("SELECT s3slider_id,s3slider_type,s3slider_text,s3slider_text_headline,s3slider_image_link FROM {$wpdb->prefix}s3slider ORDER BY s3slider_order,s3slider_id"); ?>
            <?php foreach($items as $item) : ?>
                <li class="bannerImage">
                
                    <?php 
                    if(!$item->s3slider_image_link){ ?>
                    <img src="<?php echo $s3s_filesurl.$item->s3slider_id.'_s.'.$item->s3slider_type; ?>" />
                    <?php } else { ?>
                    <a href="<?php echo $item->s3slider_image_link;?>"><img src="<?php echo $s3s_filesurl.$item->s3slider_id.'_s.'.$item->s3slider_type; ?>" /></a>
                    <?php } ?>
                    
                        <span>
                            <strong><?php echo stripslashes($item->s3slider_text_headline); ?></strong>
                                    <br />
                                    <?php echo stripslashes($item->s3slider_text); ?>
                        </span>
                </li>
            <?php endforeach; ?>
            <div class="clear bannerImage"></div>
        </ul>
    </div>

    <?php
    }
?>
