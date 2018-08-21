<?php
/**
 * Created by PhpStorm.
 * User: mitch
 * Date: 26/07/2018
 * Time: 07:44
 */

class Cb5_cpt_producten_meta {
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
	
	/**
	 * Adds the metabox action
	 */
	public function init_metabox() {
		
		add_action( 'add_meta_boxes',   array( $this, 'add_metabox' )       );
		add_action( 'save_post',        array( $this, 'save_metabox' ), 10, 2);
	
	}
	
	public function add_metabox() {
		
		add_meta_box(
			'cb5_header_type',
			__('Header options', 'cb5_cpt'),
			array($this, 'render_metabox'),
			array('project', 'product', 'themas', 'post', 'page'),
			'advanced',
			'default'
		);
		
	}
	
	public function render_metabox( $post ) {
		
		
		$header_types = [
			'light'     => __( 'Light header', 'cb5_cpt'),
			'dark'     => __( 'Dark header', 'cb5_cpt'),
		];
	
//		wp nonce for security.
		wp_nonce_field( 'product_header_nonce', 'product_nonce');
		
//		Retrieve existing values from the database.
		$header_type = get_post_meta( $post->ID, 'header_type', true);

//		Set defaults.
		if( empty( $header_type ) ) $header_type = 'light';

//		Form fields.
		$html  = "<table>";
		
		$html .= "<tr>";
			$html .= "<th><label for='header_type' class='header_type_label'>" . __('Header color', 'cb5_cpt') . "</label></th>";
				$html .= "<td>";
					$html .= "<select id='header_type' name='header_type'>";
						foreach ($header_types as $key => $val){
							
							if( $header_type === $key){
								
								$html .= "<option value='$key' selected>$val</option>";
								
							} else {
								
								$html .= "<option value='$key'>$val</option>";
								
							}
						}
					$html .= "</select>";
				$html .= "</td>";
			$html .= "</tr>";
			
		$html .= "</table>";
		
		print $html;
	}
	
	public function save_metabox( $post_id, $post) {
	
//		wp nonce for security.
		$nonce_name = ( isset(  $_POST['product_nonce'] ) ) ?  $_POST['product_nonce'] : '';
		$nonce_action = 'product_header_nonce';
		
//		Check if nonce exists
		if( ! isset( $nonce_name ) ){
			return;
		}
		
//		Check if nonce is valid.
		if( ! wp_verify_nonce($nonce_name, $nonce_action) ){
			return;
		}
		
//		Check for user permissions.
		if( ! current_user_can( 'edit_post', $post_id) ){
			return;
		}
		
//		Check for autosave.
		if( wp_is_post_autosave( $post_id ) ){
			return;
		}
		
//		Check for revision
		if( wp_is_post_revision( $post_id ) ){
			return;
		}
		
//		Sanitize input
		$new_header_type = isset( $_POST[ 'header_type' ] ) ? $_POST[ 'header_type' ] : '';
		
//		Update database
		update_post_meta( $post_id, 'header_type', $new_header_type);
	}
}