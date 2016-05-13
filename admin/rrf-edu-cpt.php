<?php

// Registering gallery thumbnail
//add_image_size( 'gallery-thumb', 240, 160, true );


// Registering custom post type
add_action( 'init', 'rrf_edu_management_plugin_cpt' );
function rrf_edu_management_plugin_cpt() { 
	register_post_type( 'rrf-edu-attendance',
		array(
			'labels' => array(
				'name' => __( 'Attendances', 'rrf-education-theme' ),
				'singular_name' => __( 'Attendance', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new attendance', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-forms',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'page-attributes'),
		)
	);  
	register_post_type( 'rrf-edu-notice',
		array(
			'labels' => array(
				'name' => __( 'Notices', 'rrf-education-theme' ),
				'singular_name' => __( 'Notice', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new notice', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-exerpt-view',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'editor', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-teacher',
		array(
			'labels' => array(
				'name' => __( 'Teachers', 'rrf-education-theme' ),
				'singular_name' => __( 'Teachers', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new teacher', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-groups',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'thumbnail', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-student',
		array(
			'labels' => array(
				'name' => __( 'Students', 'rrf-education-theme' ),
				'singular_name' => __( 'Student', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new student', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-welcome-learn-more',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-prostudent',
		array(
			'labels' => array(
				'name' => __( 'Best students', 'rrf-education-theme' ),
				'singular_name' => __( 'Best student', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new best student', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-star-filled',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'thumbnail', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-vacency',
		array(
			'labels' => array(
				'name' => __( 'Vacencies', 'rrf-education-theme' ),
				'singular_name' => __( 'Vacency', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new vacency', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-location-alt',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-routine',
		array(
			'labels' => array(
				'name' => __( 'Routines', 'rrf-education-theme' ),
				'singular_name' => __( 'Routine', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new routine', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-performance',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-result',
		array(
			'labels' => array(
				'name' => __( 'Results', 'rrf-education-theme' ),
				'singular_name' => __( 'Result', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new result', 'rrf-education-theme' )
			),
            'menu_icon' => 'dashicons-analytics',
			'public' => false,
            'show_ui' => true,
			'supports' => array('title', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-committee',
		array(
			'labels' => array(
				'name' => __( 'Committies', 'rrf-education-theme' ),
				'singular_name' => __( 'Committee', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new committee', 'rrf-education-theme' )
			),
			'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-networking',
			'supports' => array('title', 'thumbnail', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-employee',
		array(
			'labels' => array(
				'name' => __( 'Employies', 'rrf-education-theme' ),
				'singular_name' => __( 'Employee', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new employee', 'rrf-education-theme' )
			),
			'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-businessman',
			'supports' => array('title', 'page-attributes'),
		)
	);
	register_post_type( 'rrf-edu-photogallery',
		array(
			'labels' => array(
				'name' => __( 'Photogalleries', 'rrf-education-theme' ),
				'singular_name' => __( 'Photogallery', 'rrf-education-theme' ),
				'add_new_item' => __( 'Add new photogallery', 'rrf-education-theme' )
			),
			'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-images-alt2',
			'supports' => array('title', 'page-attributes'),
		)
	);

	
}
