<?php
/**
 * Created by PhpStorm.
 * User: Rick Anderson
 * Date: 11/17/2017
 * Time: 9:54 AM
 */

class ELFSR_Post_Types {

	public function __construct() {
		add_action( 'init', array( $this, 'law_firm_post_type' ), 9 );
		add_action( 'init', array( $this, 'campaign_post_type' ), 9 );
		add_action( 'init', array( $this, 'event_post_type' ), 9 );
		add_action( 'init', array( $this, 'presentation_post_type' ), 9 );
		add_action( 'init', array( $this, 'venue_post_type' ), 9 );
		add_action( 'init', array( $this, 'ad_post_type' ), 9 );
	}

	public function law_firm_post_type() {
		$labels = array(
			'name'               => _x( 'Law Firms', 'post type general name', 'elfsr' ),
			'singular_name'      => _x( 'Law Firm', 'post type singular name', 'elfsr' ),
			'menu_name'          => _x( 'Law Firms', 'admin menu', 'elfsr' ),
			'name_admin_bar'     => _x( 'Law Firm', 'add new on admin bar', 'elfsr' ),
			'add_new'            => _x( 'Add New', 'firm', 'elfsr' ),
			'add_new_item'       => __( 'Add New Law Firm', 'elfsr' ),
			'new_item'           => __( 'New Law Firm', 'elfsr' ),
			'edit_item'          => __( 'Edit Law Firm', 'elfsr' ),
			'view_item'          => __( 'View Law Firm', 'elfsr' ),
			'all_items'          => __( 'All Law Firms', 'elfsr' ),
			'search_items'       => __( 'Search Law Firms', 'elfsr' ),
			'parent_item_colon'  => __( 'Parent Law Firms:', 'elfsr' ),
			'not_found'          => __( 'No firms found.', 'elfsr' ),
			'not_found_in_trash' => __( 'No firms found in Trash.', 'elfsr' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'elfsr' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_nav_menus'  => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-store',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'law-firm' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm', 'demographic' )
		);

		register_post_type( 'law_firm', $args );
	}

	public function campaign_post_type() {
		$labels = array(
			'name'               => _x( 'Campaigns', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Campaign', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Campaigns', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Campaign', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'campaign', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Campaign', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Campaign', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Campaign', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Campaign', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Campaigns', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Campaigns', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Campaigns:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No campaigns found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No campaigns found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_nav_menus'  => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-flag',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'campaign' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm' )
		);

		register_post_type( 'campaign', $args );
	}

	public function event_post_type() {
		$labels = array(
			'name'               => _x( 'Events', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Events', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'event', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Events', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Events', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Events:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No events found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No events found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-tickets-alt',
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'events' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm' )
		);

		register_post_type( 'events', $args );
	}

	public function presentation_post_type() {
		$labels = array(
			'name'               => _x( 'Presentations', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Presentation', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Presentations', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Presentation', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'presentation', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Presentation', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Presentation', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Presentation', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Presentation', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Presentations', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Presentations', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Presentations:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No presentations found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No presentations found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-video-alt',
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'presentation' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm' )
		);

		register_post_type( 'presentation', $args );
	}

	public function venue_post_type() {
		$labels = array(
			'name'               => _x( 'Venues', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Venue', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Venues', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Venue', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'venue', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Venue', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Venue', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Venue', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Venue', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Venues', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Venues', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Venues:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No venues found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No venues found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_position'      => 21,
			'menu_icon'          => 'dashicons-location-alt',
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'venue' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm', 'venue_type' )
		);

		register_post_type( 'venue', $args );
	}

	public function ad_post_type() {
		$labels = array(
			'name'               => _x( 'Ads', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Ad', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Ads', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Ad', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'ad', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Ad', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Ad', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Ad', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Ad', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Ads', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Ads', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Ads:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No ads found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No ads found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_position'      => 22,
			'menu_icon'          => 'dashicons-money',
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'ads' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
			'taxonomies'         => array( 'firm', 'ad_type' )
		);

		register_post_type( 'ads', $args );
	}

}