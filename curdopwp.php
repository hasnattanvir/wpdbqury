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

include plugin_dir_path(__FILE__).'includes/wpdb-methos.php';