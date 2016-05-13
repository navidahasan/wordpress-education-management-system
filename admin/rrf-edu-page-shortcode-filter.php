<?php





add_filter( 'the_content', 'my_the_content_filter', 50 );
/**
 * Add a icon to the beginning of every post page.
 *
 * @uses is_single()
 */
function my_the_content_filter( $content ) {
    
    global $post;

    $content = $content;
    
    if ($post->post_type == 'page') {
        
        $shortcode_type = get_post_meta( $post->ID, "rep_shortcode_type", true );
        $teachers_type = get_post_meta( $post->ID, "teachers_type", true );
        $students_type = get_post_meta( $post->ID, "students_type", true );
        $select_students = get_post_meta( $post->ID, "select_students", true );
        $select_result = get_post_meta( $post->ID, "select_result", true );
        $routines_type = get_post_meta( $post->ID, "routines_type", true );
        $result_type = get_post_meta( $post->ID, "result_type", true );
        
        if($shortcode_type == 'notices') {
            $rep_page_shortcode = do_shortcode('[rep_notices]');
        } elseif($shortcode_type == 'teachers') {
            $rep_page_shortcode = do_shortcode('[rep_teachers type="'.$teachers_type.'"]');
        } elseif($shortcode_type == 'students') {
            if($students_type == 'specific') {
                $rep_page_shortcode = do_shortcode('[rep_students id="'.$select_students.'"]');
            } elseif($students_type == 'pro') {
                $rep_page_shortcode = do_shortcode('[rep_prostudents]');
            } else {
                $rep_page_shortcode = do_shortcode('[rep_students]');
            }
        } elseif($shortcode_type == 'vacencies') {
            $rep_page_shortcode = do_shortcode('[rep_vacencies]');
        } elseif($shortcode_type == 'routines') {
            $rep_page_shortcode = do_shortcode('[rep_routines type="'.$routines_type.'"]');
        } elseif($shortcode_type == 'results') {
            if($result_type == 'individual') {
                $rep_page_shortcode = do_shortcode('[rep_results id="'.$select_result.'"]');
            } else {
                $rep_page_shortcode = do_shortcode('[rep_results]');
            }
            
        } elseif($shortcode_type == 'committies') {
            $rep_page_shortcode = do_shortcode('[rep_committee]');
        } elseif($shortcode_type == 'employies') {
            $rep_page_shortcode = do_shortcode('[rep_employee]');
        } elseif($shortcode_type == 'photogalleries') {
            $rep_page_shortcode = do_shortcode('[rep_photogallery]');
        } elseif($shortcode_type == 'calendar') {
            $rep_page_shortcode = do_shortcode('[rep_calendar]');
        } else {
            $rep_page_shortcode = '';
        }
        
        $content .=''.$rep_page_shortcode.'';
    }

    
    // Returns the content.
    return $content;
}


