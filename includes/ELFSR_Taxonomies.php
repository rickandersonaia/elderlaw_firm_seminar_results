<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/17/2017
 * Time: 9:54 AM
 */

class ELFSR_Taxonomies {

	public function __construct() {
		add_action( 'init', array($this, 'law_firm_taxonomy'), -1 );
		add_action( 'init', array($this, 'area_demographic_taxonomy'), -1 );
		add_action( 'init', array($this, 'venue_type_taxonomy'), -1 );
		add_action( 'init', array($this, 'ad_type_taxonomy'), -1 );
		add_action( 'init', array($this, 'law_firm_terms'), -1 );
		add_action( 'init', array($this, 'area_demographic_terms'), -1 );
		add_action( 'init', array($this, 'venue_type_terms'), -1 );
		add_action( 'init', array($this, 'ad_type_terms'), -1 );
	}

	public function law_firm_taxonomy(){
		// Add Applies To Taxonomy
		$labels = array(
			'name' => 'Firms',
			'singular_name' => 'Firm',
			'search_items' => 'Search Firms',
			'all_items' => 'All Firms',
			'parent_item' => 'Parent Firm',
			'parent_item_colon' => 'Parent Firm:',
			'edit_item' => 'Edit Firm',
			'update_item' => 'Update Firm',
			'add_new_item' => 'Add New Firm',
			'new_item_name' => 'Firm',
			'menu_name' => 'Firm',
		);

		register_taxonomy('firm',
			array('page', 'post', 'law_firm', 'campaign', 'events', 'presentation', 'venue', 'ads'),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array('slug' => 'firm'),
		));
	}


	public function law_firm_terms() {
		wp_insert_term('The Elderlaw Firm', 'firm', array('slug'=>'elderlawfirm'));
		wp_insert_term('Sample Firm', 'firm', array('slug'=>'samplefirm'));
	}


	public function area_demographic_taxonomy(){
		// Add Applies To Taxonomy
		$labels = array(
			'name' => 'Area Demographic',
			'singular_name' => 'Area Demographic',
			'search_items' => 'Search Demographics',
			'all_items' => 'All Demographics',
			'parent_item' => 'Parent Demographic',
			'parent_item_colon' => 'Parent Demographic:',
			'edit_item' => 'Edit Area Demographic',
			'update_item' => 'Update Area Demographic',
			'add_new_item' => 'Add New Area Demographic',
			'new_item_name' => 'Area Demographic',
			'menu_name' => 'Area Demographic',
		);

		register_taxonomy('demographic',
			array('law_firm'),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array('slug' => 'demographic'),
			));
	}


	public function area_demographic_terms() {
		wp_insert_term('Rural (under 20,000)', 'demographic', array('slug'=>'rural'));
		wp_insert_term('Small City (under 50,000)', 'demographic', array('slug'=>'small-city'));
		wp_insert_term('Medium City (under 200,000)', 'demographic', array('slug'=>'medium-city'));
		wp_insert_term('Large City (under 500,000)', 'demographic', array('slug'=>'large-city'));
		wp_insert_term('Megalopolis (over 500,000)', 'demographic', array('slug'=>'megalopolis'));
	}


	public function venue_type_taxonomy(){
		// Add Applies To Taxonomy
		$labels = array(
			'name' => 'Venue Types',
			'singular_name' => 'Venue Type',
			'search_items' => 'Search Venue Types',
			'all_items' => 'All Venue Types',
			'parent_item' => 'Parent Venue Type',
			'parent_item_colon' => 'Parent Venue Type:',
			'edit_item' => 'Edit Venue Type',
			'update_item' => 'Update Venue Type',
			'add_new_item' => 'Add New Venue Type',
			'new_item_name' => 'Venue Type',
			'menu_name' => 'Venue Type',
		);

		register_taxonomy('venue_type',
			array('venue'),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array('slug' => 'venue-type'),
			));
	}


	public function venue_type_terms() {
		wp_insert_term('Hotel', 'venue_type');
		wp_insert_term('Restaurant', 'venue_type');
		wp_insert_term('Event Center', 'venue_type');
		wp_insert_term('Law Firm', 'venue_type');
		wp_insert_term('Assisted Living/Retirement', 'venue_type');
		wp_insert_term('Nursing Home', 'venue_type');
		wp_insert_term('Community Center', 'venue_type');
		wp_insert_term('Funeral Home', 'venue_type');
		wp_insert_term('Other', 'venue_type', array('slug' => 'other-venue-type'));
	}


	public function ad_type_taxonomy(){
		// Add Applies To Taxonomy
		$labels = array(
			'name' => 'Ad Types',
			'singular_name' => 'Ad Type',
			'search_items' => 'Search Ad Types',
			'all_items' => 'All Ad Types',
			'parent_item' => 'Parent Ad Type',
			'parent_item_colon' => 'Parent Ad Type:',
			'edit_item' => 'Edit Ad Type',
			'update_item' => 'Update Ad Type',
			'add_new_item' => 'Add New Ad Type',
			'new_item_name' => 'Ad Type',
			'menu_name' => 'Ad Type',
		);

		register_taxonomy('ad_type',
			array('ads'),
			array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'query_var' => true,
				'rewrite' => array('slug' => 'ad-type'),
			));
	}


	public function ad_type_terms() {
		wp_insert_term('Direct Mail', 'ad_type');
		wp_insert_term('Email', 'ad_type');
		wp_insert_term('Digital Ad', 'ad_type');
		wp_insert_term('Social Ad', 'ad_type');
		wp_insert_term('Newspaper', 'ad_type');
		wp_insert_term('Radio', 'ad_type');
		wp_insert_term('Other Print', 'ad_type');
		wp_insert_term('Television', 'ad_type');
		wp_insert_term('Other', 'ad_type', array('slug' => 'other-add-type'));
	}

}