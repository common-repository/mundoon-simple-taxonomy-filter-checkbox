<?php
/*
Plugin Name:       Mundoon Simple Taxonomie Filter
Plugin URI:        http://www.mundoon.com.br/wp-plugins/mundoon-simple-taxonomie-filter
Description:       Quickly create taxonomies filters for custom post types templates!
Version:           0.0.3
Author:            Mundoon Digital - Raphael Nikson
Author URI:        http://www.mundoon.com.br
Text Domain:       mundoon-stf
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
*/
require_once(plugin_dir_path( __FILE__ ) . 'options.php');
require_once(plugin_dir_path( __FILE__ ) . 'functions.php');
function mundoon_stf_admin_assets () {
    wp_enqueue_style 	( 'mundoon-stf-font', 'http://fonts.googleapis.com/css?family=Raleway:400,500,700,600,300', false, rand(0,500) );
    wp_enqueue_style 	( 'mundoon-stf', plugin_dir_url( __FILE__ ) . '/assets/mo-stf.css', false, rand(0,500) );
}
add_action( 'admin_enqueue_scripts', 'mundoon_stf_admin_assets',99);
function mundoon_stf_site_assets () {
    wp_enqueue_script 	( 'mundoon-stf', plugin_dir_url( __FILE__ ) . '/assets/mo-stf.js', null, 1, true);
}
add_action( 'wp_enqueue_scripts', 'mundoon_stf_site_assets',99);