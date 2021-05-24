<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://testwork.mariam
 * @since      1.0.0
 *
 * @package    Cars_Listing
 * @subpackage Cars_Listing/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cars_Listing
 * @subpackage Cars_Listing/includes
 * @author     Sheraz Ahmed <sherazahmed@test.com>
 */
class Cars_Listing_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cars-listing',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}


	public function cars() {

		$labels = array(
			'name'                  => _x( 'Cars Listings', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Cars Listings', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Cars Listings', 'text_domain' ),
			'name_admin_bar'        => __( 'Cars Listings', 'text_domain' ),
			'archives'              => __( 'Item Archives', 'text_domain' ),
			'attributes'            => __( 'Item Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'All Items', 'text_domain' ),
			'add_new_item'          => __( 'Add New Item', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Item', 'text_domain' ),
			'edit_item'             => __( 'Edit Item', 'text_domain' ),
			'update_item'           => __( 'Update Item', 'text_domain' ),
			'view_item'             => __( 'View Item', 'text_domain' ),
			'view_items'            => __( 'View Items', 'text_domain' ),
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
			'label'                 => __( 'Cars Listings', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor','thumbnail' ),
			'taxonomies'            => array( 'cars_listings_taxonomy' ),
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
			'capability_type'       => 'page',
		);
		register_post_type( 'cars_listings', $args );

	}

	public function metaboxes_for_cars_listings() {
	    add_meta_box( 'location', 'Location', 'Cars_Listing_i18n::location_cars', 'cars_listings', 'normal', 'high');
	    add_meta_box( 'color', 'Color', 'Cars_Listing_i18n::color_cars', 'cars_listings', 'normal', 'high');
	    add_meta_box( 'price', 'Price', 'Cars_Listing_i18n::price_cars', 'cars_listings', 'normal', 'high');
	}

	public function location_cars() {
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'cars_listing_location' );
		// Get the location data if it's already been entered
		$location = get_post_meta( $post->ID, 'location', true );
		// Output the field
		echo '<input type="text" name="location" value="' . $location . '" class="widefat">';
	}

	public function color_cars() {
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'cars_listing_color' );
		// Get the location data if it's already been entered
		$color = get_post_meta( $post->ID, 'color', true );
		// Output the field
		echo '<input type="text" name="color" value="' . $color . '" class="widefat">';
	}

	public function price_cars() {
		global $post;
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'cars_listing_price' );
		// Get the location data if it's already been entered
		$price = get_post_meta( $post->ID, 'price', true );
		// Output the field
		echo '<input type="text" name="price" value="' . $price . '" class="widefat">';
	}


	// Save the metabox data
	function wpt_save_events_meta( $post_id ) {
		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
		// Verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times.
		if ( ! isset( $_POST['location'] ) || ! wp_verify_nonce( $_POST['cars_listing_location'], basename(__FILE__) ) ) {
			return $post_id;
		}
		if ( ! isset( $_POST['color'] ) || ! wp_verify_nonce( $_POST['cars_listing_color'], basename(__FILE__) ) ) {
			return $post_id;
		}
		if ( ! isset( $_POST['price'] ) || ! wp_verify_nonce( $_POST['cars_listing_price'], basename(__FILE__) ) ) {
			return $post_id;
		}
		// Now that we're authenticated, time to save the data.
		// This sanitizes the data from the field and saves it into an array $events_meta.
		$cars_meta['location'] = $_POST['location'];
		$cars_meta['color'] =  $_POST['color'];
		$cars_meta['price'] =  $_POST['price'];
		// Cycle through the $events_meta array.
		// Note, in this example we just have one item, but this is helpful if you have multiple.
		foreach ( $cars_meta as $key => $value ) :
			// Don't store custom data twice
			if ( 'revision' === 'cars_listings' ) {
				return;
			}
			if ( get_post_meta( $post_id, $key, false ) ) {
				// If the custom field already has a value, update it.
				update_post_meta( $post_id, $key, $value );
			} else {
				// If the custom field doesn't have a value, add it.
				add_post_meta( $post_id, $key, $value);
			}
			if ( ! $value ) {
				// Delete the meta key if there's no value
				delete_post_meta( $post_id, $key );
			}
		endforeach;

	}

}
