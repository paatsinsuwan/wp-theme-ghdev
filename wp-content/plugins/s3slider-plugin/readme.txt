=== S3Slider ===

Contributors: viniciusmassuchetto
Donate link: http://vinicius.soylocoporti.org.br/s3slider-plugin-for-wordpress/
Tags: s3slider, jquery, slide, javascript, animation, banner
Contributors: viniciusmassuchetto
Requires at least: 2.0.2
Tested up to: 3.0.2
Stable tag: 0.08

Plugin to manage and generate a nice image sliding effect in your blog.
S3Slider and jQuery based.

== Description ==

This plugins is nothing else than a front-end to the nice
<a href="http://www.serie3.info/s3slider/">S3Slider</a> jQuery plugin
that lets you:

1. Upload and crop images;
2. Set the size, order and timout of the slider;
3. Edit a text to be shown on each image;

S3Slider can be seen in action <a href="http://www.kruskica.net/">here</a>.

== Installation ==

It's easy to install.

1. Extract `s3slider.zip` and upload the folder `s3slider` to the `/wp-content/plugins/` directory;
2. Activate the plugin through the `Plugins` menu in WordPress
3. Place something like `<?php if (function_exists(s3slider_show())) { s3slider_show(); } ?>` in your templates

== Frequently Asked Questions ==

Nothing here until now. Visit the <a href="http://vinicius.soylocoporti.org.br/s3slider-plugin-for-wordpress/">plugin website</a> for more info.

== Screenshots ==

1. This is the panel screen with both options and upload section activated. Just to show how the plugin works globally.

== Changelog ==

= 0.08 =

* Added german translation. Thanks to stielglatze;

= 0.07 =

* Added the turkish translation. Thanks to Selçuk;

= 0.06 =

* Add simple html in the text or headline, eg making the title a link (must use single quotes for now);
* Make the image itself a link;
* Easily change the quality of the images (applies to jpegs only);
* The s3slider.js is queued through wordpress’s system and loads wordpress’s default jquery package. Hopefully this will help clear up some javascript issues and make multiple s3slider’s easier to implement in future versions.

Very thanks to Zack (http://zaybiz.com/) for this version.

= 0.05 =

Warning: Delete all the `s3s` tables from database before updating to this version;

* Drag and drop funcionality

= 0.04 =

* Support for png and gif file extensions;
* Title field added. Upgrade needs olders tables to be removed;
* IE6, IE7 and IE8 CSS compatibility is done.

Thanks to Bojan Josifoski who made all the fixes above.

= 0.03 =

* Fixed the '0' problem on text.

Thanks to Bojan Josifoski.

= 0.02 =

* Some fixes in backward compatibility and on options section.

Thanks to Krizalis (http://krizalis.my/).

= 0.01 =

* Plugin released, that's it.
