<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       doedejaarsma.nl
 * @since      1.0.0
 *
 * @package    Cb5_cpt
 * @subpackage Cb5_cpt/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Cb5_cpt
 * @subpackage Cb5_cpt/includes
 * @author     Doede Jaarsma communicatie <support@doedejaarsma.nl>
 */
class Cb5_cpt {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Cb5_cpt_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'cb5_cpt_version' ) ) {
			$this->version = cb5_cpt_version;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'cb5_cpt';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_meta_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Cb5_cpt_Loader. Orchestrates the hooks of the plugin.
	 * - Cb5_cpt_i18n. Defines internationalization functionality.
	 * - Cb5_cpt_Admin. Defines all hooks for the admin area.
	 * - Cb5_cpt_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cb5_cpt-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-cb5_cpt-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cb5_cpt-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cb5_cpt-cpt.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cb5_cpt-tax.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cb5_cpt-producten_meta.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cb5_cpt-public.php';

		$this->loader = new Cb5_cpt_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Cb5_cpt_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Cb5_cpt_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Cb5_cpt_Admin( $this->get_plugin_name(), $this->get_version() );
		$admin_cpt = new Cb5_cpt_cpt( $this->get_plugin_name(), $this->get_version());
		$admin_tax = new Cb5_cpt_tax( $this->get_plugin_name(), $this->get_version());
		
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		$this->loader->add_action( 'init', $admin_cpt, 'custom_producten_type');
		$this->loader->add_action( 'init', $admin_cpt, 'custom_projecten_type');
		$this->loader->add_action( 'init', $admin_cpt, 'custom_users_type');
		$this->loader->add_action( 'init', $admin_cpt, 'custom_theme_type');
		
		$this->loader->add_action( 'init', $admin_tax, 'custom_activ_taxonomy');
		$this->loader->add_action( 'init', $admin_tax, 'custom_product_taxonomy');
		

		
	}
	/**
	 * Register all of the hooks related to the meta area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_meta_hooks() {
		
		$producten_meta = new Cb5_cpt_producten_meta( $this->get_plugin_name(), $this->get_version());
		
		$this->loader->add_action( 'load-post.php', $producten_meta, 'init_metabox');
		$this->loader->add_action( 'load-post-new.php', $producten_meta, 'init_metabox');
		
	}
 
	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Cb5_cpt_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Cb5_cpt_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
