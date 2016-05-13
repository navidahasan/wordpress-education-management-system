<?php
/*
Plugin Name: RRF Education Management
Plugin URI: http://rrfoundation.net/
Description: This plugin will enable education management in your wordpress site. 
Author: RR Foundation
Author URI: http://rrfoundation.net
Version: 1.0
*/


// Registering plugin assets
require_once('admin/plugin-assets.php');

// Registering gallery custom post
require_once('admin/rrf-edu-cpt.php');

// Including CMB2
require_once('libs/cmb2/init.php');

// CMB2 metabox condtions
require_once('libs/cmb2-conditions/cmb-conditions.php');

// Register gallery metabox fields
require_once('admin/rrf-edu-metaboxes.php');

// Registering gallery shortcode
require_once('admin/rrf-edu-plugin-shortcodes.php');

// Add shortcode just after the_content on page 
require_once('admin/rrf-edu-page-shortcode-filter.php');