<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 19/07/2018
 * Time: 12:44
 */

/**
 * The cpt-specific functionality of the plugin.
 *
 * @link       doedejaarsma.nl
 * @since      1.0.0
 *
 * @package    Cb5_producten
 * @subpackage Cb5_producten/admin
 */

/**
 * The cpt-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cb5_producten
 * @subpackage Cb5_producten/admin
 * @author     Doede Jaarsma communicatie <support@doedejaarsma.nl>
 */

class Cb5_cpt_cpt {
	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
	}
	
	public function custom_producten_type() {
	
//		Generate Labels
		$labels = array(
			'name'                  => _x( 'Producten', 'Post Type General Name', 'cb5_prod'),
			'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'cb5_prod' ),
			'menu_name'             => __( 'Producten', 'cb5_prod' ),
			'name_admin_bar'        => __( 'Product', 'cb5' ),
			'archives'              => __( 'Product Archives', 'cb5_prod' ),
			'attributes'            => __( 'Product Attributes', 'cb5_prod' ),
			'parent_item_colon'     => __( 'Parent Product:', 'cb5_prod' ),
			'all_items'             => __( 'Alle Producten', 'cb5_prod' ),
			'add_new_item'          => __( 'Nieuw Product toevoegen', 'cb5_prod' ),
			'add_new'               => __( 'Nieuwe toevoegen', 'cb5_prod' ),
			'new_item'              => __( 'Nieuw Product', 'cb5_prod' ),
			'edit_item'             => __( 'Edit Product', 'cb5_prod' ),
			'update_item'           => __( 'Update Product', 'cb5_prod' ),
			'view_item'             => __( 'View Product', 'cb5_prod' ),
			'view_items'            => __( 'View Producten', 'cb5_prod' ),
			'search_items'          => __( 'Zoek door Producten', 'cb5_prod' ),
			'not_found'             => __( 'Niet gevonden', 'cb5_prod' ),
			'not_found_in_trash'    => __( 'Niet gevonden in prullenmand', 'cb5_prod' ),
			'featured_image'        => __( 'Uitgelichte afbeelding', 'cb5_prod' ),
			'set_featured_image'    => __( 'Kies uitgelichte afbeelding', 'cb5_prod' ),
			'remove_featured_image' => __( 'Verwijder uitgelichte afbeelding', 'cb5_prod' ),
			'use_featured_image'    => __( 'Gebruik als uitgelichte afbeelding', 'cb5_prod' ),
			'insert_into_item'      => __( 'Voeg product in', 'cb5_prod' ),
			'uploaded_to_this_item' => __( 'Geupload naar dit product', 'cb5_prod' ),
			'items_list'            => __( 'Producten lijst', 'cb5_prod' ),
			'items_list_navigation' => __( 'Producten lijst navigatie', 'cb5_prod' ),
			'filter_items_list'     => __( 'Filter producten lijst', 'cb5_prod' ),
		);

//		Generate arguments
		$args = array(
			'label'                 => __( 'Producten', 'cb5_prod' ),
			'description'           => __( 'De Producten van het buro', 'cb5_prod' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'            => array( 'activiteiten_taxonomy' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-media-document',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'show_in_rest'          => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);

//		Register first post type
		
		register_post_type( 'product', $args);
	}
	
	public function custom_projecten_type() {
		
		$labels = array(
			'name'                  => _x( 'Projecten', 'Post Type General Name', 'cb5' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'cb5' ),
			'menu_name'             => __( 'Projecten', 'cb5' ),
			'name_admin_bar'        => __( 'Project', 'cb5' ),
			'archives'              => __( 'Project Archives', 'cb5' ),
			'attributes'            => __( 'Project Attributes', 'cb5' ),
			'parent_item_colon'     => __( 'Parent Project:', 'cb5' ),
			'all_items'             => __( 'Alle Projecten', 'cb5' ),
			'add_new_item'          => __( 'Nieuw Project toevoegen', 'cb5' ),
			'add_new'               => __( 'Nieuwe toevoegen', 'cb5' ),
			'new_item'              => __( 'Nieuw Project', 'cb5' ),
			'edit_item'             => __( 'Edit Project', 'cb5' ),
			'update_item'           => __( 'Update Project', 'cb5' ),
			'view_item'             => __( 'View Project', 'cb5' ),
			'view_items'            => __( 'View Projecten', 'cb5' ),
			'search_items'          => __( 'Zoek door Projecten', 'cb5' ),
			'not_found'             => __( 'Niet gevonden', 'cb5' ),
			'not_found_in_trash'    => __( 'Niet gevonden in prullenmand', 'cb5' ),
			'featured_image'        => __( 'Uitgelichte afbeelding', 'cb5' ),
			'set_featured_image'    => __( 'Kies uitgelichte afbeelding', 'cb5' ),
			'remove_featured_image' => __( 'Verwijder uitgelichte afbeelding', 'cb5' ),
			'use_featured_image'    => __( 'Gebruik als uitgelichte afbeelding', 'cb5' ),
			'insert_into_item'      => __( 'Voeg project in', 'cb5' ),
			'uploaded_to_this_item' => __( 'Geupload naar dit project', 'cb5' ),
			'items_list'            => __( 'Projecten lijst', 'cb5' ),
			'items_list_navigation' => __( 'Projecten lijst navigatie', 'cb5' ),
			'filter_items_list'     => __( 'Filter projecten lijst', 'cb5' ),
		);
		$args = array(
			'label'                 => __( 'Projecten', 'cb5' ),
			'description'           => __( 'De Projecten van het buro', 'cb5' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'            => array( 'activiteiten_taxonomy', 'producten_taxonomy' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 6,
			'menu_icon'             => 'dashicons-media-spreadsheet',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'show_in_rest'          => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'project', $args );
	}
	
	public function custom_users_type() {
		
		$labels = array(
			'name'                  => _x( 'Gebruikers', 'Post Type General Name', 'cb5' ),
			'singular_name'         => _x( 'Gebruiker', 'Post Type Singular Name', 'cb5' ),
			'menu_name'             => __( 'Gebruikers', 'cb5' ),
			'name_admin_bar'        => __( 'Gebruiker', 'cb5' ),
			'archives'              => __( 'Gebruiker Archives', 'cb5' ),
			'attributes'            => __( 'Gebruiker Attributes', 'cb5' ),
			'parent_item_colon'     => __( 'Parent gebruiker:', 'cb5' ),
			'all_items'             => __( 'Alle gebruikers', 'cb5' ),
			'add_new_item'          => __( 'Nieuwe gebruiker toevoegen', 'cb5' ),
			'add_new'               => __( 'Nieuwe toevoegen', 'cb5' ),
			'new_item'              => __( 'Nieuw gebruiker', 'cb5' ),
			'edit_item'             => __( 'Edit gebruiker', 'cb5' ),
			'update_item'           => __( 'Update gebruiker', 'cb5' ),
			'view_item'             => __( 'View gebruiker', 'cb5' ),
			'view_items'            => __( 'View gebruikers', 'cb5' ),
			'search_items'          => __( 'Zoek door gebruikers', 'cb5' ),
			'not_found'             => __( 'Niet gevonden', 'cb5' ),
			'not_found_in_trash'    => __( 'Niet gevonden in prullenmand', 'cb5' ),
			'featured_image'        => __( 'Profielfoto', 'cb5' ),
			'set_featured_image'    => __( 'Kies profielfoto', 'cb5' ),
			'remove_featured_image' => __( 'Verwijder profielfoto', 'cb5' ),
			'use_featured_image'    => __( 'Gebruik als profielfoto', 'cb5' ),
			'insert_into_item'      => __( 'Voeg gebruiker in', 'cb5' ),
			'uploaded_to_this_item' => __( 'Geupload naar deze gebruiker', 'cb5' ),
			'items_list'            => __( 'Gebruikers lijst', 'cb5' ),
			'items_list_navigation' => __( 'Gebruikers lijst navigatie', 'cb5' ),
			'filter_items_list'     => __( 'Filter gebruikers lijst', 'cb5' ),
		);
		$args   = array(
			'label'               => __( 'Gebruikers', 'cb5' ),
			'description'         => __( 'Onze werknemers', 'cb5' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array(),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-groups',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'gebruikers', $args );
		
	}
	
	public function custom_theme_type() {
		
		$labels = array(
			'name'                  => _x( 'Themas', 'Post Type General Name', 'cb5' ),
			'singular_name'         => _x( 'Thema', 'Post Type Singular Name', 'cb5' ),
			'menu_name'             => __( 'Themas', 'cb5' ),
			'name_admin_bar'        => __( 'Thema', 'cb5' ),
			'archives'              => __( 'Thema Archives', 'cb5' ),
			'attributes'            => __( 'Thema Attributes', 'cb5' ),
			'parent_item_colon'     => __( 'Parent thema:', 'cb5' ),
			'all_items'             => __( 'Alle themas', 'cb5' ),
			'add_new_item'          => __( 'Nieuwe thema toevoegen', 'cb5' ),
			'add_new'               => __( 'Nieuwe toevoegen', 'cb5' ),
			'new_item'              => __( 'Nieuw thema', 'cb5' ),
			'edit_item'             => __( 'Wijzig thema', 'cb5' ),
			'update_item'           => __( 'Update thema', 'cb5' ),
			'view_item'             => __( 'View thema', 'cb5' ),
			'view_items'            => __( 'View themas', 'cb5' ),
			'search_items'          => __( 'Zoek door themas', 'cb5' ),
			'not_found'             => __( 'Niet gevonden', 'cb5' ),
			'not_found_in_trash'    => __( 'Niet gevonden in prullenmand', 'cb5' ),
			'featured_image'        => __( 'Uitgelichte afbeelding', 'cb5' ),
			'set_featured_image'    => __( 'Kies uitgelichte afbeelding', 'cb5' ),
			'remove_featured_image' => __( 'Verwijder uitgelichte afbeelding', 'cb5' ),
			'use_featured_image'    => __( 'Gebruik als uitgelichte afbeelding', 'cb5' ),
			'insert_into_item'      => __( 'Voeg thema in', 'cb5' ),
			'uploaded_to_this_item' => __( 'Geupload naar dit thema', 'cb5' ),
			'items_list'            => __( 'Themas lijst', 'cb5' ),
			'items_list_navigation' => __( 'Themas lijst navigatie', 'cb5' ),
			'filter_items_list'     => __( 'Filter themas lijst', 'cb5' ),
		);
		$args   = array(
			'label'               => __( 'themas', 'cb5' ),
			'description'         => __( 'Onze themas', 'cb5' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail' ),
			'taxonomies'          => array(),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-portfolio',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'themas', $args );
		
	}
}