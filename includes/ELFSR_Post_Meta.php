<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/17/2017
 * Time: 9:54 AM
 */

class ELFSR_Post_Meta {

	const prefix = 'elfsr_';
	protected static $state_list = array(
		'AL' => 'Alabama',
		'AK' => 'Alaska',
		'AZ' => 'Arizona',
		'AR' => 'Arkansas',
		'CA' => 'California',
		'CO' => 'Colorado',
		'CT' => 'Connecticut',
		'DE' => 'Delaware',
		'DC' => 'District Of Columbia',
		'FL' => 'Florida',
		'GA' => 'Georgia',
		'HI' => 'Hawaii',
		'ID' => 'Idaho',
		'IL' => 'Illinois',
		'IN' => 'Indiana',
		'IA' => 'Iowa',
		'KS' => 'Kansas',
		'KY' => 'Kentucky',
		'LA' => 'Louisiana',
		'ME' => 'Maine',
		'MD' => 'Maryland',
		'MA' => 'Massachusetts',
		'MI' => 'Michigan',
		'MN' => 'Minnesota',
		'MS' => 'Mississippi',
		'MO' => 'Missouri',
		'MT' => 'Montana',
		'NE' => 'Nebraska',
		'NV' => 'Nevada',
		'NH' => 'New Hampshire',
		'NJ' => 'New Jersey',
		'NM' => 'New Mexico',
		'NY' => 'New York',
		'NC' => 'North Carolina',
		'ND' => 'North Dakota',
		'OH' => 'Ohio',
		'OK' => 'Oklahoma',
		'OR' => 'Oregon',
		'PA' => 'Pennsylvania',
		'RI' => 'Rhode Island',
		'SC' => 'South Carolina',
		'SD' => 'South Dakota',
		'TN' => 'Tennessee',
		'TX' => 'Texas',
		'UT' => 'Utah',
		'VT' => 'Vermont',
		'VA' => 'Virginia',
		'WA' => 'Washington',
		'WV' => 'West Virginia',
		'WI' => 'Wisconsin',
		'WY' => 'Wyoming'
	);


