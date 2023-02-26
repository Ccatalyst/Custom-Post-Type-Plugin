<?php

function call_sightmap_api() {

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
		echo $response;
	}
}



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
		$columns['floor_plan_id'] = 'Floor Plan Id';
		$columns['date'] = 'Date';

		return $columns;
	}


	// Add the custom column to the post type
	add_filter( 'manage_unit_posts_columns', 'floor_plan_column_header', 10 );
	add_action( 'manage_unit_posts_custom_column', 'floor_plan_column_content', 10, 2 );
	add_filter( 'manage_unit_posts_columns', 'title_column_name_change' );
	add_filter( 'manage_unit_posts_columns', 'reorder_table_columns' );
}