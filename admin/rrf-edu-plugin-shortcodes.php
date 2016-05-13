<?php 

function rep_notices_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '',
    ), $atts) );
     
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'rrf-edu-notice')
        );      
         
    $list = '<div class="remodal-list">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $notice_content = get_the_content();
        $list .= '
        <div id="notice-'.$idd.'" class="remodal" data-remodal-id="notice-'.$idd.'" role="dialog" aria-labelledby="notice-'.$idd.'Title" aria-describedby="notice-'.$idd.'Desc">
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div>
                <h2 id="notice-'.$idd.'Title">'.get_the_title().'</h2>
                <div class="rep-notice-content">
                    '.wpautop($notice_content).'
                </div>
            </div>
        </div> 
        ';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_notices_list', 'rep_notices_list_shortcode');  



function rep_notices_shortcode($atts){
	extract( shortcode_atts( array(
		'count' => '',
	), $atts) );
    
    global $paged;
    if($count) {
    $posts_per_page = $count;
    } else {
    $posts_per_page = 30;
    }
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-notice', 
        'paged' => $paged
    );
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $loading_text = __( 'loading ...', 'rrf-education-theme' );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);

    
    if($total_found_posts > $posts_per_page) {
        $next_page_class = 'rep-next-page-activate';
    } else {
        $next_page_class = '';
    }
		
	$list = '
    <div class="rep-shortcode-wrapper '.$next_page_class.'">
    <script>
        jQuery(document).ready(function($){
            $(".rep-notices-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-notices-list li",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".rep-next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".rep-next-page").click(function(){
                $(".rep-notices-list").infinitescroll(\'retrieve\');
                return false;
            }); 
        });
    </script>';
    
    $list .='
    '.do_shortcode('[rep_notices_list]').'
    <ul class="rep-notices-list">';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $notice_content = get_the_content();
		$list .= '<li><a href="#notice-'.$idd.'">'.get_the_title().' <span>'.get_the_date('l, F j, Y', $idd).'</span></a></li>';        
	endwhile;
	$list.= '</ul>';
    
    if($total_found_posts > $posts_per_page) {
        $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    }
    
	$list.= '</div>';
    
	
	return $list;
}
add_shortcode('rep_notices', 'rep_notices_shortcode');	


function rep_teachers_shortcode($atts){
	extract( shortcode_atts( array(
		'type' => 'current',
	), $atts) );
    
    global $paged;
    $posts_per_page = 30;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-teacher', 
        'meta_key' => 'type', 
        'meta_value' => $type, 
        'orderby' => 'menu_order', 
        'order' => 'ASC', 
        'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $photo_text = __( 'Photo', 'rrf-education-theme' );
    $name_text = __( 'Teacher name', 'rrf-education-theme' );
    $desi_text = __( 'Designation', 'rrf-education-theme' );
    $start_text = __( 'Joining date', 'rrf-education-theme' );
    $end_text = __( 'Resigning date', 'rrf-education-theme' );
    $loading_text = __( 'loading ...', 'rrf-education-theme' );
    
    if($total_found_posts > $posts_per_page) {
        $next_page_class = 'rep-next-page-activate';
    } else {
        $next_page_class = '';
    }
		
	$list = '
    <div class="rep-shortcode-wrapper '.$next_page_class.'">
    <script>
        jQuery(document).ready(function($){
            $(".rep-teacher-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-teacher-list tr",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".rep-next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".rep-next-page").click(function(){
                $(".rep-teacher-list").infinitescroll(\'retrieve\');
                return false;
            });            
        });
    </script>
    
    <table class="rep-boxed-table">
        <tr>
            <th class="rep-teacher-list-photo">'.$photo_text.'</th>
            <th class="rep-teacher-list-name">'.$name_text.'</th>
            <th class="rep-teacher-list-designation">'.$desi_text.'</th>
            <th class="rep-teacher-list-date">'.$start_text.'</th>';
        if($type == 'archived') {
        $list .='<th class="rep-teacher-list-enddate">'.$end_text.'</th>';
        }
    
    $list .='
        </tr>   
    </table>
    
    <table class="rep-boxed-table rep-teacher-list">';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $teacher_type = get_post_meta($idd, 'type', true);
        $teacher_designation = get_post_meta($idd, 'designation', true);
        $teacher_join_date = get_post_meta($idd, 'join_date', true);
        $teacher_end_date = get_post_meta($idd, 'end_date', true);
		$list .= '
        <tr>
            <td class="rep-teacher-list-photo">'.get_the_post_thumbnail($idd, 'thumbnail').'</td>
            <td class="rep-teacher-list-name">'.get_the_title().'</td>
            <td class="rep-teacher-list-designation">'.$teacher_designation.'</td>
            <td class="rep-teacher-list-date">'.$teacher_join_date.'</td>';
            if($teacher_type == 'archived' && $teacher_end_date) {
                $list .='<td class="rep-teacher-list-enddate">'.$teacher_end_date.'</td>';
            }
    
        $list .='
        </tr>
		';        
	endwhile;
	$list.= '</table>';
    
    if($total_found_posts > $posts_per_page) {
        $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    }
    
	$list.= '</div>';
    
	return $list;
}
add_shortcode('rep_teachers', 'rep_teachers_shortcode');

