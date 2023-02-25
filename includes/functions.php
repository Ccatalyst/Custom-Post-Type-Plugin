<?php

function call_sightmap_api() {

	$api_url = '***REMOVED***';
	$api_key = '***REMOVED***';
	$curl = curl_init();

	curl_setopt_array( $curl, [ 
		CURLOPT_URL => $api_url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [ 

			"API-Key: " . $api_key
		],
	] );

	$response = curl_exec( $curl );
	$err = curl_error( $curl );
	curl_close( $curl );
	if ( $err ) {

		echo 'cURL Error #:' . $err;
	} else {
		echo $response;
	}
}



function add_unit_post_type() {

	function unit_post_type() {

		$args = array(
			'labels' => array(
				'name' => 'Units',
				'singular_name' => 'Unit'
			)
			, 'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'units' ),
		);
		register_post_type( 'unit_post_type', $args );
	}
	function custom_columns( $columns ) {
		$columns['floor_plan_id'] = "Floor Plan ID";
		return $columns;
	}
	;
	add_action( "init", "unit_post_type" );
	add_filter( 'manage_unit_post_type_columns', "custom_columns", 10, 2 );
}