<?php 

add_action( 'admin_head', 'rrf_edu_plugin_page_condtion' );
function rrf_edu_plugin_page_condtion() {

	
	global $post_type;

    
	if( 'page' != $post_type )
		return;

    
	?>
   
   
	<script>
        jQuery(document).ready(function($){

<?php 

$select_shortcode_logic = '
    if($(this).val() == \'teachers\') {
        $(".cmb2-id-teachers-type").addClass("show-cmb2-id-teachers-type");
        
        $(".cmb2-id-students-type").removeClass("show-cmb2-id-students-type");
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
        $(".cmb2-id-routines-type").removeClass("show-cmb2-id-routines-type");
        $(".cmb2-id-result-type").removeClass("show-cmb2-id-result-type");
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
        
    } else if($(this).val() == \'students\') {
        $(".cmb2-id-students-type").addClass("show-cmb2-id-students-type");
        
        $(".cmb2-id-teachers-type").removeClass("show-cmb2-id-teachers-type");
        $(".cmb2-id-routines-type").removeClass("show-cmb2-id-routines-type");
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
        $(".cmb2-id-result-type").removeClass("show-cmb2-id-result-type");
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
        
    } else if($(this).val() == \'routines\') {
        $(".cmb2-id-routines-type").addClass("show-cmb2-id-routines-type");
        
        $(".cmb2-id-teachers-type").removeClass("show-cmb2-id-teachers-type");
        $(".cmb2-id-students-type").removeClass("show-cmb2-id-students-type");
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
        $(".cmb2-id-result-type").removeClass("show-cmb2-id-result-type");
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
        
    } else if($(this).val() == \'results\') {
        $(".cmb2-id-result-type").addClass("show-cmb2-id-result-type");
        
        $(".cmb2-id-routines-type").removeClass("show-cmb2-id-routines-type");
        $(".cmb2-id-teachers-type").removeClass("show-cmb2-id-teachers-type");
        $(".cmb2-id-students-type").removeClass("show-cmb2-id-students-type");
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
        
        
    } else {
        $(".cmb2-id-teachers-type").removeClass("show-cmb2-id-teachers-type");
        $(".cmb2-id-students-type").removeClass("show-cmb2-id-students-type");
        $(".cmb2-id-routines-type").removeClass("show-cmb2-id-routines-type");
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
        $(".cmb2-id-result-type").removeClass("show-cmb2-id-result-type");
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
    }  
'; 

$select_student_type_logic = '
    if($(this).val() == \'specific\') {
        $(".cmb2-id-select-students").addClass("show-cmb2-id-select-students");
        
    } else {
        $(".cmb2-id-select-students").removeClass("show-cmb2-id-select-students");
    }  
';

$select_result_logic = '
    if($(this).val() == \'individual\') {
        $(".cmb2-id-select-result").addClass("show-cmb2-id-select-result");
        
    } else {
        $(".cmb2-id-select-result").removeClass("show-cmb2-id-select-result");
    }  
'; 
    
    
    
?>
            
$('.cmb2-id-rep-shortcode-type select option[selected=selected]').each(function(){
    <?php echo $select_shortcode_logic; ?>
});   
            
$(".cmb2-id-rep-shortcode-type select").change(function(){
    <?php echo $select_shortcode_logic; ?>
}); 
            
$('.cmb2-id-students-type select option[selected=selected]').each(function(){
    <?php echo $select_student_type_logic; ?>
});   
            
$(".cmb2-id-students-type select").change(function(){
    <?php echo $select_student_type_logic; ?>
}); 
            
$('.cmb2-id-result-type select option[selected=selected]').each(function(){
    <?php echo $select_result_logic; ?>
});   
            
$(".cmb2-id-result-type select").change(function(){
    <?php echo $select_result_logic; ?>
}); 


            
        });
    </script>   
   
    
    <style>
        .cmb2-id-teachers-type,
        .cmb2-id-students-type,
        .cmb2-id-routines-type,
        .cmb2-id-select-students,
        .cmb2-id-result-type,
        .cmb2-id-select-result
        {display:none}
        .cmb2-id-teachers-type.show-cmb2-id-teachers-type,
        .cmb2-id-students-type.show-cmb2-id-students-type,
        .cmb2-id-routines-type.show-cmb2-id-routines-type,
        .cmb2-id-select-students.show-cmb2-id-select-students,
        .cmb2-id-result-type.show-cmb2-id-result-type,
        .cmb2-id-select-result.show-cmb2-id-select-result
        {display:block}
    </style>
	<?php
}