function rep_students_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => -1,
        'id' => '',
        'column' => '4',
    ), $atts) );
    
    if($id) {
        $q = new WP_Query( array('posts_per_page' => 1, 'post_type' => 'rrf-edu-student', 'p' => $id) );
    } else {
        $q = new WP_Query( array('posts_per_page' => $count, 'post_type' => 'rrf-edu-student', 'orderby' => 'menu_order','order' => 'ASC') );
    }
    
    if($column == '1'){
        $column_width = 'rep-one-column';
    } elseif($column == '2') {
        $column_width = 'rep-two-columns';
    } elseif($column == '3') {
        $column_width = 'rep-three-columns';
    } elseif($column == '4') {
        $column_width = 'rep-four-columns';
    }
    
    $division_text = __( 'Division', 'rrf-education-theme' );
    $roll_text = __( 'Roll', 'rrf-education-theme' );
    
    $student_link_no = 0;    
    $list = '<div class="rep-student-list">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $student_link_no++;
        $students = get_post_meta($idd, 'student_list', true);
        $list .= '<h3 class="rep-span-color-'.$student_link_no.'"><span>'.get_the_title().'</span></h3>
        <script>
            jQuery(document).ready(function($){
                $("#rep-student-column-wrap-'.$idd.'").masonry({
                    itemSelector: \'.rep-students-column\',
                    columnWidth: \'.rep-students-column\',
                });
            });
        </script>        
        <div id="rep-student-column-wrap-'.$idd.'" class="rep-student-column-wrap">';     
        foreach($students as $student){
            $list .='
            <div id="rep-students-column-'.$idd.'" class="rep-students-column '.$column_width.'">
                <div class="rep-single-student-item">
                    <h4>'.$student['name'].'</h4>';
            
                    if($student['division']){
                        $list .='<p>'.$student['division'].' '.$division_text.', '.$roll_text.': '.$student['roll'].'</p>';
                    } else {
                        $list .='<p>'.$roll_text.': '.$student['roll'].'</p>';
                    }
            
            $list .='
                </div>
            </div>';
        }
        $list .='</div>';
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_students', 'rep_students_shortcode');


