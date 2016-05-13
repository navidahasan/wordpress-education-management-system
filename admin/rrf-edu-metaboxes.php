<?php


function rep_get_post_as_list( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => 10,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    } else {
        $post_options[0] = 'Nothing available!';
    }

    return $post_options;
}

function rep_get_studentlist_as_list_array() {
    return rep_get_post_as_list( array( 'post_type' => 'rrf-edu-student', 'numberposts' => -1 ) );
}

function rep_get_result_as_list_array() {
    return rep_get_post_as_list( array( 'post_type' => 'rrf-edu-result', 'numberposts' => -1 ) );
}


add_action( 'cmb2_admin_init', 'rrf_edu_plugin_register_metaboxes' );
function rrf_edu_plugin_register_metaboxes() {
	$rep_page_metabox = new_cmb2_box( array(
		'id'            => 'rep_page_metabox',
		'title'         => __( 'Add shortcode', 'cmb2' ),
		'object_types'  => array( 'page', )
	) );
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Select shortcode',
        'id'          => 'rep_shortcode_type',
        'type'        => 'select',
        'options'        => array(
            'nothing' => 'Don\'t add any shortcode',
            'notices' => 'Notices',
            'teachers' => 'Teachers',
            'students' => 'Students',
            'vacencies' => 'Vacencies',
            'routines' => 'Routines',
            'results' => 'Results',
            'committies' => 'Committies',
            'employies' => 'Employies',
            'photogalleries' => 'Photogalleries',
            'calendar' => 'Academic Calendar',
        ),
    ) ); 
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Teachers type',
        'id'          => 'teachers_type',
        'type'        => 'select',
        'options'        => array(
            'current' => 'Current teachers',
            'archived' => 'Previous teachers',
        ),
    ) );
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Students type',
        'id'          => 'students_type',
        'type'        => 'select',
        'options'        => array(
            'all' => 'All Students',
            'specific' => 'Specific class students',
            'pro' => 'Best students',
        ),
    ) );
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Select students',
        'id'          => 'select_students',
        'type'        => 'select',
        'options_cb' => 'rep_get_studentlist_as_list_array',
    ) );
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Routine type',
        'id'          => 'routines_type',
        'type'        => 'select',
        'options'        => array(
            'exam' => 'Exam routines',
            'class' => 'Class routines',
        ),
    ) ); 
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Result type',
        'id'          => 'result_type',
        'type'        => 'select',
        'options'        => array(
            'all' => 'All results',
            'individual' => 'Individual results',
        ),
    ) );  
    
    $rep_page_metabox->add_field( array(
        'name'          => 'Select result',
        'id'          => 'select_result',
        'type'        => 'select',
        'options_cb' => 'rep_get_result_as_list_array',
    ) );    
    
	$rep_attendance_metabox = new_cmb2_box( array(
		'id'            => 'rep_attandance_metabox',
		'title'         => __( 'Attendance info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-attendance', )
	) );
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Total students count',
        'id'          => 'total_students',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s present students count',
        'id'          => 'today_students_present',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s abesent students count',
        'id'          => 'today_students_absent',
        'type'        => 'text',
    ) );  
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Total teachers count',
        'id'          => 'total_teachers',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s present teachers count',
        'id'          => 'today_teachers_present',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s in leave teachers count',
        'id'          => 'today_teachers_absent',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Total employies count',
        'id'          => 'total_employies',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s present employies count',
        'id'          => 'today_employies_present',
        'type'        => 'text',
    ) ); 
    
    $rep_attendance_metabox->add_field( array(
        'name'          => 'Today\'s in leave employies count',
        'id'          => 'today_employies_absent',
        'type'        => 'text',
    ) ); 
    
    
	$rep_teacher_metabox = new_cmb2_box( array(
		'id'            => 'rep_teacher_metabox',
		'title'         => __( 'Teacher info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-teacher', )
	) ); 
    
    $rep_teacher_metabox->add_field( array(
        'name'          => 'Teacher type',
        'id'          => 'type',
        'type'        => 'select',
        'options'        => array(
            'current' => 'Current Teacher',
            'archived' => 'Archived Teacher',
        ),
    ) ); 
    
    $rep_teacher_metabox->add_field( array(
        'name'          => 'Teacher designation',
        'id'          => 'designation',
        'type'        => 'text',
    ) ); 
    
    $rep_teacher_metabox->add_field( array(
        'name'          => 'Teacher join date',
        'id'          => 'join_date',
        'type'        => 'text',
    ) ); 
    
    $rep_teacher_metabox->add_field( array(
        'name'          => 'Teacher resignation date',
        'id'          => 'end_date',
        'type'        => 'text',
    ) ); 
    
    
	$rep_student_metabox = new_cmb2_box( array(
		'id'            => 'rep_student_metabox',
		'title'         => __( 'Add students', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-student', )
	) );   
    
    $rep_student_list = $rep_student_metabox->add_field( array(
        'id'          => 'student_list',
        'type'        => 'group',
        'options'     => array(
            'group_title'   => __( 'Student no {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add another student', 'cmb2' ),
            'remove_button' => __( 'Remove student', 'cmb2' ),
            'sortable'      => true
        ),
    ) );

    $rep_student_metabox->add_group_field( $rep_student_list, array(
        'name' => 'Student name',
        'id'   => 'name',
        'type' => 'text',
    ) ); 

    $rep_student_metabox->add_group_field( $rep_student_list, array(
        'name' => 'Student division',
        'id'   => 'division',
        'type' => 'select',
        'options'        => array(
            'A' => 'A Division',
            'B' => 'B Division',
            'C' => 'C Division',
            'D' => 'D Division',
        ),
    ) );  

    $rep_student_metabox->add_group_field( $rep_student_list, array(
        'name' => 'Student roll',
        'id'   => 'roll',
        'type' => 'text',
    ) );    
    
	$rep_prostudent_metabox = new_cmb2_box( array(
		'id'            => 'rep_prostudent_metabox',
		'title'         => __( 'Student info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-prostudent', )
	) ); 
    
    $rep_prostudent_metabox->add_field( array(
        'name'          => 'Information',
        'id'          => 'info',
        'type'        => 'text',
    ) );  
    
	$rep_vacency_metabox = new_cmb2_box( array(
		'id'            => 'rep_vacency_metabox',
		'title'         => __( 'Vacency info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-vacency', )
	) ); 
    
    $rep_vacency_metabox->add_field( array(
        'name'          => 'Information',
        'id'          => 'info',
        'type'        => 'text',
    ) );
    
    $rep_vacency_metabox->add_field( array(
        'name'          => 'Opened date',
        'id'          => 'date',
        'type'        => 'text',
    ) ); 
    
	$rep_routine_metabox = new_cmb2_box( array(
		'id'            => 'rep_routine_metabox',
		'title'         => __( 'Routine info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-routine', )
	) );
    
    $rep_routine_metabox->add_field( array(
        'name'          => 'Routine type',
        'id'          => 'type',
        'type'        => 'select',
        'options'        => array(
            'class' => 'Class routine',
            'exam' => 'Exam routine',
        ),
    ) ); 
    
    $rep_routine_metabox->add_field( array(
        'name'          => 'Upload routine',
        'id'          => 'file',
        'type'        => 'file',
    ) );   
    
	$rep_result_metabox = new_cmb2_box( array(
		'id'            => 'rep_result_metabox',
		'title'         => __( 'Result info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-result', )
	) );
    
    $rep_result_metabox->add_field( array(
        'name'          => 'Result type',
        'id'          => 'type',
        'type'        => 'select',
        'options'        => array(
            'file' => 'File upload',
            'individual' => 'Studentwise result',
        ),
    ) ); 
    
    $rep_result_metabox->add_field( array(
        'name'          => 'Upload result',
        'id'          => 'file',
        'type'        => 'file',
    ) ); 
    
    $rep_result_metabox->add_field( array(
        'name'          => 'Total number text',
        'id'          => 'total_no_text',
        'type'        => 'text',
        'default'        => 'Total number',
    ) );   
    
    $rep_result_metabox->add_field( array(
        'name'          => 'Student number text',
        'id'          => 'student_no_text',
        'type'        => 'text',
        'default'        => 'Student number',
    ) );   
    
    $rep_result_metabox->add_field( array(
        'name'          => 'Total number',
        'id'          => 'total_no',
        'type'        => 'text',
        'default'        => '100',
    ) );   
    
    $rep_result_entry = $rep_result_metabox->add_field( array(
        'id'          => 'individual_results',
        'type'        => 'group',
        'options'     => array(
            'group_title'   => __( 'Result no {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Add another result', 'cmb2' ),
            'remove_button' => __( 'Remove result', 'cmb2' ),
            'sortable'      => true
        ),
    ) ); 
    
    $rep_result_metabox->add_group_field( $rep_result_entry, array(
        'name' => 'Student name',
        'id'   => 'name',
        'type' => 'text',
    ) ); 

    $rep_result_metabox->add_group_field( $rep_result_entry, array(
        'name' => 'Student division',
        'id'   => 'division',
        'type' => 'select',
        'options'        => array(
            'A' => 'A Division',
            'B' => 'B Division',
            'C' => 'C Division',
            'D' => 'D Division',
        ),
    ) );  

    $rep_result_metabox->add_group_field( $rep_result_entry, array(
        'name' => 'Student roll',
        'id'   => 'roll',
        'type' => 'text',
    ) ); 

    $rep_result_metabox->add_group_field( $rep_result_entry, array(
        'name' => 'Student number',
        'id'   => 'number',
        'type' => 'text',
    ) );  
    
    
	$rep_committee_metabox = new_cmb2_box( array(
		'id'            => 'rep_committee_metabox',
		'title'         => __( 'Committee info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-committee', )
	) ); 
    
    $rep_committee_metabox->add_field( array(
        'name'          => 'Designation',
        'id'          => 'designation',
        'type'        => 'text',
    ) );
    
    $rep_committee_metabox->add_field( array(
        'name'          => 'Start date',
        'id'          => 'start',
        'type'        => 'text',
    ) ); 
    
    $rep_committee_metabox->add_field( array(
        'name'          => 'End date',
        'id'          => 'end',
        'type'        => 'text',
    ) );     
    
    
	$rep_employee_metabox = new_cmb2_box( array(
		'id'            => 'rep_employee_metabox',
		'title'         => __( 'Employee info', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-employee', )
	) ); 
    
    $rep_employee_metabox->add_field( array(
        'name'          => 'Designation',
        'id'          => 'designation',
        'type'        => 'text',
    ) );
    
    $rep_employee_metabox->add_field( array(
        'name'          => 'Join date',
        'id'          => 'join',
        'type'        => 'text',
    ) ); 
    
    
	$rep_photogallery_metabox = new_cmb2_box( array(
		'id'            => 'rep_photogallery_metabox',
		'title'         => __( 'Upload photos', 'cmb2' ),
		'object_types'  => array( 'rrf-edu-photogallery', )
	) ); 
    
    $rep_photogallery_metabox->add_field( array(
        'id'          => 'photos',
        'type'        => 'file_list',
    ) ); 
};
