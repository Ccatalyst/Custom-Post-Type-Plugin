<?php
//Shout out to Mo Ismailzai on the Mugo Web Blog for his article on complex fields to custom post types https://www.mugo.ca/Blog/Adding-complex-fields-to-WordPress-custom-post-types

function meta_box_callback( $field_name, $field_display_name, $post ) {
	wp_nonce_field( basename( __FILE__ ), $field_name . '_meta_box_nonce' );

	$item_id = get_post_meta( $post->ID, $field_name, true );
	$item_field = $field_name . '_field';

	echo '<label for="' . $item_field . '">' . $field_display_name . '</label>';
	echo '<input type="text" id="' . $item_field . '" name="' . $item_field . '" value="' . esc_attr( $item_id ) . '">';
}
function save_meta_box( $field_name, $post_id ) {
	$item_field = $field_name . '_field';
	if ( ! isset( $_POST[ $field_name . '_meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST[ $field_name . '_meta_box_nonce' ], basename( __FILE__ ) ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	if ( isset( $_POST[ $item_field ] ) ) {
		update_post_meta( $post_id, $field_name, sanitize_text_field( $_POST[ $item_field ] ) );
	}
}

// add meta box functions
function add_floor_id_meta_box() {
	add_meta_box(
		'floor_id_meta_box',
		'Floor ID',
		'floor_id_meta_box_callback',
		'unit'
	);
}
function add_floor_plan_id_meta_box() {
	add_meta_box(
		'floor_plan_id_meta_box',
		'Floor Plan ID',
		'floor_plan_id_meta_box_callback',
		'unit'
	);
}
function add_asset_id_meta_box() {
	add_meta_box(
		'asset_id_meta_box',
		'Asset ID',
		'asset_id_meta_box_callback',
		'unit'
	);
}
function add_building_id_meta_box() {
	add_meta_box(
		'building_id_meta_box',
		'Building ID',
		'building_id_meta_box_callback',
		'unit'
	);
}
function add_area_meta_box() {
	add_meta_box(
		'area_meta_box',
		'Area',
		'area_meta_box_callback',
		'unit'
	);
}
//meta box callbacks 
function floor_id_meta_box_callback( $post ) {
	meta_box_callback( 'floor_id', 'Floor ID', $post );
}
function floor_plan_id_meta_box_callback( $post ) {
	meta_box_callback( 'floor_plan_id', 'Floor Plan ID', $post );
}
function asset_id_meta_box_callback( $post ) {
	meta_box_callback( 'asset_id', 'Asset ID', $post );
}
function building_id_meta_box_callback( $post ) {
	meta_box_callback( 'building_id', 'Building ID', $post );
}
function area_meta_box_callback( $post ) {
	meta_box_callback( 'area', 'Area', $post );
}

// meta box saves
function save_floor_id_meta_box( $post_id ) {
	save_meta_box( 'floor_id', $post_id );
}
function save_floor_plan_id_meta_box( $post_id ) {
	save_meta_box( 'floor_plan_id', $post_id );
}
function save_asset_id_meta_box( $post_id ) {
	save_meta_box( 'asset_id', $post_id );
}
function save_building_id_meta_box( $post_id ) {
	save_meta_box( 'building_id', $post_id );
}
function save_area_meta_box( $post_id ) {
	save_meta_box( 'area', $post_id );
}
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