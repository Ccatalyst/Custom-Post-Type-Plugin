<?php

function call_sightmap_api() {
	header( 'Access-Control-Allow-Origin:*' );
	$api_url = '<API url>';
	$api_key = '<API key>';
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
			if ( ! $post ) {
				echo "Post failure";
			}
		}
	}
	wp_die();
}
function unit_post_type() {

	$args = array(
		// a few labels to make it consistent. Not all have been changed, TODO:
		'labels' => array(
			'name' => 'Units',
			'singular_name' => 'Unit',
			'add_new' => 'Add New Unit',
			'add_new_item' => 'Add New Unit',
			'edit_item' => 'Edit Unit',
			'view_item' => 'View Unit',
			'search_items' => 'Search Units',
			'menu_name' => 'Units',

		),
		'public' => true,
		'show_in_menu' => 'edit.php',
		'has_archive' => true,
		'rewrite' => array( 'slug' => 'unit' ),
		'title' => 'Unit Number'
	);

	register_post_type( 'unit', $args );
}
function register_custom_field( $field_name, $field_display_name ) {
	register_meta( 'unit', $field_name, [ 
		'type' => 'string',
		'description' => 'Custom field for the ' . $field_display_name,
		'single' => true,
		'show_in_rest' => true,
	] );
}
function add_unit_custom_fields() {
	register_custom_field( 'floor_id', 'floor ID' );
	register_custom_field( 'asset_id', 'asset ID' );
	register_custom_field( 'building_id', 'building ID' );
	register_custom_field( 'floor_plan_id', 'floor plan ID' );
	register_custom_field( 'area', 'area' );
	// unit_number field is not currently being used. Waiting on clarification regarding the project requirements. Currently the unit_number value on a data point coming from the API is being used as the post title value.
	register_custom_field( 'unit_number', 'unit number' );
}
function add_custom_column_header( $field_name, $field_display_name, $columns ) {
	$columns[ $field_name ] = $field_display_name;
	return $columns;
}
function add_custom_column_content( $field_name, $column, $post_id ) {
	if ( $column == $field_name ) {
		echo get_post_meta( $post_id, $field_name, true );
	}
}
function add_unit_post_type() {
	unit_post_type();
	add_unit_custom_fields();
	// functions add custom column to hold floor_plan_id field
	function floor_plan_column_header( $columns ) {
		add_custom_column_header( 'floor_plan_id', 'Floor Plan Id', $columns );
	}
	function floor_plan_column_content( $column, $post_id ) {
		add_custom_column_content( 'floor_plan_id', $column, $post_id );
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

	add_filter( 'manage_unit_posts_columns', 'floor_plan_column_header', 10 );
	add_action( 'manage_unit_posts_custom_column', 'floor_plan_column_content', 10, 2 );
	add_filter( 'manage_unit_posts_columns', 'title_column_name_change' );
	add_filter( 'manage_unit_posts_columns', 'reorder_table_columns' );
}