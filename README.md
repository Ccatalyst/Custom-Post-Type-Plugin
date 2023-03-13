# Custom Post Type Plugin

## Description

A WordPress plugin designed to be used with an API for property assets, specifically multi-family units. A custom post type called Unit is created upon activating the plugin for your WordPress site, and units can be added from the API in the click of a button.

The functions provided are written in a way to be used continuously, and can be brought into other projects to operate in a similar fashion. 

## Table of Contents

**[Installation Instructions](#installation)**

**[Usage Information](#usage)**

**[Questions](#questions)**

## Installation

1. Move the directory into the plugins folder found in the wp-content directory of your WordPress Website.
2. Open the functions.php file located in the "includes" directory of the plugin folder in a text editor.
3. In the call_sightmap_api function, replace the <API_url> text with your API URL, and the <API_key> text with your provided API key.
4. Ensure that you have SSL encrypton set up and enabled in your php config file (namely curl and openssl).
5. Navigate to the plugins menu of your WordPress admin panel and activate the plugin.

## Usage

The custom post type can be found under the Post top-level menu item. To create units from the API, there is a button in the table navigation that says "Add Units from API". It will reach out the the API and create as many new posts as the API returns. Each can be edited like a standard post, with the custom fields available to edit on the edit page.

To display a table of the unit posts currently available on your site, the shortcode [unit-split-list] can be used. This will query all unit posts and organize them into two tables: One where the area field of the post is larger than 1, and the other where the area field is equal to 1. A note: if you use the button on the Unit post admin table list page to add unit posts, the tables will be large. You can modify the number of posts that are collected in the shortcode.php file of the plugin.

## Questions

Any additional questions?

You can contact me at:

unclejunglegeorge@gmail.com

or find me on Github

[Ccatalyst](https://github.com/Ccatalyst)
