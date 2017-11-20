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

}