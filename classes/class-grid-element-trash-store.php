<?php

/**
 * The core plugin class.
 *
 */
class Grid_Element_Trash_Store{

	/**
	 * Define the core functionality of the plugin.
	 * 
	 */
	public function __construct() {
	}
	/**
	 * delete all options from database
	 */
	public function clear(){
		global $wpdb;
		return $wpdb->query('DELETE FROM '.$wpdb->prefix.'options WHERE option_name LIKE "grid_element_trash%"');
	}

	/**
	 * get option if container is trashed
	 */
	public function is_container_trashed($type){
		return get_site_option("grid_element_trash_container_".$type, 0 );
	}

	/**
	 * get option if box is trashed
	 */
	public function is_box_trashed($type){
		return get_site_option("grid_element_trash_box_".$type, 0 );
	}

	/**
	 * set option for container type
	 */
	public function set_container($type, $disabled){
		return $this->set_option("container", $type, $disabled);
	}

	/**
	 * set option for box type
	 */
	public function set_box($type, $disabled){
		return $this->set_option("box", $type, $disabled);
	}

	/**
	 * set option by element
	 */
	private function set_option($element, $type, $disabled){
		return update_site_option("grid_element_trash_".$element."_".$type, $disabled);
	}

}