function rep_prostudents_shortcode($atts){
	extract( shortcode_atts( array(
		'column' => '4',
	), $atts) );
    
    if($column == '1'){
        $column_width = 'rep-one-column';
    } elseif($column == '2') {
        $column_width = 'rep-two-columns';
    } elseif($column == '3') {
        $column_width = 'rep-three-columns';
    } elseif($column == '4') {
        $column_width = 'rep-four-columns';
    }   
    
    global $paged;
    $posts_per_page = 12;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-prostudent', 
        'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $prevpage_text = __( 'Previous page', 'rrf-education-theme' );
    $loading_text = __( 'Loading ...', 'rrf-education-theme' );
		
	$list = '
    <script>
        jQuery(document).ready(function($){
            $(".rep-pro-student-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-pro-student-list .rep-infinite-prostudent-item",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".rep-next-page").click(function(){
                $(".rep-pro-student-list").infinitescroll(\'retrieve\');
                return false;
            });            
        });
    </script>    
    <div class="rep-pro-student-list">';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $prostudent_why = get_post_meta($idd, 'info', true);
		$list .= '
        <div class="rep-students-column '.$column_width.' rep-infinite-prostudent-item">
        <div class="rep-single-prostudent-item">
            '.get_the_post_thumbnail($idd, 'thumbnail').'
            <h4>'.get_the_title().'</h4>
            <p>'.$prostudent_why.'</p>
        </div>
        </div>
		';        
	endwhile;
	$list.= '</div>';
    
    $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    
	
	return $list;
}
add_shortcode('rep_prostudents', 'rep_prostudents_shortcode');	



function rep_vacencies_shortcode($atts){
	extract( shortcode_atts( array(
		'type' => 'current',
	), $atts) );
    
    global $paged;
    $posts_per_page = 30;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-vacency', 
        'orderby' => 'menu_order', 
        'order' => 'ASC', 
        'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $name_text = __( 'Title', 'rrf-education-theme' );
    $subj_text = __( 'Subject', 'rrf-education-theme' );
    $start_text = __( 'Opened date', 'rrf-education-theme' );
    $loading_text = __( 'Loading ...', 'rrf-education-theme' );
		
    if($total_found_posts > $posts_per_page) {
        $next_page_class = 'rep-next-page-activate';
    } else {
        $next_page_class = '';
    }
		
	$list = '
    <div class="rep-shortcode-wrapper '.$next_page_class.'">
    <script>
        jQuery(document).ready(function($){
            $(".rep-vacency-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-vacency-list tr",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".rep-next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".rep-next-page").click(function(){
                $(".rep-vacency-list").infinitescroll(\'retrieve\');
                return false;
            });            
        });
    </script>
    
    <table class="rep-boxed-table">
        <tr>
            <th class="rep-vacency-list-name">'.$name_text.'</th>
            <th class="rep-vacency-list-subject">'.$subj_text.'</th>
            <th class="rep-vacency-list-date">'.$start_text.'</th>     
        </tr>    
    </table>
    <table class="rep-boxed-table rep-vacency-list">
    ';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $vacency_subject = get_post_meta($idd, 'info', true);
        $vacency_date = get_post_meta($idd, 'date', true);
		$list .= '
        <tr>
            <td class="rep-vacency-list-name">'.get_the_title().'</td>
            <td class="rep-vacency-list-subject">'.$vacency_subject.'</td>
            <td class="rep-vacency-list-date">'.$vacency_date.'</td>
        </tr>
		';        
	endwhile;
	$list.= '</table>';
    
    if($total_found_posts > $posts_per_page) {
        $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    }
    
	$list.= '</div>';
    
	
	return $list;
}
add_shortcode('rep_vacencies', 'rep_vacencies_shortcode');	



function rep_employee_shortcode($atts){
	extract( shortcode_atts( array(
		'type' => 'current',
	), $atts) );
    
    global $paged;
    $posts_per_page = 30;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-employee', 
        'orderby' => 'menu_order', 
        'order' => 'ASC', 
        'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $name_text = __( 'Employee name', 'rrf-education-theme' );
    $desi_text = __( 'Designation', 'rrf-education-theme' );
    $start_text = __( 'Joining date', 'rrf-education-theme' );
    $loading_text = __( 'Loading ...', 'rrf-education-theme' );
		
    if($total_found_posts > $posts_per_page) {
        $next_page_class = 'rep-next-page-activate';
    } else {
        $next_page_class = '';
    }
		
	$list = '
    <div class="rep-shortcode-wrapper '.$next_page_class.'">
    <script>
        jQuery(document).ready(function($){
            $(".rep-employee-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-employee-list tr",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".rep-next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".next-page").click(function(){
                $(".rep-employee-list").infinitescroll(\'retrieve\');
                return false;
            });            
        });
    </script>
    
    <table class="rep-boxed-table">
        <tr>
            <th class="rep-employee-list-name">'.$name_text.'</th>
            <th class="rep-employee-list-designation">'.$desi_text.'</th>
            <th class="rep-employee-list-date">'.$start_text.'</th>        
        </tr>   
    </table>    
    <table class="rep-boxed-table rep-employee-list">';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $employee_designation = get_post_meta($idd, 'designation', true);
        $employee_date = get_post_meta($idd, 'join', true);
		$list .= '
        <tr>
            <td class="rep-employee-list-name">'.get_the_title().'</td>
            <td class="rep-employee-list-designation">'.$employee_designation.'</td>
            <td class="rep-employee-list-date">'.$employee_date.'</td>
        </tr>
		';        
	endwhile;
	$list.= '</table>';
    
    if($total_found_posts > $posts_per_page) {
        $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    }
    
	$list.= '</div>';
    
	
	return $list;
}
add_shortcode('rep_employee', 'rep_employee_shortcode');


function rep_routines_shortcode($atts){
    extract( shortcode_atts( array(
        'type' => 'class',
    ), $atts) );
    
    $name_text = __( 'Name', 'rrf-education-theme' );
    $date_text = __( 'Publish date', 'rrf-education-theme' );
    $dl_text = __( 'Download', 'rrf-education-theme' );
     
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'rrf-edu-routine', 'meta_key' => 'type', 'meta_value' => $type, 'orderby' => 'menu_order','order' => 'ASC')
        );      
    $student_link_no = 0;    
    $list = '<div class="rep-shortcode-wrapper"><table class="rep-boxed-table routine-list">
        <tr>
            <th class="rep-routine-list-name">'.$name_text.'</th>
            <th class="rep-routine-list-date">'.$date_text.'</th>
            <th class="rep-routine-list-download">'.$dl_text.'</th>   
        </tr>';   
    
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $upload_routine = get_post_meta($idd, 'file', true);
        $list .= '
        <tr>
            <td class="rep-routine-list-name">'.get_the_title().'</td>
            <td class="rep-routine-list-date">'.get_the_date('l, F j, Y', $idd).'</td>
            <td class="rep-routine-list-download"><a class="rep-routine-dl-btn" href="'.$upload_routine.'">'.$dl_text.'</a></td>   
        </tr>        
        ';
    endwhile;
    $list.= '</table></div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_routines', 'rep_routines_shortcode');

