<?php

/*
Plugin Name: Engrain Unit Display
Description: A WordPress plugin that accesses the sightmap API to display location data in a formatted list
Version: 1.0
Author: Matthew Todor
*/

/*
WISHLIST: to be addressed once assessment requirements are met
-Make Floor Plan ID column sortable
-Alter unit list page to be structured more like the category/tag pages, with the "create new" fields right on the page.
-Look into and implement uninstall functions to clear data when the plugin is uninstalled.
-Alter various names to be changed when viewed by non-english-language users.
*/


include 'includes/functions.php';
include 'includes/admin/admin-page.php';
include 'includes//frontend/shortcode/shortcode.php';
// Creating custom post type 'Unit'
add_action( "init", "add_unit_post_type" );
add_shortcode( 'unit_split_list', 'units_split_list' );