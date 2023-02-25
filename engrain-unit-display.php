<?php



/*
Plugin Name: Housing Unit Display
Description: A WordPress plugin that accesses the sightmap API to display location data in a formatted list
Version: 1.0
Author: Matthew Todor
*/

include 'includes/functions.php';
include 'includes/unit-admin-page.php';
add_action( 'admin_menu', 'unit_admin_pages' );

add_action( "init", "add_unit_post_type" );
add_action( 'init', 'custom_fields' );
add_filter( 'manage_unit_posts_columns', "floor_plan_column_header", 10, 2 );
add_action( 'manage_unit_posts_custom_column', 'floor_plan_column_content', 10, 2 );