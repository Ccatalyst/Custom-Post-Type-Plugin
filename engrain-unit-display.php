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
include 'includes/frontend/shortcode/shortcode.php';
// Creating custom post type 'Unit'
add_action( "init", "add_unit_post_type" );
add_shortcode( 'unit_split_list', 'units_split_list' );
// ajax calls for front end ajax call to php function
add_action( 'wp_ajax_call_sightmap_api', 'call_sightmap_api' );
add_action( 'wp_ajax_nopriv_call_sightmap_api', 'call_sightmap_api' );
//actions for adding edit boxes for custom fields to unit post edit page 
add_action( 'add_meta_boxes_unit', 'add_floor_id_meta_box' );
add_action( 'add_meta_boxes_unit', 'add_floor_plan_id_meta_box' );
add_action( 'add_meta_boxes_unit', 'add_asset_id_meta_box' );
add_action( 'add_meta_boxes_unit', 'add_building_id_meta_box' );
add_action( 'add_meta_boxes_unit', 'add_area_meta_box' );
//actions for saving edit boxes of custom fields
add_action( 'save_post_unit', 'save_floor_id_meta_box' );
add_action( 'save_post_unit', 'save_floor_plan_id_meta_box' );
add_action( 'save_post_unit', 'save_asset_id_meta_box' );
add_action( 'save_post_unit', 'save_building_id_meta_box' );
add_action( 'save_post_unit', 'save_area_meta_box' );
//adds button to call API to the navigation bar of the unit post table
add_action( 'restrict_manage_posts', 'add_API_call_button_to_post_table', 99 );