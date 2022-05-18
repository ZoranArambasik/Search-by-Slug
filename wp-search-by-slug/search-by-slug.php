<?php
/*
Plugin Name: Search by slug
Description: Search in wp-admin post types, menus and post type pages ACF fields by slug. Use "slug:any-slug-here" in the search box to get your results.
Version: 1.0.0
Author URI: https://iSource.com.mk
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require('column-url.php');
require('search-function.php');