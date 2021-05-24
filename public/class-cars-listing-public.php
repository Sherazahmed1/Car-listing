<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://testwork.mariam
 * @since      1.0.0
 *
 * @package    Cars_Listing
 * @subpackage Cars_Listing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Cars_Listing
 * @subpackage Cars_Listing/public
 * @author     Sheraz Ahmed <sherazahmed@test.com>
 */
class Cars_Listing_Public {

 
	private $plugin_name;

 
	private $version;

	 
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cars-listing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cars-listing-public.js', array( 'jquery' ), $this->version, false );

	}

	/** 
	 * Below is a Function for Shortcode to acheive the functionality of Show Cars Listings
	 */

	public function show_cars_listings( $atts ){
		global $wpdb;

		@extract($atts);

		if(isset($post_title)){
		
			echo $post_title;

			$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '".$post_title."%' ");

		    $args = array(
		        'post__in'=> $mypostids,
		        'post_type'=>'cars_listings',
		        'orderby'=>'title',
		        'order'=>'desc'
		    );

		
		}else{

			$args = array(
				'post_type' => 'cars_listings',
	            'orderby'   => 'date',
				'order'	    => 'desc',
			);

		}

		// The Query
		$query = new WP_Query( $args );
		$content = '<div class="container">';
		while($query -> have_posts()): $query -> the_post();

			if(has_post_thumbnail()):
				$content .= '<div class="car-thumbnail">'.get_the_post_thumbnail().'</div>';
			endif;

			$content .= '<div class="cl_details">';
			$content .= '<h1>'.get_the_title().'</h1>';
			$content .= '<p>'.get_the_content().'</p>';

			$custom_fields = get_post_custom($post_id);			
			$my_custom_loc = $custom_fields['location'][0];			
			$my_custom_color = $custom_fields['color'][0];			
			$my_custom_price = $custom_fields['price'][0];						

			$content .=  '<h3>Additional Info</h3>';
			
			$content .=  'Location: <b>'.$my_custom_loc.'</b><br>';
			$content .=  'Color: <b>'.$my_custom_color.'</b><br>';
			$content .=  'Price: <b>'.$my_custom_price.'</b><br>';
			$content .= '</div>';
			
		endwhile;
		$content .= '</div>';
		wp_reset_postdata(); 


		return $content;
	}

}