<?php

/**
 * Plugin Name: Search For Listing
 * Plugin URI: http://mahmudhaisan.com/
 * Description: This plugin is based on listing search functionality including custom post type , popular search tags etc
 * Version: 2.0
 * Author: Mahmud haisan
 * Author URI: http://mahmudhaisan.com/
 * Developer: Mahmud Haisan
 * Developer URI: http://mahmudhaisan.com/
 * Text Domain: Search493
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if (!defined('ABSPATH')) {
    die;
}

define("PLUGINS_PATH", plugin_dir_path(__FILE__));
define("PLUGINS_PATH_ASSETS", plugin_dir_url(__FILE__) . 'assets/');



require(plugin_dir_path(__FILE__) . 'includes/search-form.php');
require(plugin_dir_path(__FILE__) . 'includes/search-results-page.php');
require(plugin_dir_path(__FILE__) . 'includes/popular-searches.php');
include(plugin_dir_path(__FILE__) . 'includes/ajax/like-ajax.php');
include(plugin_dir_path(__FILE__) . 'includes/ajax/load-more-ajax.php');
include(plugin_dir_path(__FILE__) . 'includes/ajax/share-modal.php');
require_once(plugin_dir_path(__FILE__) . 'includes/enqueue-files.php');
require(plugin_dir_path(__FILE__) . 'includes/my-account-bookmark.php');
require_once(plugin_dir_path(__FILE__) . 'includes/dbtables.php');

register_activation_hook(__FILE__, 'bookmarkTable');
