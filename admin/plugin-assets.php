<?php

// Adding gallery files
function rrf_education_plugin_files(){
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );
    
    
    wp_enqueue_style('rep-magnific', plugin_dir_url( __FILE__ ) .'../libs/magnific-popup/magnific-popup.css');
    wp_enqueue_style('rep-remodal', plugin_dir_url( __FILE__ ) .'../libs/remodal/remodal.css');
    wp_enqueue_style('rep-fullcalendar', plugin_dir_url( __FILE__ ) .'../libs/fullcalendar/fullcalendar.min.css');
    
    wp_enqueue_style('rep-main', plugin_dir_url( __FILE__ ) .'../assets/css/rep-main.css');
     
    
    wp_enqueue_script( 'rep-moment-js', plugin_dir_url( __FILE__ ) . '../libs/fullcalendar/moment.min.js', array(), '20120206', true );
    wp_enqueue_script( 'rep-fullcalendar-js', plugin_dir_url( __FILE__ ) . '../libs/fullcalendar/fullcalendar.min.js', array(), '20120206', true );
    wp_enqueue_script( 'rep-remodal-js', plugin_dir_url( __FILE__ ) . '../libs/remodal/remodal.min.js', array(), '20120206', true );
    wp_enqueue_script( 'rep-magnific-js', plugin_dir_url( __FILE__ ) . '../libs/magnific-popup/jquery.magnific-popup.min.js', array(), '20120206', true );
    wp_enqueue_script( 'rep-infinitescroll-js', plugin_dir_url( __FILE__ ) . '../libs/infinite-scroll/jquery.infinitescroll.min.js', array(), '20120206', true );
    
    wp_enqueue_script( 'rep-imgloaded-js', plugin_dir_url( __FILE__ ) . '../libs/infinite-scroll/imagesloaded.pkgd.min.js', array(), '20120206', true );
    wp_enqueue_script( 'rep-main-js', plugin_dir_url( __FILE__ ) . '../assets/js/rep-main.js', array(), '20120206', true );
    
}
add_action('wp_enqueue_scripts', 'rrf_education_plugin_files'); 