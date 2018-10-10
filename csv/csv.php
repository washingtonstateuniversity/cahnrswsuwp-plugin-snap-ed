<?php

namespace WSUWP\CAHNRSWSUWP_Plugins\SNAP_ED;

class CSV {

	public function __construct() {

		$this->add_filters();

	} // End __construct


	private function add_filters() {

		if ( isset( $_GET['csv'] ) ) {

			add_filter( 'template_include', array( $this, 'get_csv_template' ), 1 );

		} // End if

	} // End add_filters


	public function get_csv_template( $template ) {

		return __DIR__ . '/csv-template.php';

	}


} // End CAHNRSWSUWP_Plugin_SNAP_ED

$csv = new CSV();
