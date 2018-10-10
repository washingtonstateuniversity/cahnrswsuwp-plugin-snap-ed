<?php namespace WSUWP\CAHNRSWSUWP_Plugins\SNAP_ED;

class CSV_Template {

    public function __construct() {

        $this->import_file();

    }


    private function import_file() {

        $csv = array();

        $row = 1;

        if ( ( $handle = fopen( __DIR__ . '/csv.csv', 'r' ) ) !== FALSE) {

            while ( ( $data = fgetcsv( $handle, 1000, ',' ) ) !== FALSE && $row < 5 ) {

                //var_dump( $data );

                if ( ! empty( $data[0] ) ) {

                    $this->create_profile( $data );

                } // End if

                $row++;

            } // End while

            fclose( $handle );

        } // End if

    } // End import_file


    private function create_profile( $row ) {

        var_dump( $row );

        $regions_terms = explode( '/', $row[0] );
        $region_ids = array();
        $affiliation_term = $row[1];
        $affiliation_ids = array();
        $name = $row[2];
        $postion_title = $row[3];
        $email = $row[4];
        $phone = $row[5];

        foreach( $regions_terms as $region_term ) {

            // Check if the state exists
            $term = term_exists( $region_term, 'region', 0 );

            // Create state if it doesn't exist
            if ( ! $term ) {
                $term = wp_insert_term( $region_term, 'region', array( 'parent' => 0 ) );
            }

            if ( is_array( $term ) ) {

                $region_ids[] = $term['term_id'];

            }

        } 

        $af_term = term_exists( $affiliation_term, 'affiliation', 0 );

        if ( ! $af_term ) {

            $af_term = wp_insert_term( $affiliation_term, 'affiliation', array( 'parent' => 0 ) );
        
        }

        if ( is_array( $af_term ) ) {

            $affiliation_ids[] = $af_term['term_id'];

        }

        $name_array = explode( ' ', $name );

        $l_name = array_pop( $name_array );

        $post = array(
            'post_title' => $name,
            'post_type' => 'profile',
            'post_status' => 'publish',
            'meta_input' => array(
                '_wsuwp_profile_phone' => $phone,
                '_wsuwp_profile_email' => $email,
                '_wsuwp_profile_position_title' => $postion_title,
                '_wsuwp_profile_last_name' => $l_name,
            ),
            'tax_input' => array(
                'region' => $region_ids,
                'affiliation' => $affiliation_ids,
            ),
        );

        //var_dump( $post );

        wp_insert_post( $post );

    }

} // End CSV_Template

$csv_template = new CSV_Template();