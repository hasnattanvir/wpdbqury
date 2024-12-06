<?php
/*
Plugin Name: CURDOPWP
Plugin URI: https://example.com
Description: A brief description of your plugin.
Version: 1.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

define('MY_PLUGIN_URL',plugin_dir_url(__FILE__));
define('MY_PLUGIN_PATH',plugin_dir_path(__FILE__));
define('MY_PLUGIN_VER','1.0.0');
$taxt_domain = "beautibooking";

include plugin_dir_path(__FILE__).'includes/cpt_bautibooking.php';
include plugin_dir_path(__FILE__).'includes/meta_box_bautibooking.php';
include plugin_dir_path(__FILE__).'includes/short_code.php';
include plugin_dir_path(__FILE__).'includes/submenu.php';
include plugin_dir_path(__FILE__).'includes/top_menu.php';



include plugin_dir_path(__FILE__).'includes/wpdb-methos.php';