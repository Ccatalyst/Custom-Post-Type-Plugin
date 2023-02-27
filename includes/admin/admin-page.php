<?php
//Okay, this was a trip. shout out to Mo Ismailzai on the Mugo Web Blog for his article on complex fields to custom post types https://www.mugo.ca/Blog/Adding-complex-fields-to-WordPress-custom-post-types

function meta_box_callback($field_name, $field_display_name, $post ){
	wp_nonce_field( basename( __FILE__ ), $field_name . '_meta_box_nonce' );

	$item_id = get_post_meta( $post->ID, $field_name, true );
	$item_field = $field_name . '_field';

	echo '<label for="' . $item_field . '">' . $field_display_name .  '</label>';
	echo '<input type="text" id="' . $item_field . '" name="' . $item_field . '" value="' . esc_attr( $item_id ) . '">';
}

function add_floor_id_meta_box() {
	add_meta_box(
		'floor_id_meta_box',
		'Floor ID',
		'floor_id_meta_box_callback',
		'unit'
	);
}

function floor_id_meta_box_callback( $post ) {
	meta_box_callback( 'floor_id', 'Floor ID', $post );
}

function save_floor_id_meta_box( $post_id ) {
	if ( ! isset( $_POST['floor_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['floor_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['floor_id_field'] ) ) {
		update_post_meta( $post_id, 'floor_id', sanitize_text_field( $_POST['floor_id_field'] ) );
	}
}



function add_floor_plan_id_meta_box() {
	add_meta_box(
		'floor_plan_id_meta_box',
		'Floor Plan ID',
		'floor_plan_id_meta_box_callback',
		'unit'
	);
}

function floor_plan_id_meta_box_callback( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'floor_plan_id_meta_box_nonce' );

	$floor_plan_id = get_post_meta( $post->ID, 'floor_plan_id', true );
	echo '<label for="floor_plan_id_field">Floor Plan ID </label>';
	echo '<input type="text" id="floor_plan_id_field" name="floor_plan_id_field" value="' . esc_attr( $floor_plan_id ) . '">';
}

function save_floor_plan_id_meta_box( $post_id ) {
	if ( ! isset( $_POST['floor_plan_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['floor_plan_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['floor_plan_id_field'] ) ) {
		update_post_meta( $post_id, 'floor_plan_id', sanitize_text_field( $_POST['floor_plan_id_field'] ) );
	}
}

add_action( 'add_meta_boxes_unit', 'add_floor_plan_id_meta_box' );
add_action( 'save_post_unit', 'save_floor_plan_id_meta_box' );

function add_asset_id_meta_box() {
	add_meta_box(
		'asset_id_meta_box',
		'Asset ID',
		'asset_id_meta_box_callback',
		'unit'
	);
}

function asset_id_meta_box_callback( $post ) {
	// this adds a security nonce(number used once) to the metabox. Adding a conditional within the save function that checks to see if the number that's passed to the wp_verify_nonce HTTP POST method. nonce lasts 24 hours by default
	// The basename just throws out all the leading filepath up to the last dir in the filepath. 
	wp_nonce_field( basename( __FILE__ ), 'asset_id_meta_box_nonce' );

	// Assigns the current post's asset_id value to a variable. We don't want it in an array or anything, so we add the $single = true third argument.
	$asset_id = get_post_meta( $post->ID, 'asset_id', true );
	// The actual HTML for the input. Takes the asset_id variable above and plops it in there using the esc_attr WP method
	echo '<label for="asset_id_field">Asset ID </label>';
	echo '<input type="text" id="asset_id_field" name="asset_id_field" value="' . esc_attr( $asset_id ) . '">';
}

function save_asset_id_meta_box( $post_id ) {
	if ( ! isset( $_POST['asset_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['asset_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['asset_id_field'] ) ) {
		update_post_meta( $post_id, 'asset_id', sanitize_text_field( $_POST['asset_id_field'] ) );
	}
}

add_action( 'add_meta_boxes_unit', 'add_asset_id_meta_box' );
add_action( 'save_post_unit', 'save_asset_id_meta_box' );




function add_building_id_meta_box() {
	add_meta_box(
		'building_id_meta_box',
		'Building ID',
		'building_id_meta_box_callback',
		'unit'
	);
}

function building_id_meta_box_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'building_id_meta_box_nonce' );
	$building_id = get_post_meta( $post->ID, 'building_id', true );
	echo '<label for="building_id_field">Building ID </label>';
	echo '<input type="text" id="building_id_field" name="building_id_field" value="' . esc_attr( $building_id ) . '">';
}

function save_building_id_meta_box( $post_id ) {
	if ( ! isset( $_POST['building_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['building_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['building_id_field'] ) ) {
		update_post_meta( $post_id, 'building_id', sanitize_text_field( $_POST['building_id_field'] ) );
	}
}

add_action( 'add_meta_boxes_unit', 'add_building_id_meta_box' );
add_action( 'save_post_unit', 'save_building_id_meta_box' );



function add_area_meta_box() {
	add_meta_box(
		'area_meta_box',
		'Area',
		'area_meta_box_callback',
		'unit'
	);
}


function area_meta_box_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'area_meta_box_nonce' );

	$area = get_post_meta( $post->ID, 'area', true );
	echo '<label for="area_field">Area </label>';
	echo '<input type="text" id="area_field" name="area_field" value="' . esc_attr( $area ) . '">';
}

function save_area_meta_box( $post_id ) {
	if ( ! isset( $_POST['area_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['area_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST['area_field'] ) ) {
		update_post_meta( $post_id, 'area', sanitize_text_field( $_POST['area_field'] ) );
	}
}

add_action( 'add_meta_boxes_unit', 'add_area_meta_box' );
add_action( 'save_post_unit', 'save_area_meta_box' );
// function to add button that calls function to get api data and convert it into unit post types

function add_API_call_button_to_post_table() {
	global $post_type;
	if ( $post_type === 'unit' ) {

		?>
		<script>
			jQuery(document).ready(function ($) {

				$('#api-call').on('click', function () {

					$.ajax({
						url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
						type: 'post',
						data: {
							action: 'call_sightmap_api',
						},
						success: function (response) {
							console.log(response);
							alert("Posts added from API successfully");
						},
						error: function (xhr, status, error) {
							console.log(xhr.responseTest);
							alert("Something went wrong");
						}
					})
				})

			})
		</script>
		<?php

		echo '<div class="alignleft actions"> <button id="api-call" class="button">Add Units from API</button></div>';
	}

}

add_action( 'add_meta_boxes_unit', 'add_floor_id_meta_box' );
add_action( 'save_post_unit', 'save_floor_id_meta_box' );




add_action( 'restrict_manage_posts', 'add_API_call_button_to_post_table', 99 );