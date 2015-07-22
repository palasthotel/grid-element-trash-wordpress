<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-grid-element-trash-store.php';

$trash = new Grid_Element_Trash_Store();
$result = $trash->clear();