function rep_individual_results_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '',
    ), $atts) );
    
    $title_text = __( 'Title', 'rrf-education-theme' );
    $publish_date_text = __( 'Publish date', 'rrf-education-theme' );
    $dl_text = __( 'Download', 'rrf-education-theme' );
    $name_text = __( 'Name', 'rrf-education-theme' );
    $division_text = __( 'Division', 'rrf-education-theme' );
    $roll_text = __( 'Roll', 'rrf-education-theme' );
    $detail_text = __( 'Read more', 'rrf-education-theme' );
     
    $q = new WP_Query(
        array('posts_per_page' => -1, 'post_type' => 'rrf-edu-result')
        );      
         
    $list = '<div class="remodal-list">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $result_type = get_post_meta($idd, 'type', true);
        $total_get_no_text = get_post_meta($idd, 'student_no_text', true);
        $total_no_text = get_post_meta($idd, 'total_no_text', true);
        $student_results = get_post_meta($idd, 'individual_results', true);
        $total_no = get_post_meta($idd, 'total_no', true);   
        
    
        if($result_type == 'individual') {
        $list .= '
        <div id="result-'.$idd.'" class="remodal" data-remodal-id="result-'.$idd.'" role="dialog" aria-labelledby="result-'.$idd.'Title" aria-describedby="result-'.$idd.'Desc">
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div>
                <h2 id="result-'.$idd.'Title">'.get_the_title().'</h2>
                <div class="rep-result-content"><div class="rep-shortcode-wrapper">';
    
            $list .= '<table class="rep-boxed-table rep-result-list">
                <tr>
                    <th class="rep-resultindv-list-name">'.$name_text.'</th>
                    <th class="rep-resultindv-list-division">'.$division_text.'</th>
                    <th class="rep-resultindv-list-roll">'.$roll_text.'</th>   
                    <th class="rep-resultindv-list-getno">'.$total_get_no_text.'</th>   
                    <th class="rep-resultindv-list-totalno">'.$total_no_text.'</th>   
                </tr>';
        if($student_results) {
            foreach($student_results as $student_result) {
                $list .='
                <tr>
                    <td class="rep-resultindv-list-name">'.$student_result['name'].'</td>
                    <td class="rep-resultindv-list-division">'.$student_result['division'].'</td>
                    <td class="rep-resultindv-list-roll">'.$student_result['roll'].'</td>   
                    <td class="rep-resultindv-list-getno">'.$student_result['number'].'</td>   
                    <td class="rep-resultindv-list-totalno">'.$total_no.'</td>   
                </tr>                
                ';
            }
        }    
    
        $list .='</table>
                </div>
                </div>
            </div>
        </div> 
        '; 
        }
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_individual_results_list', 'rep_individual_results_list_shortcode'); 



