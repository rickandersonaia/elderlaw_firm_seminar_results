<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/17/2017
 * Time: 9:54 AM
 */

class ELFSR_Taxonomies {

	public function __construct() {
		add_action( 'init', array($this, 'law_firm_post_type') );
	}

}