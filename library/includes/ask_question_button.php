<?php
if ( is_user_add_question() ) {
?>
<a href="<?php echo get_option( 'siteurl' );?>?ptype=ask-a-question" class="b_askquestions" ><?php _e( ASK_A_QUE_TXT );?></a>
<?php
}
?>
