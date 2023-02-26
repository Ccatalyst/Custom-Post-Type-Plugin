<?php



/*
Plugin Name: Housing Unit Display
Description: A WordPress plugin that accesses the sightmap API to display location data in a formatted list
Version: 1.0
Author: Matthew Todor
*/

include 'includes/functions.php';
include 'includes/unit-admin-page.php';
// Creating custom post type 'Unit'
add_action( "init", "add_unit_post_type" );


// setting up the admin pages for the unit type
add_action( 'admin_menu', 'unit_admin_pages' );