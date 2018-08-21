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

class Cb5_cpt_tax {
	
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
	
	public function  custom_activ_taxonomy() {
		
		$labels = array(
			'name'                       => _x( 'Activiteit', 'Taxonomy General Name', 'cb5' ),
			'singular_name'              => _x( 'Activiteit', 'Taxonomy Singular Name', 'cb5' ),
			'menu_name'                  => __( 'Activiteiten', 'cb5' ),
			'all_items'                  => __( 'Alle activiteiten', 'cb5' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'Nieuwe activiteit naam', 'cb5' ),
			'add_new_item'               => __( 'Voeg nieuwe activiteit toe', 'cb5' ),
			'edit_item'                  => __( 'Pas activiteit aan', 'cb5' ),
			'update_item'                => __( 'Pas activiteit aan', 'cb5' ),
			'view_item'                  => __( 'Bekijk activiteit', 'cb5' ),
			'separate_items_with_commas' => __( 'Plaats een komma voor meerdere activiteiten', 'cb5' ),
			'add_or_remove_items'        => __( 'Voeg of verwijder activiteit', 'cb5' ),
			'choose_from_most_used'      => __( 'Kies uit de meeste gebruikte', 'cb5' ),
			'popular_items'              => __( 'Populaire activiteiten', 'cb5' ),
			'search_items'               => __( 'Zoek activiteiten', 'cb5' ),
			'not_found'                  => __( 'Niet gevonden', 'cb5' ),
			'no_terms'                   => __( 'Geen activiteiten', 'cb5' ),
			'items_list'                 => __( 'Activiteiten lijst', 'cb5' ),
			'items_list_navigation'      => __( 'Activiteiten lijst navigatie', 'cb5' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest'               => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		
		register_taxonomy( 'activiteiten_taxonomy', array( 'product', 'project' ), $args );
	
	}
	
	public function custom_product_taxonomy() {
		
		$labels = array(
			'name'                       => _x( 'Product', 'Taxonomy General Name', 'cb5' ),
			'singular_name'              => _x( 'Product', 'Taxonomy Singular Name', 'cb5' ),
			'menu_name'                  => __( 'Producten', 'cb5' ),
			'all_items'                  => __( 'Alle producten', 'cb5' ),
			'parent_item'                => __( 'Parent Item', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
			'new_item_name'              => __( 'Nieuwe product naam', 'cb5' ),
			'add_new_item'               => __( 'Voeg nieuwe product toe', 'cb5' ),
			'edit_item'                  => __( 'Pas product aan', 'cb5' ),
			'update_item'                => __( 'Pas product aan', 'cb5' ),
			'view_item'                  => __( 'Bekijk product', 'cb5' ),
			'separate_items_with_commas' => __( 'Plaats een komma voor meerdere producten', 'cb5' ),
			'add_or_remove_items'        => __( 'Voeg of verwijder activiteit', 'cb5' ),
			'choose_from_most_used'      => __( 'Kies uit de meeste gebruikte', 'cb5' ),
			'popular_items'              => __( 'Populaire producten', 'cb5' ),
			'search_items'               => __( 'Zoek producten', 'cb5' ),
			'not_found'                  => __( 'Niet gevonden', 'cb5' ),
			'no_terms'                   => __( 'Geen producten', 'cb5' ),
			'items_list'                 => __( 'Producten lijst', 'cb5' ),
			'items_list_navigation'      => __( 'Producten lijst navigatie', 'cb5' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest'               => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		
		register_taxonomy( 'producten_taxonomy', array( 'product', 'project' ), $args );
		
	}
}