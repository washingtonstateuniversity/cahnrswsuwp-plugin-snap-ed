<?php

namespace WSUWP\CAHNRSWSUWP_Plugins\SNAP_ED;

class CAHNRSWSUWP_Plugin_SNAP_ED {


	public function __construct() {

		$this->setup_plugin();

		$this->add_actions();

	} // End __construct


	private function setup_plugin() {

		include_once __DIR__ . '/modules/people/people.php';

	} // End setup_plugin


	private function add_actions() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ) );

	}


	public function add_public_scripts() {

		wp_enqueue_style( 'snap-ed', plugin_dir_url( __FILE__ ) . '/style.css', array(), '0.0.2' );

	} // End add_public_scripts
 
} // End CAHNRSWSUWP_Plugin_SNAP_ED

$cahnrswsuwp_plugin_snap_ed = new CAHNRSWSUWP_Plugin_SNAP_ED();
