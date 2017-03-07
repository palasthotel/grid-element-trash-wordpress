<?php

namespace GridElementTrash;

/**
 * The plugin bootstrap file
 *
 * Plugin Name:       Grid Element Trash
 * Plugin URI:        https://github.com/palasthotel/grid-element-trash-wordpress
 * Description:       Extends Grid with a trash for containers and boxes
 * Version:           1.1
 * Author: Palasthotel <rezeption@palasthotel.de> (in person: Benjamin Birkenhake, Edward Bock, Enno Welbers)
 * Author URI: http://www.palasthotel.de
 * Requires at least: 4.0
 * Tested up to: 4.7.3
 * License: http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @copyright Copyright (c) 2014, Palasthotel
 * @package Palasthotel\Grid-WordPress
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Plugin{
	
	const DOMAIN = "grid-element-trash";
	
	function __construct() {
		
		$this->url = plugin_dir_url(__FILE__);
		$this->path = plugin_dir_path(__FILE__);
		
		require_once "inc/store.php";
		
		/**
		 * settings page
		 */
		require_once "inc/settings.php";
		$this->settings = new Settings($this);
		
		/**
		 * filter the grid elements
		 */
		require_once "inc/elements-filter.php";
		$this->elements_filter = new ElementsFilter($this);
		
	}
}
new Plugin();

require_once "public-functions.php";