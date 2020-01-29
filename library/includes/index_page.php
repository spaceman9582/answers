<?php get_header(); ?>

		<div id="content">
			<?php include( TEMPLATEPATH . '/library/includes/home_tab.php' );?>	
<?php
if ( isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'answers' ) {
	include( TEMPLATEPATH . '/library/includes/index_answers.php' );

}else if(isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'answered'){
    include( TEMPLATEPATH . '/library/includes/index_best_answered.php' );

}else if(isset( $_REQUEST['ptype'] ) && $_REQUEST['ptype'] == 'usersss'){
    include( TEMPLATEPATH . '/library/includes/user1.php' );
}else {
	include( TEMPLATEPATH . '/library/includes/index_questions.php' );
}
?>

		</div> <!-- content #end -->

				<div id="sidebar" class="sidebar_spacer" >
			
						<?php include( TEMPLATEPATH . '/library/includes/ask_question_button.php' );?>

								<?php dynamic_sidebar( 2 );  ?> 

					   </div> <!-- sidebar #end -->
<?php get_footer(); ?>