function rep_results_shortcode($atts){
    extract( shortcode_atts( array(
        'id' => '',
    ), $atts) );
    
    $title_text = __( 'Title', 'rrf-education-theme' );
    $publish_date_text = __( 'Publish date', 'rrf-education-theme' );
    $dl_text = __( 'Download', 'rrf-education-theme' );
    $name_text = __( 'Name', 'rrf-education-theme' );
    $division_text = __( 'Division', 'rrf-education-theme' );
    $roll_text = __( 'Roll', 'rrf-education-theme' );
    $detail_text = __( 'Read more', 'rrf-education-theme' );
    
    if($id) {
        $q = new WP_Query( array('posts_per_page' => 1, 'post_type' => 'rrf-edu-result', 'p' => $id) );
    } else {
        $q = new WP_Query( array('posts_per_page' => -1, 'post_type' => 'rrf-edu-result', 'orderby' => 'menu_order','order' => 'ASC') );
        
        $list = '
        '.do_shortcode('[rep_individual_results_list]').'
        <div class="rep-shortcode-wrapper">
        <table class="rep-boxed-table result-list">
            <tr>
                <th class="rep-result-list-name">'.$title_text.'</th>
                <th class="rep-result-list-date">'.$publish_date_text.'</th>
                <th class="rep-result-list-download">'.$dl_text.'</th>   
            </tr>';          
    }
    
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $result_type = get_post_meta($idd, 'type', true);
        $upload_result = get_post_meta($idd, 'file', true);
        $total_get_no_text = get_post_meta($idd, 'student_no_text', true);
        $total_no_text = get_post_meta($idd, 'total_no_text', true);
        $student_results = get_post_meta($idd, 'individual_results', true);
        $total_no = get_post_meta($idd, 'total_no', true);    
    
    if($id) {
        


            $list = '<div class="rep-shortcode-wrapper"><table class="rep-boxed-table rep-result-list">
                <tr>
                    <th class="rep-resultindv-list-name">'.$name_text.'</th>
                    <th class="rep-resultindv-list-division">'.$division_text.'</th>
                    <th class="rep-resultindv-list-roll">'.$roll_text.'</th>   
                    <th class="rep-resultindv-list-getno">'.$total_get_no_text.'</th>   
                    <th class="rep-resultindv-list-totalno">'.$total_no_text.'</th>   
                </tr>';
        if($student_results) {
            foreach($student_results as $student_result) {
                $list .='
                <tr>
                    <td class="rep-resultindv-list-name">'.$student_result['name'].'</td>
                    <td class="rep-resultindv-list-division">'.$student_result['division'].'</td>
                    <td class="rep-resultindv-list-roll">'.$student_result['roll'].'</td>   
                    <td class="rep-resultindv-list-getno">'.$student_result['number'].'</td>   
                    <td class="rep-resultindv-list-totalno">'.$total_no.'</td>   
                </tr>                
                ';
            }
        }
        
       

    } else {


            $list .= '
            <tr>
                <td class="rep-result-list-name">'.get_the_title().'</td>
                <td class="rrep-esult-list-date">'.get_the_date('l, F j, Y', $idd).'</td>';
            if($result_type == 'file') {
                $list .='<td class="rep-result-list-download"><a class="rep-routine-dl-btn" href="'.$upload_result.'">'.$dl_text.'</a></td>';
            } else {
                $list .='<td class="rep-result-list-download"><a class="rep-individual-modal-btn" href="#result-'.$idd.'">'.$detail_text.'</a></td>';
            }
            $list .='</tr>';      
    }
    endwhile; 
    
    $list.= '</table></div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_results', 'rep_results_shortcode');



