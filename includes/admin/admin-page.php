<?php
// TODO: create a button that will run the api query function. When the data is returned, it needs to be looped over and the data turned into unit posts via wp_insert_post WP function https://developer.wordpress.org/reference/functions/wp_insert_post/  





/*
BELOW: functions to add custom edit boxes for created fields on unit post type
*/
function floor_id_edit() {


	// Okay, this was a trip. shout out to Mo Ismailzai on the Mugo Web Blog for his article on complex fields to custom post types https://www.mugo.ca/Blog/Adding-complex-fields-to-WordPress-custom-post-types

	// add_floor_id_meta_box creates the box to edit the floor_id in the edit page for the post. The callback in the third argument is below
	function add_floor_id_meta_box() {
		add_meta_box(
			'floor_id_meta_box',
			'Floor ID',
			'floor_id_meta_box_callback',
			'unit'
		);
	}

	/* 
	callback function for the add_meta_box WP function
	
	*/
	function floor_id_meta_box_callback( $post ) {
		// this adds a security nonce(number used once) to the metabox. Adding a conditional within the save function that checks to see if the number that's passed to the wp_verify_nonce HTTP POST method.
		// The basename just throws out all the leading filepath up to the last dir in the filepath. 
		wp_nonce_field( basename( __FILE__ ), 'floor_id_meta_box_nonce' );

		// Assigns the current post's floor_id value to a variable. We don't want it in an array or anything, so we add the $single = true third argument.
		$floor_id = get_post_meta( $post->ID, 'floor_id', true );
		// The actual HTML for the input. Takes the floor_id variable above and plops it in there using the esc_attr WP method
		echo '<label for="floor_id_field">Floor ID </label>';
		echo '<input type="text" id="floor_id_field" name="floor_id_field" value="' . esc_attr( $floor_id ) . '">';
	}

	// this actually allows for saving the above input value when it's changed. 
	function save_floor_id_meta_box( $post_id ) {
		// checks to see if the nonce created above exists, or if it can't verify the nonce. If either are false, it exits the function
		if ( ! isset( $_POST['floor_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['floor_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}
		// if 'DOING_AUTOSAVE' is defined and it's true, exit the function. Variable is set by wp_autosave function

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// If the currently logged in user can't edit posts, exit the function.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// If the floor_id_field exists, run the update_post_meta WP function. The new value is sanitized to remove tags, extra whitespace, etc. 
		if ( isset( $_POST['floor_id_field'] ) ) {
			update_post_meta( $post_id, 'floor_id', sanitize_text_field( $_POST['floor_id_field'] ) );
		}
	}

	add_action( 'add_meta_boxes_unit', 'add_floor_id_meta_box' );
	add_action( 'save_post_unit', 'save_floor_id_meta_box' );
}
floor_id_edit();
function floor_plan_id_edit() {



	// add_floor_plan_id_meta_box creates the box to edit the floor_plan_id in the edit page for the post. The callback in the third argument is below
	function add_floor_plan_id_meta_box() {
		add_meta_box(
			'floor_plan_id_meta_box',
			'Floor Plan ID',
			'floor_plan_id_meta_box_callback',
			'unit'
		);
	}

	/* 
	callback function for the add_meta_box WP function
	
	*/
	function floor_plan_id_meta_box_callback( $post ) {
		// this adds a security nonce(number used once) to the metabox. Adding a conditional within the save function that checks to see if the number that's passed to the wp_verify_nonce HTTP POST method. nonce lasts 24 hours by default
		// The basename just throws out all the leading filepath up to the last dir in the filepath. 
		wp_nonce_field( basename( __FILE__ ), 'floor_plan_id_meta_box_nonce' );

		// Assigns the current post's floor_plan_id value to a variable. We don't want it in an array or anything, so we add the $single = true third argument.
		$floor_plan_id = get_post_meta( $post->ID, 'floor_plan_id', true );
		// The actual HTML for the input. Takes the floor_plan_id variable above and plops it in there using the esc_attr WP method
		echo '<label for="floor_plan_id_field">Floor Plan ID </label>';
		echo '<input type="text" id="floor_plan_id_field" name="floor_plan_id_field" value="' . esc_attr( $floor_plan_id ) . '">';
	}

	// this actually allows for saving the above input value when it's changed. 
	function save_floor_plan_id_meta_box( $post_id ) {
		// checks to see if the nonce created above exists, or if it can't verify the nonce. If either are false, it exits the function
		if ( ! isset( $_POST['floor_plan_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['floor_plan_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}
		// if 'DOING_AUTOSAVE' is defined and it's true, exit the function. Variable is set by wp_autosave function

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// If the currently logged in user can't edit posts, exit the function.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// If the floor_plan_id_field exists, run the update_post_meta WP function. The new value is sanitized to remove tags, extra whitespace, etc. 
		if ( isset( $_POST['floor_plan_id_field'] ) ) {
			update_post_meta( $post_id, 'floor_plan_id', sanitize_text_field( $_POST['floor_plan_id_field'] ) );
		}
	}

	add_action( 'add_meta_boxes_unit', 'add_floor_plan_id_meta_box' );
	add_action( 'save_post_unit', 'save_floor_plan_id_meta_box' );
}
floor_plan_id_edit();
function asset_id_edit() {



	// add_asset_id_meta_box creates the box to edit the asset_id in the edit page for the post. The callback in the third argument is below
	function add_asset_id_meta_box() {
		add_meta_box(
			'asset_id_meta_box',
			'Asset ID',
			'asset_id_meta_box_callback',
			'unit'
		);
	}

	/* 
	callback function for the add_meta_box WP function
	Floor_plan ID
	*/
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

	// this actually allows for saving the above input value when it's changed. 
	function save_asset_id_meta_box( $post_id ) {
		// checks to see if the nonce created above exists, or if it can't verify the nonce. If either are false, it exits the function
		if ( ! isset( $_POST['asset_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['asset_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}
		// if 'DOING_AUTOSAVE' is defined and it's true, exit the function. Variable is set by wp_autosave function

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// If the currently logged in user can't edit posts, exit the function.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// If the asset_id_field exists, run the update_post_meta WP function. The new value is sanitized to remove tags, extra whitespace, etc. 
		if ( isset( $_POST['asset_id_field'] ) ) {
			update_post_meta( $post_id, 'asset_id', sanitize_text_field( $_POST['asset_id_field'] ) );
		}
	}

	add_action( 'add_meta_boxes_unit', 'add_asset_id_meta_box' );
	add_action( 'save_post_unit', 'save_asset_id_meta_box' );
}
asset_id_edit();
function building_id_edit() {



	// add_building_id_meta_box creates the box to edit the building_id in the edit page for the post. The callback in the third argument is below
	function add_building_id_meta_box() {
		add_meta_box(
			'building_id_meta_box',
			'Building ID',
			'building_id_meta_box_callback',
			'unit'
		);
	}

	/* 
	callback function for the add_meta_box WP function
	Floor_plan ID
	*/
	function building_id_meta_box_callback( $post ) {
		// this adds a security nonce(number used once) to the metabox. Adding a conditional within the save function that checks to see if the number that's passed to the wp_verify_nonce HTTP POST method. nonce lasts 24 hours by default
		// The basename just throws out all the leading filepath up to the last dir in the filepath. 
		wp_nonce_field( basename( __FILE__ ), 'building_id_meta_box_nonce' );

		// Assigns the current post's building_id value to a variable. We don't want it in an array or anything, so we add the $single = true third argument.
		$building_id = get_post_meta( $post->ID, 'building_id', true );
		// The actual HTML for the input. Takes the building_id variable above and plops it in there using the esc_attr WP method
		echo '<label for="building_id_field">Building ID </label>';
		echo '<input type="text" id="building_id_field" name="building_id_field" value="' . esc_attr( $building_id ) . '">';
	}

	// this actually allows for saving the above input value when it's changed. 
	function save_building_id_meta_box( $post_id ) {
		// checks to see if the nonce created above exists, or if it can't verify the nonce. If either are false, it exits the function
		if ( ! isset( $_POST['building_id_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['building_id_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}
		// if 'DOING_AUTOSAVE' is defined and it's true, exit the function. Variable is set by wp_autosave function

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// If the currently logged in user can't edit posts, exit the function.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// If the building_id_field exists, run the update_post_meta WP function. The new value is sanitized to remove tags, extra whitespace, etc. 
		if ( isset( $_POST['building_id_field'] ) ) {
			update_post_meta( $post_id, 'building_id', sanitize_text_field( $_POST['building_id_field'] ) );
		}
	}

	add_action( 'add_meta_boxes_unit', 'add_building_id_meta_box' );
	add_action( 'save_post_unit', 'save_building_id_meta_box' );
}
building_id_edit();
function area_edit() {



	// add_area_meta_box creates the box to edit the area in the edit page for the post. The callback in the third argument is below
	function add_area_meta_box() {
		add_meta_box(
			'area_meta_box',
			'Area',
			'area_meta_box_callback',
			'unit'
		);
	}

	/* 
	callback function for the add_meta_box WP function
	Floor_plan ID
	*/
	function area_meta_box_callback( $post ) {
		// this adds a security nonce(number used once) to the metabox. Adding a conditional within the save function that checks to see if the number that's passed to the wp_verify_nonce HTTP POST method. nonce lasts 24 hours by default
		// The basename just throws out all the leading filepath up to the last dir in the filepath. 
		wp_nonce_field( basename( __FILE__ ), 'area_meta_box_nonce' );

		// Assigns the current post's area value to a variable. We don't want it in an array or anything, so we add the $single = true third argument.
		$area = get_post_meta( $post->ID, 'area', true );
		// The actual HTML for the input. Takes the area variable above and plops it in there using the esc_attr WP method
		echo '<label for="area_field">Area </label>';
		echo '<input type="text" id="area_field" name="area_field" value="' . esc_attr( $area ) . '">';
	}

	// this actually allows for saving the above input value when it's changed. 
	function save_area_meta_box( $post_id ) {
		// checks to see if the nonce created above exists, or if it can't verify the nonce. If either are false, it exits the function
		if ( ! isset( $_POST['area_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['area_meta_box_nonce'], basename( __FILE__ ) ) ) {
			return;
		}
		// if 'DOING_AUTOSAVE' is defined and it's true, exit the function. Variable is set by wp_autosave function

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// If the currently logged in user can't edit posts, exit the function.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		// If the area_field exists, run the update_post_meta WP function. The new value is sanitized to remove tags, extra whitespace, etc. 
		if ( isset( $_POST['area_field'] ) ) {
			update_post_meta( $post_id, 'area', sanitize_text_field( $_POST['area_field'] ) );
		}
	}

	add_action( 'add_meta_boxes_unit', 'add_area_meta_box' );
	add_action( 'save_post_unit', 'save_area_meta_box' );
}
area_edit();





/* 
BELOW: function to add button that calls function to get api data and convert it into unit post types
*/

function add_API_call_button_to_post_table() {
	global $post_type;
	if ( 'unit' === $post_type ) {
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
add_action( 'restrict_manage_posts', 'add_API_call_button_to_post_table' );