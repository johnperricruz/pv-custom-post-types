<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.johnperricruz.com
 * @since             1.0.0
 * @package           Pv_Post_Type
 *
 * @wordpress-plugin
 * Plugin Name:       Primeview Custom Post Types
 * Plugin URI:        https://www.primeview.com
 * Description:       This plugin is developed to maintain different custom post types.
 * Version:           1.0.0
 * Author:            John Perri Cruz
 * Author URI:        https://www.johnperricruz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pv-post-type
 * Domain Path:       /languages
 */


class PvPostTypeController{
	
	public function __construct(){
		add_action('init',array(&$this, 'pv_custom_post_type'));
		add_action('template_redirect',array(&$this, 'pv_custom_post_type_template'));
	}
	/**
	 * Register Custom Post Type 
	 * SEARCH FOR "post-type" and "Post Type" and change the values
	 */
	public function pv_custom_post_type() {

		$labels = array(
			'name'                  => _x( 'Post Type', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Post Type', 'text_domain' ),
			'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New Post Type', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'search_items'          => __( 'Search Item', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Post Type', 'text_domain' ),
			'description'           => __( 'Post Type', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'revisions',  'page-attributes', 'post-formats', ),
			'taxonomies'            => array( 'Post Type' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'menu_icon'				=> 'dashicons-awards',
			'capability_type'       => 'page',
			 'rewrite' => array( 'slug' => 'post-type' )
		);
		register_post_type( 'post-type', $args );
		register_taxonomy_for_object_type( 'category', 'post-type' );
	}	
	/**
	 * Use template for custom post type
	 */
	function pv_custom_post_type_template(){
	  global $wp;
	  global $wp_query;
	  if ( $wp->query_vars["post_type"] == "post-type"){
		if (have_posts()){
			  require_once (plugin_dir_path(dirname( __FILE__ ) ).'apis/templates/custom-post-type-template.php');
			  die();
		  }
		  else{
			  $wp_query->is_404 = true;
		  }
		}
	}	
}