function rep_committee_shortcode($atts){
	extract( shortcode_atts( array(
		'type' => 'current',
	), $atts) );
    
    global $paged;
    $posts_per_page = 20;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-committee', 
        'orderby' => 'menu_order', 
        'order' => 'ASC', 
        'paged' => $paged
    );
    
    $nextpage_text = __( 'Next page', 'rrf-education-theme' );
    $photo_text = __( 'Photo', 'rrf-education-theme' );
    $name_text = __( 'Member name', 'rrf-education-theme' );
    $desi_text = __( 'Designation', 'rrf-education-theme' );
    $start_text = __( 'Start date', 'rrf-education-theme' );
    $end_text = __( 'End date', 'rrf-education-theme' );
	
    $post_query = new WP_Query( $settings );	
    
    $total_found_posts = $post_query->found_posts;
    $total_page = ceil($total_found_posts / $posts_per_page);
    $loading_text = __( 'Loading ...', 'rrf-education-theme' );
		
    if($total_found_posts > $posts_per_page) {
        $next_page_class = 'rep-next-page-activate';
    } else {
        $next_page_class = '';
    }
		
	$list = '
    <div class="rep-shortcode-wrapper '.$next_page_class.'">
    <script>
        jQuery(document).ready(function($){
            $(".rep-committee-list").infinitescroll({
                navSelector  	: ".rep-next-page",
                nextSelector 	: ".rep-next-page a",
                itemSelector 	: ".rep-committee-list tr",
                loading: {
                    msgText: "'.$loading_text.'",
                    img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                },
                maxPage         : '.$total_page.',                
            },function( newElems ) {
                $(".rep-next-page").show();
            });
            
            $(window).unbind(\'.infscr\');

            $(".rep-next-page").click(function(){
                $(".rep-committee-list").infinitescroll(\'retrieve\');
                return false;
            });            
        });
    </script>
    
    <table class="rep-boxed-table">
        <tr>
            <th class="rep-committee-list-photo">'.$photo_text.'</th>
            <th class="rep-committee-list-name">'.$name_text.'</th>
            <th class="rep-committee-list-designation">'.$desi_text.'</th>
            <th class="rep-committee-list-startdate">'.$start_text.'</th>        
            <th class="rep-committee-list-enddate">'.$end_text.'</th>        
        </tr>  
    </table>    
    
    <table class="rep-boxed-table rep-committee-list">';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $committee_designation = get_post_meta($idd, 'designation', true);
        $committee_startdate = get_post_meta($idd, 'start', true);
        $committee_enddate = get_post_meta($idd, 'end', true);
		$list .= '
        <tr>
            <td class="rep-committee-list-photo">'.get_the_post_thumbnail($idd, 'thumbnail').'</td>
            <td class="rep-committee-list-name">'.get_the_title().'</td>
            <td class="rep-committee-list-designation">'.$committee_designation.'</td>
            <td class="rep-committee-list-startdate">'.$committee_startdate.'</td>
            <td class="rep-committee-list-enddate">'.$committee_enddate.'</td>
        </tr>
		';        
	endwhile;
	$list.= '</table>';
    
    if($total_found_posts > $posts_per_page) {
        $list.='<div class="rep-next-page">'.get_next_posts_link($nextpage_text, $total_page).'</div>';
    }
    
	$list.= '</div>';
	
	return $list;
}
add_shortcode('rep_committee', 'rep_committee_shortcode');	




function rep_photogallery_shortcode($atts){
	extract( shortcode_atts( array(
		'column' => '2',
	), $atts) );
    
    if($column == '1'){
        $column_width = 'rep-one-column';
    } elseif($column == '2') {
        $column_width = 'rep-two-columns';
    } elseif($column == '3') {
        $column_width = 'rep-three-columns';
    } elseif($column == '4') {
        $column_width = 'rep-four-columns';
    }    
    
    global $paged;
    $posts_per_page = -1;
    $settings = array(
        'showposts' => $posts_per_page, 
        'post_type' => 'rrf-edu-photogallery', 
        'paged' => $paged
    );
	
    $post_query = new WP_Query( $settings );	
    
    
    $date_text = __( 'Added on:', 'rrf-education-theme' );
		
	$list = '<div class="rep-photogallery-list">
    <script>
        jQuery(document).ready(function($){
            $(".rep-single-gallery-inner").each(function() {
                $(this).magnificPopup({
                    delegate: "a", 
                    type: "image",
                    gallery: {
                      enabled:true
                    }
                });
            });         
        });
    </script>    
    ';
	while($post_query->have_posts()) : $post_query->the_post();
        $idd = get_the_ID();
        $gallery = get_post_meta($idd, 'photos', true);
        $gallery_item_no = 0;
    
        $list .='<div class="rep-single-photo-gallery '.$column_width.'"><div class="rep-single-gallery-inner">';
    
        if( ! empty( $gallery ) ) {


            foreach ((array) $gallery as $gallery_id => $attachment_url )  {
                $attachment = wp_get_attachment_image_src( $gallery_id, 'large' );
                $attachment_thumb = wp_get_attachment_image_src( $gallery_id, 'medium' );
                $image_meta = wp_prepare_attachment_for_js( $gallery_id );
                $gallery_item_no++;
                
                if($gallery_item_no == '1'){
                    $list .='<a href="'.$attachment[0].'" title="'.$image_meta['title'].'">
                        <img src="'.$attachment_thumb[0].'" alt="'.$image_meta['title'].'"/>
                    </a>';
                } else {
                    $list .='<a style="display:none" href="'.$attachment[0].'" title="'.$image_meta['title'].'">
                        <img src="'.$attachment_thumb[0].'" alt="'.$image_meta['title'].'"/>
                    </a>';    
                }
                
            }

        }
    
        $list .='
            <div class="rep-gallery-desc-inner">
                <h3>'.get_the_title().'</h3>
                <p>'.$date_text.' '.get_the_date('F j, Y', $idd).'</p>
            </div>        
        ';
    
        $list .='</div></div>';
	endwhile;
	$list.= '</div>';
    
	
	return $list;
}
add_shortcode('rep_photogallery', 'rep_photogallery_shortcode');	




function rep_attendance_shortcode($atts){
    extract( shortcode_atts( array(
        'id' => '',
    ), $atts) );
     
    $q = new WP_Query(
        array('posts_per_page' => 1, 'post_type' => 'rrf-edu-attendance', 'p' => $id)
        );      
         
    $list = '<div class="attendance-single-item">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $total_student = get_post_meta($idd, 'total_students', true);
        $present_student = get_post_meta($idd, 'today_students_present', true);
        $absent_student = get_post_meta($idd, 'today_students_absent', true);
        $total_teacher = get_post_meta($idd, 'total_teachers', true);
        $present_teacher = get_post_meta($idd, 'today_teachers_present', true);
        $absent_teacher = get_post_meta($idd, 'today_teachers_absent', true);
        $total_employee = get_post_meta($idd, 'total_employies', true);
        $present_employee = get_post_meta($idd, 'today_employies_present', true);
        $absent_employee = get_post_meta($idd, 'today_employies_absent', true);
    
        $student_text = __( 'Student', 'rrf-education-theme' );
        $teacher_text = __( 'Teacher', 'rrf-education-theme' );
        $employee_text = __( 'Employee', 'rrf-education-theme' );
        $total_student_text = __( 'Total students', 'rrf-education-theme' );
        $present_student_text = __( 'Present students', 'rrf-education-theme' );
        $absent_student_text = __( 'Adsent students', 'rrf-education-theme' );
        $total_teacher_text = __( 'Total teachers', 'rrf-education-theme' );
        $present_teacher_text = __( 'Present teachers', 'rrf-education-theme' );
        $absent_teacher_text = __( 'In leave teachers', 'rrf-education-theme' );
        $total_employee_text = __( 'Total employies', 'rrf-education-theme' );
        $present_employee_text = __( 'Present employies', 'rrf-education-theme' );
        $absent_employee_text = __( 'Absent employies', 'rrf-education-theme' );
    
        $list .= '
        <div class="rep-attendance-column">
            <div class="rep-single-attendance-column">
                <h3>'.$student_text.'</h3>
                <p><span>'.$total_student_text.':</span> '.$total_student.'</p>
                <p><span>'.$present_student_text.':</span> '.$present_student.'</p>
                <p><span>'.$absent_student_text.':</span> '.$absent_student.'</p>
            </div>
            <div class="rep-single-attendance-column">
                <h3>'.$teacher_text.'</h3>
                <p><span>'.$total_teacher_text.':</span> '.$total_teacher.'</p>
                <p><span>'.$present_teacher_text.':</span> '.$present_teacher.'</p>
                <p><span>'.$absent_teacher_text.':</span> '.$absent_teacher.'</p>
            </div>
            <div class="rep-single-attendance-column">
                <h3>'.$employee_text.'</h3>
                <p><span>'.$total_employee_text.':</span> '.$total_employee.'</p>
                <p><span>'.$present_employee_text.':</span> '.$present_employee.'</p>
                <p><span>'.$absent_employee_text.':</span> '.$absent_employee.'</p>
            </div>
        </div>
        ';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_attendance', 'rep_attendance_shortcode');  


function rep_calendar_shortcode($atts){
    extract( shortcode_atts( array(
        'id' => 'academic',
    ), $atts) );
     
    $q = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type' => array('post', 'rrf-edu-notice', 'rrf-edu-routine', 'rrf-edu-result', 'rrf-edu-attendance'),
        ));      
    
    $month_1 = __( 'January', 'rrf-education-theme' );
    $month_2 = __( 'February', 'rrf-education-theme' );
    $month_3 = __( 'March', 'rrf-education-theme' );
    $month_4 = __( 'April', 'rrf-education-theme' );
    $month_5 = __( 'May', 'rrf-education-theme' );
    $month_6 = __( 'June', 'rrf-education-theme' );
    $month_7 = __( 'July', 'rrf-education-theme' );
    $month_8 = __( 'August', 'rrf-education-theme' );
    $month_9 = __( 'September', 'rrf-education-theme' );
    $month_10 = __( 'October', 'rrf-education-theme' );
    $month_11 = __( 'November', 'rrf-education-theme' );
    $month_12 = __( 'December', 'rrf-education-theme' );
    $day_short_1 = __( 'Sun', 'rrf-education-theme' );
    $day_short_2 = __( 'Mon', 'rrf-education-theme' );
    $day_short_3 = __( 'Tue', 'rrf-education-theme' );
    $day_short_4 = __( 'Wed', 'rrf-education-theme' );
    $day_short_5 = __( 'Thu', 'rrf-education-theme' );
    $day_short_6 = __( 'Fri', 'rrf-education-theme' );
    $day_short_7 = __( 'Sat', 'rrf-education-theme' );
    $day_full_1 = __( 'Sunday', 'rrf-education-theme' );
    $day_full_2 = __( 'Monday', 'rrf-education-theme' );
    $day_full_3 = __( 'Tuesday', 'rrf-education-theme' );
    $day_full_4 = __( 'Wednesday', 'rrf-education-theme' );
    $day_full_5 = __( 'Thursday', 'rrf-education-theme' );
    $day_full_6 = __( 'Friday', 'rrf-education-theme' );
    $day_full_7 = __( 'Saterday', 'rrf-education-theme' );
    $legend_1_text = __( 'Updates', 'rrf-education-theme' );
    $legend_2_text = __( 'Notice', 'rrf-education-theme' );
    $legend_3_text = __( 'Routine', 'rrf-education-theme' );
    $legend_4_text = __( 'Result', 'rrf-education-theme' );
    $legend_5_text = __( 'Attendance', 'rrf-education-theme' );
    
    $list = '
    <script>
        jQuery(document).ready(function($){
            $("#rep-calendar-'.$id.' a.fc-event").remodal();
            $("#rep-calendar-'.$id.'").fullCalendar({
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "month,basicWeek,basicDay"
                },
                monthNames: [\''.$month_1.'\', \''.$month_2.'\', \''.$month_3.'\', \''.$month_4.'\', \''.$month_5.'\', \''.$month_6.'\', \''.$month_7.'\', \''.$month_8.'\', \''.$month_9.'\', \''.$month_10.'\', \''.$month_11.'\', \''.$month_12.'\'],
                dayNamesShort : [\''.$day_short_1.'\', \''.$day_short_2.'\', \''.$day_short_3.'\', \''.$day_short_4.'\', \''.$day_short_5.'\', \''.$day_short_6.'\', \''.$day_short_7.'\'],
                dayNames : [\''.$day_full_1.'\', \''.$day_full_2.'\', \''.$day_full_3.'\', \''.$day_full_4.'\', \''.$day_full_5.'\', \''.$day_full_6.'\', \''.$day_full_7.'\'],
                defaultDate: "'.date('Y-m-d').'",
                editable: true,
                eventLimit: true,
                events: [';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $result_type = get_post_meta($idd, 'type', true);
        $upload_result = $upload_routine = get_post_meta($idd, 'file', true);
        if($result_type == 'file') {
            $event_link = $upload_result;
        } elseif($upload_routine) {
            $event_link = $upload_routine;
        } else {
            $event_link = '#rep-event-detail-'.$idd.''; 
        }
    
        if(get_post_type() == 'post') {
            $class_name = 'theme-1';
        } elseif(get_post_type() == 'rrf-edu-notice') {
            $class_name = 'theme-2';
        } elseif(get_post_type() == 'rrf-edu-routine') {
            $class_name = 'theme-3';
        } elseif(get_post_type() == 'rrf-edu-result') {
            $class_name = 'theme-4';
        } elseif(get_post_type() == 'rrf-edu-attendance') {
            $class_name = 'theme-5';
        } else {
            $class_name = 'default-color';
            
        }
    
        if(get_post_type() == 'attendance') {
            $event_title = __( 'Attendance info', 'rrf-education-theme' );
        } else {
            $event_title = get_the_title();
        }
    
        $post_content = get_the_content();
        $list .= '
                    {
                        title: "'.$event_title.'",
                        start: "'.get_the_date('Y-m-d', $idd).'",
                        url: "'.$event_link.'",
                        className: "'.$class_name.'"
                    },
        ';        
    endwhile;
    $list.= ']
            });
        });
    </script>
    <ul class="rep-calendar-legends">
        <li class="rep-legend-color-1">'.$legend_1_text.'</li>
        <li class="rep-legend-color-2">'.$legend_2_text.'</li>
        <li class="rep-legend-color-3">'.$legend_3_text.'</li>
        <li class="rep-legend-color-4">'.$legend_4_text.'</li>
        <li class="rep-legend-color-5">'.$legend_5_text.'</li>
    </ul>
    <div class="rep-calendar" id="rep-calendar-'.$id.'"></div> '.do_shortcode('[rep_all_event_modal]').'';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_calendar', 'rep_calendar_shortcode');  


function rep_all_event_modal_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '',
    ), $atts) );
     
    $q = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type' => array('post', 'rrf-edu-notice', 'rrf-edu-routine', 'rrf-edu-result', 'rrf-edu-attendance'),
        ));      
    $publish_date_text = __( 'Publish date', 'rrf-education-theme' );    
    $attendance_text = __( 'Attendandce info', 'rrf-education-theme' );    
    $attendance_date_text = __( 'Attendance date', 'rrf-education-theme' );    
    $list = '<div class="rep-all-event-modal-list">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $result_type = get_post_meta($idd, 'type', true);
        $post_content = get_the_content();
        $list .= '
            <div class="remodal" data-remodal-id="rep-event-detail-'.$idd.'" role="dialog" aria-labelledby="modal-'.$idd.'-Title" aria-describedby="modal-'.$idd.'-Desc">';
        
        if(get_post_type() == 'attendance') {
        $list .='<h2 id="modal-'.$idd.'-Title">'.$attendance_text.'</h2>
                <p class="publish-date">'.$attendance_date_text.': '.get_the_date('l, F j, Y', $idd).'</p>';
        } else {
        $list .='<h2 id="modal-'.$idd.'-Title">' .do_shortcode( get_the_title() ). '</h2>
                <p class="publish-date">'.$publish_date_text.': '.get_the_date('l, F j, Y', $idd).'</p>';
        }
        $list .='<div class="remodal-content">'.wpautop( $post_content ).'</div>';
        
        if(get_post_type() == 'rrf-edu-result' && $result_type == 'individual') {
            $list .=''.do_shortcode('[rep_results id="'.$idd.'"]').'';
        } elseif(get_post_type() == 'rrf-edu-attendance') {
            $list .=''.do_shortcode('[rep_attendance id="'.$idd.'"]').'';
        }
    
        $list .='</div>';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('rep_all_event_modal', 'rep_all_event_modal_shortcode');  