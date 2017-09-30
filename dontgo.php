<?php

/*
Plugin Name: WP Don't Go
Plugin URI: https://wpajans.net/eklentiler/
Description: This plug-in changes the tab title and favicon when your visitors skip to another tab.
Version: 1.1
Author: WPAjans - Mustafa KÜÇÜK
Author URI: https://wpajans.net
License: GNU
*/

define( 'dontgo', plugins_url('', __FILE__) );
define( 'dontgoPath', plugin_dir_path( __FILE__ ).'dontgo.php' );
define( 'dontgoVersion', '1.1' );
define( 'dontgoURI', 'https://wordpress.org/plugins/wp-dont-go' );
define( 'dontgoSR', 'https://wordpress.org/support/plugin/wp-dont-go' );
require_once('init.php');
require_once('admin_page.php');