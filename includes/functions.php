<?php

function call_sightmap_api() {
	header( 'Access-Control-Allow-Origin:*' );
	$api_url = 'https://api.sightmap.com/v1/assets/1273/multifamily/units?per-page=250';
	$api_key = '7d64ca3869544c469c3e7a586921ba37';
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
		$data = json_decode( $response, true );
		$array = $data['data'];


		foreach ( $array as $value ) {
			$unit_number = $value['unit_number'];
			$asset_id = $value['asset_id'];
			$building_id = $value['building_id'];
			$floor_id = $value['floor_id'];
			$floor_plan_id = $value['floor_plan_id'];
			$area = $value['area'];


			$args = array(
				'post_title' => $unit_number,
				'post_status' => 'publish',
				'post_type' => 'unit',
				'meta_input' => array(
					'asset_id' => $asset_id,
					'building_id' => $building_id,
					'floor_id' => $floor_id,
					'floor_plan_id' => $floor_plan_id,
					'area' => $area, ) );




			$post = wp_insert_post( $args, true );

			if ( $post ) {

			} else {
				echo "Post failure";
			}
		}

	}
	wp_die();
}
add_action( 'wp_ajax_call_sightmap_api', 'call_sightmap_api' );
add_action( 'wp_ajax_nopriv_call_sightmap_api', 'call_sightmap_api' );




function add_unit_post_type() {

	function unit_post_type() {

		$args = array(
			'labels' => array(
				'name' => 'Units',
				'singular_name' => 'Unit',
				'add_new' => 'Add New Unit',
				'add_new_item' => 'Add New Unit',
				'edit_item' => 'Edit Unit',
				'view_item' => 'View Unit',
				'search_items' => 'Search Units',
				'menu_name' => 'Units',

			)
			, 'public' => true,
			'show_in_menu' => 'edit.php',
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'unit' ),
			'title' => 'Unit Number'
		);

		register_post_type( 'unit', $args );
	}
	unit_post_type();

	function custom_fields() {

		register_meta( 'unit', 'floor_id', [ 
			'type' => 'string',
			'description' => 'Custom field for the floor ID',
			'single' => true,
			'show_in_rest' => true,
		] );

		register_meta( 'unit', 'asset_id', [ 
			'type' => 'string',
			'description' => 'Custom field for the asset ID',
			'single' => true,
			'show_in_rest' => true,
		] );

		register_meta( 'unit', 'building_id', [ 
			'type' => 'string',
			'description' => 'Custom field for the building ID',
			'single' => true,
			'show_in_rest' => true,
		] );

		register_meta( 'unit', 'floor_plan_id', [ 
			'type' => 'string',
			'description' => 'Custom field for the floor plan ID',
			'single' => true,
			'show_in_rest' => true,
		] );

		register_meta( 'unit', 'area', [ 
			'type' => 'number',
			'description' => 'Custom field for area',
			'single' => true,
			'show_in_rest' => true,
		] );
		// unit_number field is not currently being used. Waiting on clarification regarding the project requirements. Currently the unit_number value on a data point coming from the API is being used as the post title value.
		register_meta( 'unit', 'unit_number', [ 
			'type' => 'string',
			'description' => 'Custom field for the unit number',
			'single' => true,
			'show_in_rest' => true,
		] );
	}
	custom_fields();

	// functions add custom column to hold floor_plan_id field
	function floor_plan_column_header( $columns ) {
		$columns['floor_plan_id'] = "Floor Plan ID";
		return $columns;
	}
	function floor_plan_column_content( $column, $post_id ) {
		if ( $column == 'floor_plan_id' ) {
			echo get_post_meta( $post_id, 'floor_plan_id', true );
		}
	}
	// Changes the name of the title column to 'Unit Number'
	function title_column_name_change( $columns ) {
		$columns['title'] = 'Unit Number';
		return $columns;
	}
	// changes the order of the columns on the admin list table 
	function reorder_table_columns( $columns ) {
		unset( $columns['date'] );
		$columns['title'] = 'Unit Number';
		$columns['floor_plan_id'] = 'Floor Plan ID';
		$columns['date'] = 'Date';

		return $columns;
	}


	// Add the custom column to the post type
	add_filter( 'manage_unit_posts_columns', 'floor_plan_column_header', 10 );
	add_action( 'manage_unit_posts_custom_column', 'floor_plan_column_content', 10, 2 );
	add_filter( 'manage_unit_posts_columns', 'title_column_name_change' );
	add_filter( 'manage_unit_posts_columns', 'reorder_table_columns' );
}