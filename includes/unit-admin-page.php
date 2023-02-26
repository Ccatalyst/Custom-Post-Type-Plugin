<?php
// TODO: create a button that will run the api query function. When the data is returned, it needs to be looped over and the data turned into unit posts via wp_insert_post WP function https://developer.wordpress.org/reference/functions/wp_insert_post/  


// TODO: Add inputs for all custom fields on unit edit page via add_meta_box


function unit_admin_pages() {
	add_menu_page( 'Engrain Units', 'Units', 'manage_options', 'unit-admin-page', 'unit_admin_page_callback', '', 6 );
}

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
		echo '<label for="floor_id_field">Floor ID</label>';
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