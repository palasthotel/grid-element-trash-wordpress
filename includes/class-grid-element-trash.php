<?php

/**
 * The core plugin class.
 *
 */
class Grid_Element_Trash{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 * 
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 * 
	 */
	public function __construct() {

		$this->plugin_name = 'grid-element-trash';
		$this->version = '0.9.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * The store class
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-grid-element-trash-store.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';


		$this->loader = new Grid_Element_Trash_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 * 
	 */
	private function set_locale() {

		$plugin_i18n = new Grid_Element_Trash_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 * 
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Grid_Element_Trash_Admin( $this->get_plugin_name(), $this->get_version() );

		// settings page
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'menu_page' );
		$this->loader->add_action( 'wp_ajax_grid_element_trash_change_option', $plugin_admin, 'change_option' );

		// grid hook
		$this->loader->add_filter('grid_boxes_search', $plugin_admin, 'boxes_filter');
		$this->loader->add_filter('grid_metaboxes',$plugin_admin, 'boxes_filter');
		$this->loader->add_filter('grid_containers', $plugin_admin, 'containers_filter');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 * 
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
