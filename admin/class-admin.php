<?php

/**
 * The dashboard-specific functionality of the plugin.
 */
class Grid_Element_Trash_Admin {

	/**
	 * The ID of this plugin.
	 *
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 */
	private $version;

	/**
	 * settingspage identifier
	 */
	private $settings_page;

	/**
	 * Initialize the class and set its properties.
	 *
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->settings_page = "settings_".$this->plugin_name;

	}

	/**
	 * Register the octavius menu page
	 */
	public function menu_page() 
	{
		add_submenu_page( 'tools.php', 'Grid Elements Trash', 'Grid Elements Trash', 'manage_options', $this->settings_page, array($this, "render_settings"));
	}

	/**
	 * renders the settings page
	 */
	public function render_settings(){

		if(class_exists("grid_grid")){

			/**
			 * style for settingspage
			 */
			wp_enqueue_style( 
				'style-settings-page', 
				plugins_url('css/settings-page.css', __FILE__) 
			);

			/**
			 * add js for settingspage
			 */
			wp_enqueue_script(
				'script-settings-page',
				plugins_url( 'js/settings-page.js' , __FILE__ ),
				array( 'jquery' )
			);

			/**
			 * get the grid storage
			 */
			$storage = grid_wp_get_storage();

			$containers = $storage->fetchContainerTypes();
			$meta_boxes = $storage->getMetaTypes();

			$trash = new Grid_Element_Trash_Store();

			require dirname(__FILE__)."/partials/settings-page-display.php";
		} else {
			print "<p>You have to install and activate Grid. https://wordpress.org/plugins/grid/</p>";
		}
		
	}

	/**
	 * change option ajax endpoint
	 */
	public function change_option(){

		$element = sanitize_text_field($_GET["element"]);
		$type = sanitize_text_field( $_GET["type"] );
		$disabled = intval( $_GET["value"] );

		$trash = new Grid_Element_Trash_Store();

		$return = (object) array(
			"error" => false, 
			"error_msg" => "", 
			"element" => $element, 
			"type" => $type, 
			"value" => $disabled,
		);
		if($element == "box"){
			$trash->set_box($type, $disabled);
		} else if($element == "container"){
			$trash->set_container($type, $disabled);
		} else {
			$return->error = true;
			$return->error_msg = "Could not find matching element";
		}
		echo json_encode($return);
		exit;
	}
	/**
	 * filter for boxes
	 */
	public function boxes_filter($boxes){
		$trash = new Grid_Element_Trash_Store();
		for ($i=0; $i < count($boxes) ; $i++) { 
			if($trash->is_box_trashed($boxes[$i]["type"])){
				array_splice($boxes,$i,1);
				$i--;
			}
		}
		return $boxes;
	}
	/**
	 * filter for containers
	 */
	public function containers_filter($containers){
		$trash = new Grid_Element_Trash_Store();
		for ($i=0; $i < count($containers) ; $i++) { 
			if($trash->is_container_trashed($containers[$i]["type"])){
				array_splice($containers,$i,1);
				$i--;
			}
		}
		return $containers;
	}

}



