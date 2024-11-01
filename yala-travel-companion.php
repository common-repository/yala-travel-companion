<?php
/**
 * @package Yala_Travel_Companion
 */
/*
Plugin Name: Yala Travel Companion
Description: Used for Yala Travel Theme for Itinerary And Extra fields.
Version: 1.0.1
Author: yalathemes
Author URI: https://yalathemes.com/
License: GPLv2 or later
Text Domain: travel-woocommerce-extension
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2020 Yalathemes
*/

//If this file is ccalled directly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You idiot man!' );

/**
 * The code that runs during plugin activation
 */
function ytc_plugin_activate() {
	require_once('inc/Activate.php');
}

register_activation_hook( __FILE__, 'ytc_plugin_activate' );

/**
 * The code that runs during plugin deactivation
 */
function ytc_plugin_deactivate() {
	require_once('inc/Deactivate.php');
}
register_deactivation_hook( __FILE__, 'ytc_plugin_deactivate' );

function ytc_allowed_html() {

	$allowed_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'i' => array(),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
		),
	);
	
	return $allowed_tags;
}
require_once('metabox/meta-boxes.php');
require_once('metabox/travel-metaboxes.php');
require_once('metabox/include-excludes.php');
require_once('metabox/map-routes.php');