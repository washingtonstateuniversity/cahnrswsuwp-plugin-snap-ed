<?php

namespace WSUWP\CAHNRSWSUWP_Plugins\SNAP_ED;

class People {

	public function __construct() {

		$this->add_filters();

		$this->add_actions();

	} // End __construct


	private function add_filters() {

		add_filter( 'core_post_feed_local_item_array', array( $this, 'get_people_item' ), 10, 3 );

		add_filter( 'core_post_feed_items_html', array( $this, 'get_people_displays' ), 10, 3 );

	}


	private function add_actions() {

		add_action( 'init', array( $this, 'add_taxonomies' ), 999999 );

	} // End add_actions


	public function get_people_item( $item, $post_id, $atts ) {

		if ( 'profile' === $item['post_type'] ) {

			$regions = wp_get_post_terms( $post_id, 'region', array( 'fields' => 'names' ) );

			$affiliations = wp_get_post_terms( $post_id, 'affiliation', array( 'fields' => 'names' ) );

			$item['regions'] = ( ! empty( $regions ) ) ? implode(', ', $regions ) : '';

			$item['affiliations'] = ( ! empty( $affiliations ) ) ? implode(', ', $affiliations ) : '';

		} // End if

		return $item;

	} // End get_people_item


	public function add_taxonomies() {

		// Add new taxonomy, make it hierarchical (like categories)
		$region_labels = array(
			'name'              => _x( 'Regions', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Region', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Regions', 'textdomain' ),
			'all_items'         => __( 'All Regions', 'textdomain' ),
			'parent_item'       => __( 'Parent Region', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Region:', 'textdomain' ),
			'edit_item'         => __( 'Edit Region', 'textdomain' ),
			'update_item'       => __( 'Update Region', 'textdomain' ),
			'add_new_item'      => __( 'Add New Region', 'textdomain' ),
			'new_item_name'     => __( 'New Region Name', 'textdomain' ),
			'menu_name'         => __( 'Region', 'textdomain' ),
		);

		$region_args = array(
			'hierarchical'      => true,
			'labels'            => $region_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'region' ),
		);

		register_taxonomy( 'region', array( 'profile' ), $region_args );

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Affiliations', 'taxonomy general name', 'textdomain' ),
			'singular_name'     => _x( 'Affiliation', 'taxonomy singular name', 'textdomain' ),
			'search_items'      => __( 'Search Affiliations', 'textdomain' ),
			'all_items'         => __( 'All Affiliations', 'textdomain' ),
			'parent_item'       => __( 'Parent Affiliation', 'textdomain' ),
			'parent_item_colon' => __( 'Parent Affiliation:', 'textdomain' ),
			'edit_item'         => __( 'Edit Affiliation', 'textdomain' ),
			'update_item'       => __( 'Update Affiliation', 'textdomain' ),
			'add_new_item'      => __( 'Add New Affiliation', 'textdomain' ),
			'new_item_name'     => __( 'New Affiliation Name', 'textdomain' ),
			'menu_name'         => __( 'Affiliation', 'textdomain' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'affiliation' ),
		);

		register_taxonomy( 'affiliation', array( 'profile' ), $args );

	}


	public function get_people_displays( $html, $items, $settings ) {

		if ( 'profile' === $settings['post_type'] ) {

			switch( $settings['display'] ) {

				case 'contact-table':
					$html .= $this->get_contact_table_display( $items, $settings );
					break;

			}

		} // End if

		return $html;

	} // End get_people_displays


	private function get_contact_table_display( $items, $settings ) {

		usort( $items, array( $this, 'sort_items' ) );

		ob_start();

		echo '<div class="profile-contact-table">';

		include __DIR__ . '/displays/contact-table-row-header.php';

		foreach( $items as $item ) {

			$region          = ( ! empty( $item['regions'] ) ) ? $item['regions'] : '';
			$affiliation     = ( ! empty( $item['affiliations'] ) ) ? $item['affiliations'] : '';
			$position_title  = ( ! empty( $item['position_title'] ) ) ? $item['position_title'] : '';
			$name            = ( ! empty( $item['title'] ) ) ? $item['title'] : '';
			$phone           = ( ! empty( $item['phone'] ) ) ? $item['phone'] : '';
			$email           = ( ! empty( $item['email'] ) ) ? $item['email'] : '';

			include __DIR__ . '/displays/contact-table-row.php';		

		} // End foreach

		echo '</div>';

		$html = ob_get_clean();

		return $html;

	}


	public function sort_items( $a, $b ) {

		$a_name = $a['last_name'];

		$b_name = $b['last_name'];

		return ( $a_name < $b_name ) ? -1 : 1;

	} // End sort_authors



} // End CAHNRSWSUWP_Plugin_SNAP_ED

$cahnrswsuwp_plugin_snap_ed_people = new People();
