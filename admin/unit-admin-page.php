<?php
function unit_admin_page_callback() {
	?>
	<div class="wrap">
		<h2>Welcome To My Plugin</h2>
	</div>
	<?php
}
function unit_admin_page_menus() {
	add_menu_page( 'Units', 'Units-Admin', 'manage_options', 'admin/unit-admin-page.php', 'unit_admin_page_callback', '', 6 );

}