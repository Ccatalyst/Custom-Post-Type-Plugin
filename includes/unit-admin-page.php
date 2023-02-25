<?php
// TODO: create a button that will run the api query function. When the data is returned, it needs to be looped over and the data turned into unit posts via wp_insert_post WP function https://developer.wordpress.org/reference/functions/wp_insert_post/  Testing is needed to confirm the custom fields are a part of the unit post meta
function unit_admin_page_callback() {
	?>
	<div class="wrap">
		<h2>Welcome To My Plugin</h2>
	</div>
	<?php
}

// TODO:Move the callbacks to their own files, they're going to get larger with the forms and such. For the edit page of the unit post type, extend the WP_Post class and overwrite what is needed, such as the url to the custom edit page.
function unit_admin_subpage_callback() {
	?>
	<div>
		<h2>SubPage</h2>
	</div>
	<?php
}
function unit_admin_pages() {
	add_menu_page( 'Engrain Units', 'Units Admin', 'manage_options', 'unit-admin-page', 'unit_admin_page_callback', '', 6 );

	add_submenu_page( 'unit-admin-page', 'Unit edit', 'Unit Edit', 'manage_options', 'unit-admin-subpage', 'unit_admin_subpage_callback' );
	add_submenu_page( 'edit.php?post_type=unit', 'Unit edit', 'Unit Editing', 'manage_options', 'unit-admin-edit-subpage', 'unit_admin_subpage_callback' );
}