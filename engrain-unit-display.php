<?php



/*
Plugin Name: Housing Unit Display
Description: A WordPress plugin that accesses the sightmap API to display location data in a formatted list
Version: 1.0
Author: Matthew Todor
*/

include 'includes/functions.php';
include 'admin/unit-admin-page.php';
add_unit_post_type();
add_action( 'admin_menu', 'unit_admin_page_menus' );