	public function __construct() {

		add_action( 'cmb2_admin_init', array( $this, 'law_firm_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'venue_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'presentation_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'event_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_direct_mail_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_email_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_digital_ad_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_social_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_newspaper_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_other_print_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_radio_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_tv_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_type_other_meta' ) );
		add_action( 'cmb2_admin_init', array( $this, 'campaign_meta' ) );
		add_action( 'cmb2_render_zip_code', array( $this, 'create_zip_code_field' ), 10, 5 );
		add_filter( 'cmb2_sanitize_zip_code', array( $this, 'sanitize_zip_code_field' ), 10, 2 );
	}

	public function law_firm_meta() {

		$lf = new_cmb2_box( array(
			'id'           => self::prefix . 'law_firm_metabox',
			'title'        => esc_html__( 'Law Firm Details', 'elfsr' ),
			'object_types' => array( 'law_firm' ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // true to keep the metabox closed by default
			// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
			// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
		) );

		$lf->add_field( array(
			'name' => esc_html__( 'City', 'elfsr' ),
			'desc' => esc_html__( 'City this firm is located in', 'elfsr' ),
			'id'   => self::prefix . 'lf_city',
			'type' => 'text',
			//'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
			// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
			// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
			// 'on_front'        => false, // Optionally designate a field to wp-admin only
			// 'repeatable'      => true,
			// 'column'          => true, // Display field value in the admin post-listing columns
		) );

		$lf->add_field( array(
			'name'    => esc_html__( 'State', 'elfsr' ),
			'id'      => self::prefix . 'lf_state',
			'type'    => 'select',
			'options' => self::$state_list
		) );

		$lf->add_field( array(
			'name' => esc_html__( 'Website', 'elfsr' ),
			'id'   => self::prefix . 'lf_website',
			'type' => 'text_url'
		) );

		$lf->add_field( array(
			'name'       => esc_html__( 'Number of Attorneys', 'elfsr' ),
			'id'         => self::prefix . 'lf_attorneys',
			'type'       => 'text_small',
			'attributes' => array(
				'type'    => 'number',
				'pattern' => '\d*',
			)
		) );
	}

	public function venue_meta() {

		$v = new_cmb2_box( array(
			'id'           => self::prefix . 'venue_metabox',
			'title'        => esc_html__( 'Venue Details', 'elfsr' ),
			'object_types' => array( 'venue' ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // true to keep the metabox closed by default
			// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
			// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
		) );

		$v->add_field( array(
			'name' => esc_html__( 'City', 'elfsr' ),
			'desc' => esc_html__( 'City this venue is located in', 'elfsr' ),
			'id'   => self::prefix . 'venue_city',
			'type' => 'text',
			//'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
			// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
			// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
			// 'on_front'        => false, // Optionally designate a field to wp-admin only
			// 'repeatable'      => true,
			// 'column'          => true, // Display field value in the admin post-listing columns
		) );

		$v->add_field( array(
			'name'    => esc_html__( 'State', 'elfsr' ),
			'id'      => self::prefix . 'venue_state',
			'type'    => 'select',
			'options' => self::$state_list
		) );

		$v->add_field( array(
			'name'            => esc_html__( 'Zip Code', 'elfsr' ),
			'id'              => self::prefix . 'venue_zip',
			'type'            => 'zip_code',
			'sanitization_cb' => array( $this, 'sanitize_zip_code_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^[0-9]{5}([- /]?[0-9]{4})?$',
				'title'   => esc_attr__( 'Please enter a valid zip code', 'elfsr' ),
			)
		) );

		$v->add_field( array(
			'name'            => esc_html__( 'Distance to office', 'elfsr' ),
			'id'              => self::prefix . 'venue_distance',
			'type'            => 'text_small',
			'desc'            => esc_html__( 'In miles - numbers only', 'elfsr' ),
			'sanitization_cb' => array( $this, 'sanitize_int_or_float_field' ),
			// custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^([0-9]*|\d*\.\d{1}?\d*)$', // positive int or decimals only
				'title'   => esc_attr__( 'Please enter numbers only', 'elfsr' ),
			)
		) );

		$v->add_field( array(
			'name'            => esc_html__( 'Room Capacity', 'elfsr' ),
			'id'              => self::prefix . 'venue_room_capacity',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$v->add_field( array(
			'name'    => esc_html__( 'Seating Arrangement', 'elfsr' ),
			'id'      => self::prefix . 'venue_seating_arrangement',
			'type'    => 'select',
			'options' => array(
				'Theatre'          => 'Theatre',
				'Classroom'        => 'Classroom',
				'Half rounds'      => 'Half rounds',
				'Conference table' => 'Conference table',
				'other'            => 'Other'
			)
		) );

		$v->add_field( array(
			'name'       => esc_html__( 'Describe the seating arrangement', 'elfsr' ),
			'id'         => self::prefix . 'venue_seating_arrangement_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_venue_seating_arrangement_description_field' )

		) );
	}

	public function presentation_meta() {

		$p = new_cmb2_box( array(
			'id'           => self::prefix . 'presentation_metabox',
			'title'        => esc_html__( 'Presentation Details', 'elfsr' ),
			'object_types' => array( 'presentation' ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );

		$p->add_field( array(
			'name'   => esc_html__( 'Nick name', 'elfsr' ),
			'desc'   => esc_html__( 'Nick name for this presentation', 'elfsr' ),
			'id'     => self::prefix . 'presentation_nick_name',
			'type'   => 'text',
			'column' => true, // Display field value in the admin post-listing columns
		) );

		$p->add_field( array(
			'name'    => esc_html__( 'Presenter Type', 'elfsr' ),
			'id'      => self::prefix . 'presentation_presenter_type',
			'type'    => 'multicheck_inline',
			'options' => array(
				'Lawyer'                      => 'Lawyer',
				'Multiple Lawyers, same firm' => 'Multiple Lawyers, same firm',
				'Law staff'                   => 'Law staff',
				'Financial advisor'           => 'Financial advisor',
				'other'                       => 'Other'
			)
		) );

		$p->add_field( array(
			'name'       => esc_html__( 'Describe the other presenter type', 'elfsr' ),
			'id'         => self::prefix . 'presentation_presenter_type_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_presentation_presenter_type_description_field' )

		) );

		$p->add_field( array(
			'name'            => esc_html__( 'Length of presentation', 'elfsr' ),
			'id'              => self::prefix . 'presentation_length',
			'description'     => esc_html__( 'Length in minutes', 'elfsr' ),
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$p->add_field( array(
			'name'    => esc_html__( 'Primary Topic', 'elfsr' ),
			'id'      => self::prefix . 'presentation_topic',
			'type'    => 'select',
			'options' => array(
				'Estate Planning'         => 'Estate Planning',
				'Medicaid Planning'       => 'Medicaid Planning',
				'Retirement and Finances' => 'Retirement and Finances',
				'Living Trusts'           => 'Living Trusts',
				'Health Care Concersn'    => 'Health Care Concerns',
				'other'                   => 'Other'
			),
			'column'  => true, // Display field value in the admin post-listing columns
		) );

		$p->add_field( array(
			'name'       => esc_html__( 'Describe the other presentation topic', 'elfsr' ),
			'id'         => self::prefix . 'presentation_topic_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_presentation_topic_description_field' )

		) );

		$p->add_field( array(
			'name'    => esc_html__( 'Audio/Visual', 'elfsr' ),
			'id'      => self::prefix . 'presentation_av',
			'type'    => 'multicheck_inline',
			'options' => array(
				'Slides'      => 'Slides',
				'Workbook,'   => 'Workbook',
				'White Board' => 'White Board',
				'Flip Chart'  => 'Flip Chart',
				'other'       => 'Other'
			)
		) );

		$p->add_field( array(
			'name'       => esc_html__( 'Describe the other audio/visual used', 'elfsr' ),
			'id'         => self::prefix . 'presentation_av_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_presentation_av_description_field' )

		) );

		$p->add_field( array(
			'name'    => esc_html__( 'Response request', 'elfsr' ),
			'id'      => self::prefix . 'presentation_response_request',
			'type'    => 'multicheck_inline',
			'options' => array(
				'Request Appointment'         => 'Request Appointment',
				'Make appointment at seminar' => 'Make appointment at seminar',
				'Request free book'           => 'Request free book'
			)
		) );
	}

	public function event_meta() {

		$e = new_cmb2_box( array(
			'id'           => self::prefix . 'event_metabox',
			'title'        => esc_html__( 'Event Details', 'elfsr' ),
			'object_types' => array( 'events' ), // Post type
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true, // Show field names on the left
		) );

		$e->add_field( array(
			'name'    => esc_html__( 'Registration Method', 'elfsr' ),
			'id'      => self::prefix . 'event_registration_method',
			'type'    => 'multicheck_inline',
			'options' => array(
				'Call law office'                => 'Call law office',
				'24 hour law office message box' => '24 hour law office message box',
				'Third party phone RSVP service' => 'Third party phone RSVP service',
				'Online landing page'            => 'Online landing page',
				'other'                          => 'Other'
			)
		) );

		$e->add_field( array(
			'name'       => esc_html__( 'Describe the other registration method', 'elfsr' ),
			'id'         => self::prefix . 'event_registration_method_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_event_registration_method_description_field' )

		) );

		$e->add_field( array(
			'name' => esc_html__( 'Date', 'elfsr' ),
			'id'   => self::prefix . 'event_date',
			'type' => 'text_date'
		) );

		$e->add_field( array(
			'name' => esc_html__( 'Start time', 'elfsr' ),
			'id'   => self::prefix . 'event_start_time',
			'type' => 'text_time'
		) );

		$e->add_field( array(
			'name'       => esc_html__( 'Venue', 'elfsr' ),
			'id'         => self::prefix . 'event_venue',
			'type'       => 'select',
			'options_cb' => array( $this, 'venue_posts_by_lawfirm' )
		) );

		$e->add_field( array(
			'name'    => esc_html__( 'Meal Provided', 'elfsr' ),
			'id'      => self::prefix . 'event_meal_provided',
			'type'    => 'select',
			'options' => array(
				'None'                  => 'None',
				'Beverages only'        => 'Beverages only',
				'Cookies and beverages' => 'Cookies and beverages',
				'Light Refreshments'    => 'Light Refreshments',
				'Breakfast'             => 'Breakfast',
				'Lunch'                 => 'Lunch',
				'Dinner'                => 'Dinner'
			)
		) );

		$e->add_field( array(
			'name'    => esc_html__( 'Meal Timing', 'elfsr' ),
			'id'      => self::prefix . 'event_meal_timing',
			'type'    => 'select',
			'options' => array(
				'N/A'                               => 'N/A',
				'Plated meal after presentation'    => 'Plated meal after presentation',
				'Plated meal before presentation'   => 'Plated meal before presentation',
				'Buffet before/during presentation' => 'Buffet before/during presentation',
				'Buffet after presentation'         => 'Buffet after presentation'
			)
		) );

		$e->add_field( array(
			'name'    => esc_html__( 'Offer', 'elfsr' ),
			'id'      => self::prefix . 'event_offer',
			'type'    => 'select',
			'options' => array(
				''                  => 'Select one',
				'Free Consultation' => 'Free Consultation',
				'Discount coupon'   => 'Discount coupon',
				'Book'              => 'Book',
				'other'             => 'Other'
			)
		) );

		$e->add_field( array(
			'name'       => esc_html__( 'Describe the other offer type', 'elfsr' ),
			'id'         => self::prefix . 'event_offer_type_description',
			'type'       => 'textarea_small',
			'show_on_cb' => array( $this, 'show_event_offer_type_description_field' )

		) );

		$e->add_field( array(
			'name' => esc_html__( 'Offer note', 'elfsr' ),
			'id'   => self::prefix . 'event_offer_note',
			'type' => 'textarea_small'
		) );

		$e->add_field( array(
			'name' => esc_html__( 'Event Response', 'elfsr' ),
			'id'   => self::prefix . 'response_title',
			'type' => 'title'
		) );

		$e->add_field( array(
			'name' => esc_html__( 'Date first registration recieved', 'elfsr' ),
			'id'   => self::prefix . 'event_firts_registration_date',
			'type' => 'text_date'
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Total registrants', 'elfsr' ),
			'id'              => self::prefix . 'event_total_registrants',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Buying units registered', 'elfsr' ),
			'id'              => self::prefix . 'event_buying_unit_registrants',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Waiting list', 'elfsr' ),
			'id'              => self::prefix . 'event_waiting_list',
			'description'     => esc_html__( 'Enter number of people on the wait list', 'elfsr' ),
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Total Attendence', 'elfsr' ),
			'id'              => self::prefix . 'event_attendence',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Buying unit attendence', 'elfsr' ),
			'id'              => self::prefix . 'event_buying_unit_attendence',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name' => esc_html__( 'Event Result', 'elfsr' ),
			'id'   => self::prefix . 'result_title',
			'type' => 'title'
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Attendees making appointments at seminar', 'elfsr' ),
			'description'     => esc_html__( 'Appointments made at seminar', 'elfsr' ),
			'id'              => self::prefix . 'event_attendees_making_appointments',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Attendees requesting appointments at seminar', 'elfsr' ),
			'description'     => esc_html__( 'Appointments not made at seminar', 'elfsr' ),
			'id'              => self::prefix . 'event_attendees_requesting_appointments',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Attendees requesting more information', 'elfsr' ),
			'id'              => self::prefix . 'event_attendees_request_more_info',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$e->add_field( array(
			'name'            => esc_html__( 'Attendees not interested', 'elfsr' ),
			'id'              => self::prefix . 'event_attendees_not_interested',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );
	}

	public function add_type_direct_mail_meta() {

		$dm = new_cmb2_box( array(
			'id'            => self::prefix . 'direct_mail_metabox',
			'title'         => esc_html__( 'Direct Mail Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'direct-mail' )
			),
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'Headline', 'elfsr' ),
			'id'   => self::prefix . 'ad_headline',
			'type' => 'text'
		) );

		$dm->add_field( array(
			'name'    => esc_html__( 'Direct Mail Style', 'elfsr' ),
			'id'      => self::prefix . 'ad_dm_style',
			'type'    => 'select',
			'options' => array(
				''                => 'Select one',
				'Postcard'        => 'Postcard',
				'Wedding'         => 'Wedding',
				'Window'          => 'Window',
				'Personal letter' => 'Personal letter'
			)
		) );

		$dm->add_field( array(
			'name'    => esc_html__( 'Testimonial Used?', 'elfsr' ),
			'id'      => self::prefix . 'ad_use_testimonial',
			'type'    => 'checkbox',
			'options' => array(
				'true' => 'Yes a testimonial was used'
			)
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'Images of the direct mail piece', 'elfsr' ),
			'id'   => self::prefix . 'add_images',
			'type' => 'file_list'
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'Distribution Details', 'elfsr' ),
			'id'   => self::prefix . 'distribution_title',
			'type' => 'title'
		) );

		$dm->add_field( array(
			'name'    => esc_html__( 'Distribution Method', 'elfsr' ),
			'id'      => self::prefix . 'ad_dm_method',
			'type'    => 'select',
			'options' => array(
				''                 => 'Select one',
				'Direct Mail'      => 'Direct Mail',
				'EDDM'             => 'EDDM',
				'Window'           => 'Window',
				'Own mailing list' => 'Own mailing list'
			)
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'List provider name', 'elfsr' ),
			'id'   => self::prefix . 'ad_list_provider',
			'type' => 'text'
		) );

		$dm->add_field( array(
			'name'            => esc_html__( 'Number Sent', 'elfsr' ),
			'id'              => self::prefix . 'ad_dm_number_set',
			'type'            => 'text_small',
			'sanitization_cb' => array( $this, 'sanitize_int_field' ), // custom sanitization callback parameter
			'attributes'      => array(
				'pattern' => '^\d+$', // positive integers only
				'title'   => esc_attr__( 'Numbers only', 'elfsr' ),
			)
		) );

		$dm->add_field( array(
			'name'    => esc_html__( 'List Selection', 'elfsr' ),
			'id'      => self::prefix . 'ad_dm_list_selection',
			'type'    => 'multicheck_inline',
			'options' => array(
				'Income'        => 'Income',
				'Homeownership' => 'Homeownership',
				'Wealthfinder'  => 'Wealthfinder',
				'Radius'        => 'Radius',
			)
		) );

		$dm->add_field( array(
			'name'    => esc_html__( 'List Scrubbing', 'elfsr' ),
			'id'      => self::prefix . 'ad_dm_list_scrub',
			'type'    => 'select',
			'options' => array(
				''                                       => 'Select one',
				'Remove all past registrants'            => 'Remove all past registrants',
				'Remove past registrants within 30 days' => 'Remove past registrants within 30 days',
				'Not Scrubbed'                           => 'Not Scrubbed'
			)
		) );

		$dm->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_email_meta() {

		$em = new_cmb2_box( array(
			'id'            => self::prefix . 'email_metabox',
			'title'         => esc_html__( 'Email Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'email' )
			),
		) );

		$em->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$em->add_field( array(
			'name' => esc_html__( 'Subject Line', 'elfsr' ),
			'id'   => self::prefix . 'ad_email_subject_line',
			'type' => 'text'
		) );

		$em->add_field( array(
			'name' => esc_html__( 'From', 'elfsr' ),
			'id'   => self::prefix . 'ad_email_from',
			'type' => 'text'
		) );

		$em->add_field( array(
			'name' => esc_html__( 'List source', 'elfsr' ),
			'id'   => self::prefix . 'ad_email_list_source',
			'type' => 'text'
		) );

		$em->add_field( array(
			'name' => esc_html__( 'Content Description', 'elfsr' ),
			'id'   => self::prefix . 'ad_email_content_description',
			'type' => 'textarea_small'
		) );

		$em->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_digital_ad_meta() {

		$da = new_cmb2_box( array(
			'id'            => self::prefix . 'digital_ad_metabox',
			'title'         => esc_html__( 'Digital Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'digital-ad' )
			),
		) );

		$da->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$da->add_field( array(
			'name'    => esc_html__( 'Ad Type', 'elfsr' ),
			'id'      => self::prefix . 'ad_da_type',
			'type'    => 'select',
			'options' => array(
				''         => 'Select one',
				'Facebook' => 'Facebook',
				'Adwords'  => 'Adwords',
				'LinkedIn' => 'LinkedIn',
				'other'    => 'Other'
			)
		) );

		$da->add_field( array(
			'name'       => esc_html__( 'Ad Type Description', 'elfsr' ),
			'id'         => self::prefix . 'ad_da_type_description',
			'type'       => 'textarea_small',
			'show_on_cb' => 'show_digital_ad_type_description_field'
		) );

		$da->add_field( array(
			'name' => esc_html__( 'Images of the digital ad', 'elfsr' ),
			'id'   => self::prefix . 'add_images',
			'type' => 'file_list'
		) );

		$da->add_field( array(
			'name' => esc_html__( 'Target Audience', 'elfsr' ),
			'id'   => self::prefix . 'ad_da_target_audience',
			'type' => 'textarea_small'
		) );

		$da->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_social_meta() {

		$s = new_cmb2_box( array(
			'id'            => self::prefix . 'social_metabox',
			'title'         => esc_html__( 'Social Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'social' )
			),
		) );

		$s->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$s->add_field( array(
			'name'    => esc_html__( 'Social Media Platform', 'elfsr' ),
			'id'      => self::prefix . 'ad_social_platform',
			'type'    => 'select',
			'options' => array(
				''         => 'Select one',
				'Facebook' => 'Facebook',
				'Twitter'  => 'Twitter',
				'LinkedIn' => 'LinkedIn',
				'other'    => 'Other'
			)
		) );

		$s->add_field( array(
			'name'       => esc_html__( 'Social Platform Description', 'elfsr' ),
			'id'         => self::prefix . 'ad_social_platform_description',
			'type'       => 'textarea_small',
			'show_on_cb' => 'show_social_platform_description_field'
		) );

		$s->add_field( array(
			'name' => esc_html__( 'Images of the digital ad', 'elfsr' ),
			'id'   => self::prefix . 'add_images',
			'type' => 'file_list'
		) );

		$s->add_field( array(
			'name' => esc_html__( 'Target Audience', 'elfsr' ),
			'id'   => self::prefix . 'ad_social_target_audience',
			'type' => 'textarea_small'
		) );

		$s->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_newspaper_meta() {

		$np = new_cmb2_box( array(
			'id'            => self::prefix . 'newspaper_metabox',
			'title'         => esc_html__( 'Newspaper Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'newspaper' )
			),
		) );

		$np->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$np->add_field( array(
			'name'    => esc_html__( 'Newspaper Type', 'elfsr' ),
			'id'      => self::prefix . 'ad_newspaper_type',
			'type'    => 'select',
			'options' => array(
				''         => 'Select one',
				'Daily' => 'Daily',
				'Weekly'  => 'Weekly',
			)
		) );

		$np->add_field( array(
			'name'    => esc_html__( 'Newspaper Ad Type', 'elfsr' ),
			'id'      => self::prefix . 'ad_newspaper_ad_type',
			'type'    => 'select',
			'options' => array(
				''         => 'Select one',
				'Display' => 'Display',
				'Insert'  => 'Insert',
			)
		) );

		$np->add_field( array(
			'name' => esc_html__( 'Images of the digital ad', 'elfsr' ),
			'id'   => self::prefix . 'add_images',
			'type' => 'file_list'
		) );

		$np->add_field( array(
			'name' => esc_html__( 'Add Date', 'elfsr' ),
			'id'   => self::prefix . 'ad_newspaper_date',
			'type' => 'text_date'
		) );

		$np->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_other_print_meta() {

		$op = new_cmb2_box( array(
			'id'            => self::prefix . 'other_print_metabox',
			'title'         => esc_html__( 'Other Print Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'other-print' )
			),
		) );

		$op->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$op->add_field( array(
			'name' => esc_html__( 'Images of the digital ad', 'elfsr' ),
			'id'   => self::prefix . 'add_images',
			'type' => 'file_list'
		) );

		$op->add_field( array(
			'name' => esc_html__( 'Add Date', 'elfsr' ),
			'id'   => self::prefix . 'ad_other_print_date',
			'type' => 'text_date'
		) );

		$op->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_radio_meta() {

		$r = new_cmb2_box( array(
			'id'            => self::prefix . 'radio_metabox',
			'title'         => esc_html__( 'Radio Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'radio' )
			),
		) );

		$r->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$r->add_field( array(
			'name' => esc_html__( 'Radio Station', 'elfsr' ),
			'id'   => self::prefix . 'ad_station',
			'type' => 'text'
		) );

		$r->add_field( array(
			'name' => esc_html__( 'Add Air Date', 'elfsr' ),
			'id'   => self::prefix . 'ad_radio_air_date',
			'type' => 'text_date'
		) );

		$r->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_tv_meta() {

		$tv = new_cmb2_box( array(
			'id'            => self::prefix . 'tv_metabox',
			'title'         => esc_html__( 'Television Ad Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'television' )
			),
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'TV Station', 'elfsr' ),
			'id'   => self::prefix . 'ad_station',
			'type' => 'text'
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'Add Air Date', 'elfsr' ),
			'id'   => self::prefix . 'ad_tv_air_date',
			'type' => 'text_date'
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function add_type_other_meta() {

		$tv = new_cmb2_box( array(
			'id'            => self::prefix . 'other_ad_type_metabox',
			'title'         => esc_html__( 'Other Ad Type Details', 'elfsr' ),
			'object_types'  => array( 'ads' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			'show_on_cb'    => array( $this, 'taxonomy_show_on_filter' ), // function should return a bool value
			'show_on_terms' => array(
				'ad_type' => array( 'other-ad-type' )
			),
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'Nickname', 'elfsr' ),
			'id'   => self::prefix . 'ad_nickname',
			'type' => 'text'
		) );

		$tv->add_field( array(
			'name' => esc_html__( 'Notes', 'elfsr' ),
			'id'   => self::prefix . 'ad_notes',
			'type' => 'textarea_small'
		) );
	}

	public function campaign_meta() {

		$c = new_cmb2_box( array(
			'id'            => self::prefix . 'campaign_metabox',
			'title'         => esc_html__( 'Campaign Details', 'elfsr' ),
			'object_types'  => array( 'campaign' ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		) );

		$c->add_field( array(
			'name'       => esc_html__( 'Events', 'elfsr' ),
			'id'         => self::prefix . 'campaign_events',
			'type'       => 'multicheck',
			'options_cb' => array( $this, 'event_posts_by_lawfirm' )
		) );

		$c->add_field( array(
			'name'       => esc_html__( 'Ads', 'elfsr' ),
			'id'         => self::prefix . 'campaign_ads',
			'type'       => 'multicheck',
			'options_cb' => array( $this, 'ad_posts_by_lawfirm' )
		) );
	}

	/**
	 * Custom Options Callbacks - creates the options list
	 *
	 * @param array $field This is an instance of the field object
	 *
	 * @return array
	 */

	public function venue_posts_by_lawfirm( $field ) {
		$post_id    = $field->object_id;   // event post id
		$lawfirm_id = $this->get_lawfirm_id( $post_id );
		if ( empty( $lawfirm_id ) ) {
			return array( '' => 'No Law Firm is selected for this event' );
		}

		$options_array = $this->get_posts_by_lawfirm( 'venue', $lawfirm_id );
		if ( empty( $options_array ) ) {
			return array( '' => 'No venu exists for this law firm' );
		} else {
			return $options_array;
		}


	}

	public function event_posts_by_lawfirm( $field ) {
		$post_id    = $field->object_id;   // event post id
		$lawfirm_id = $this->get_lawfirm_id( $post_id );
		if ( empty( $lawfirm_id ) ) {
			return array( '' => 'No Law Firm is selected for this campaign' );
		}

		$options_array = $this->get_posts_by_lawfirm( 'events', $lawfirm_id );
		if ( empty( $options_array ) ) {
			return array( '' => 'No event exists for this law firm' );
		} else {
			return $options_array;
		}


	}

	public function ad_posts_by_lawfirm( $field ) {
		$post_id    = $field->object_id;   // event post id
		$lawfirm_id = $this->get_lawfirm_id( $post_id );
		if ( empty( $lawfirm_id ) ) {
			return array( '' => 'No Law Firm is selected for this campaign' );
		}

		$options_array = $this->get_posts_by_lawfirm( 'ads', $lawfirm_id );
		if ( empty( $options_array ) ) {
			return array( '' => 'No ad exists for this law firm' );
		} else {
			return $options_array;
		}


	}

	public function get_lawfirm_id( $post_id ) {
		$firms = wp_get_post_terms( $post_id, 'firm', array( "fields" => "ids" ) );
		if ( empty( $firms ) ) {
			return false;
		}
		$lawfirm_id = $firms[0];

		return $lawfirm_id;
	}

	public function get_posts_by_lawfirm( $post_type, $lawfirm_id ) {
		$args  = array(
			'post_type' => $post_type,
			'tax_query' => array(
				array(
					'taxonomy' => 'firm',
					'field'    => 'term_id',
					'terms'    => $lawfirm_id
				)
			)
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				$title                  = get_the_title();
				$options_list[ $title ] = $title;
			endwhile;

			return $options_list;
		} else {
			return false;
		}
	}


	/**
	 * Custom "Show On" Callbacks - creates conditional displays
	 *
	 * @param array $cmb This is an instance of the CMB2_Types object
	 *
	 * @return bool
	 */
	public function show_venue_seating_arrangement_description_field( $cmb ) {
		$arrangement = get_post_meta( $cmb->object_id(), self::prefix . 'venue_seating_arrangement', 1 );

		// Only show if arrangement is 'other'
		return 'other' === $arrangement;
	}

	public function show_presentation_presenter_type_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'presentation_presenter_type' );
		if ( in_array( 'other', $type ) ) {
			return true;
		} else {
			return false;
		}

	}

	public function show_presentation_topic_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'presentation_topic', 1 );

		return 'other' === $type;
	}

	public function show_presentation_av_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'presentation_av' );
		if ( in_array( 'other', $type ) ) {
			return true;
		} else {
			return false;
		}

	}

	public function show_event_registration_method_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'event_registration_method' );
		if ( in_array( 'other', $type ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function show_event_offer_type_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'event_offer', 1 );

		return 'other' === $type;
	}

	public function show_digital_ad_type_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'ad_da_type_description', 1 );

		return 'other' === $type;
	}

	public function show_social_platform_description_field( $cmb ) {
		$type = get_post_meta( $cmb->object_id(), self::prefix . 'ad_social_platform_description', 1 );

		return 'other' === $type;
	}

	/**
	 * Custom CMB2 Fields
	 *
	 * @param  CMB2_Field $field The field object
	 * @param  mixed $escaped_value The value of this field passed through the escaping filter.
	 * @param  int $object_id The id of the object you are working with. Most commonly, the post id
	 * @param  string $object_type The type of object you are working with. Most commonly, post
	 * @param  array $field_type_object This is an instance of the CMB2_Types object
	 *
	 * @return array        New field type.
	 */


	public function create_zip_code_field( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
		echo $field_type_object->input( array( 'class' => 'cmb2-text-small', 'type' => 'text' ) );
	}


	/**
	 * Handles custom sanitization
	 *
	 * @param  mixed $value The unsanitized value from the form.
	 * @param  array $field_args Array of field arguments.
	 * @param  CMB2_Field $field The field object
	 *
	 * @return mixed                  Sanitized value to be stored.
	 */

	public function sanitize_zip_code_field( $value, $field_args, $field ) {
		if ( preg_match( "^[0-9]{5}([- /]?[0-9]{4})?$^", $value ) ) {
			return $value;
		} else {
			return '';
		}

	}

	public function sanitize_int_field( $value, $field_args, $field ) {
		if ( preg_match( "^\d+$^", $value ) ) {
			return $value;
		} else {
			return '';
		}

	}

	public function sanitize_int_or_float_field( $value, $field_args, $field ) {
		if ( preg_match( "^([0-9]*|\d*\.\d{1}?\d*)$^", $value ) ) {
			return $value;
		} else {
			return '';
		}

	}

	/**
	 * Taxonomy show_on filter
	 * @author Bill Erickson
	 *
	 * @param  object $cmb CMB2 object
	 *
	 * @return bool        True/false whether to show the metabox
	 */
	public function taxonomy_show_on_filter( $cmb ) {
		$tax_terms_to_show_on = $cmb->prop( 'show_on_terms', array() );
		if ( empty( $tax_terms_to_show_on ) || ! $cmb->object_id() ) {
			return false;
		}
		$post_id = $cmb->object_id();
		$post    = get_post( $post_id );
		foreach ( (array) $tax_terms_to_show_on as $taxonomy => $slugs ) {
			if ( ! is_array( $slugs ) ) {
				$slugs = array( $slugs );
			}
			$terms = $post
				? get_the_terms( $post, $taxonomy )
				: wp_get_object_terms( $post_id, $taxonomy );
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $slugs, true ) ) {

						// Ok, show this metabox
						return true;
					}
				}
			}
		}

		return false;
	}


}