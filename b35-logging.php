<?php
/**
 * Plugin Name: Logging API Plugin
 * Plugin URI: https://www.bramesposito.com/projects/wordpress/b35-logging
 * Description: Plugin with extensive logging support
 * Version: 0.1.0
 * Author: Bram Esposito
 * Author URI: https://bramesposito.com
 * Text Domain: b35-logging
 * Domain Path: /public/languages
 */


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


require_once( plugin_dir_path( __FILE__ ) . 'logging.php' );


//b35_log_dump($_SERVER,"server","day");