add_action( 'admin_head', 'rrf_edu_plugin_teacher_condtion' );
function rrf_edu_plugin_teacher_condtion() {

	
	global $post_type;

    
	if( 'rrf-edu-teacher' != $post_type )
		return;

    
	?>
   
   
	<script>
        jQuery(document).ready(function($){

<?php 

$teacher_type_logic = '
    if($(this).val() == \'archived\') {
        $(".cmb2-id-end-date").addClass("show-cmb2-id-end-date");
    } else {
        $(".cmb2-id-end-date").removeClass("show-cmb2-id-end-date");
    }  
'; 
    
    
    
?>
            
$('.cmb2-id-type select option[selected=selected]').each(function(){
    <?php echo $teacher_type_logic; ?>
});   
            
$(".cmb2-id-type select").change(function(){
    <?php echo $teacher_type_logic; ?>
}); 


            
        });
    </script>   
   
    
    <style>
        .cmb2-id-end-date {display:none}
        .cmb2-id-end-date.show-cmb2-id-end-date {display:block}
    </style>
	<?php
}

add_action( 'admin_head', 'rrf_edu_plugin_result_condtion' );
function rrf_edu_plugin_result_condtion() {

	
	global $post_type;

    
	if( 'rrf-edu-result' != $post_type )
		return;

    
	?>
   
   
	<script>
        jQuery(document).ready(function($){

<?php 

$teacher_type_logic = '
    if($(this).val() == \'individual\') {
        $(".cmb2-id-total-no-text").addClass("show-cmb2-id-total-no-text");
        $(".cmb2-id-student-no-text").addClass("show-cmb2-id-student-no-text");
        $(".cmb2-id-total-no").addClass("show-cmb2-id-total-no");
        $(".cmb-repeat-group-wrap").addClass("show-cmb-repeat-group-wrap");
        $(".cmb2-id-file").addClass("hide-cmb2-id-file");
    } else {
        $(".cmb2-id-total-no-text").removeClass("show-cmb2-id-total-no-text");
        $(".cmb2-id-student-no-text").removeClass("show-cmb2-id-student-no-text");
        $(".cmb2-id-total-no").removeClass("show-cmb2-id-total-no");
        $(".cmb-repeat-group-wrap").removeClass("show-cmb-repeat-group-wrap");
        
        $(".cmb2-id-file").removeClass("hide-cmb2-id-file");
    }  
'; 
    
    
    
?>
            
$('.cmb2-id-type select option[selected=selected]').each(function(){
    <?php echo $teacher_type_logic; ?>
});   
            
$(".cmb2-id-type select").change(function(){
    <?php echo $teacher_type_logic; ?>
}); 


            
        });
    </script>   
   
    
    <style>
        .cmb2-id-total-no-text {display:none}
        .cmb2-id-total-no-text.show-cmb2-id-total-no-text {display:block}
        .cmb2-id-student-no-text {display:none}
        .cmb2-id-student-no-text.show-cmb2-id-student-no-text {display:block}
        .cmb2-id-total-no {display:none}
        .cmb2-id-total-no.show-cmb2-id-total-no {display:block}
        .cmb-repeat-group-wrap {display:none}
        .cmb-repeat-group-wrap.show-cmb-repeat-group-wrap {display:block}
        .cmb2-id-file {display:block}
        .cmb2-id-file.show-cmb2-id-file {display:block}
        .cmb2-id-file.hide-cmb2-id-file {display:none}
    </style>
	<?php
}