<script type='text/javascript' src='<?php bloginfo( 'template_directory' ); ?>/library/js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php bloginfo( 'template_directory' ); ?>/library/js/basic.js'></script>
<div id="basic-modal-content" class="clearfix">
<form name="send_to_frnd" id="send_to_frnd" action="<?php echo get_option( 'siteurl' ) . '/?page=email_frnd';?>" method="post" target="submit_information"  >
<input type="hidden" name="pid" value="<?php echo $post->ID;?>" />
	<h3><?php _e( SEND_TO_FRND_TEXT );?></h3>
	<p id="reply_send_success" class="sucess_msg" style="display:none;"></p>
	<div class="row clearfix" ><label><?php _e( FRND_NAME_TEXT );?> : <span>*</span></label><input name="to_name" id="to_name" type="text"  /><span id="to_nameInfo"></span></div>
	 <div class="row  clearfix" ><label> <?php _e( FRND_EMAIL_TEXT );?> : <span>*</span></label><input name="to_email" id="to_email" type="text"  /><span id="to_emailInfo"></span></div>
	<div class="row  clearfix" ><label><?php _e( YOUR_NAME_TEXT );?> : <span>*</span></label><input name="yourname" id="yourname" type="text"  /><span id="yournameInfo"></span></div>
	 <div class="row  clearfix" ><label> <?php _e( YOUR_EMAIL_TEXT );?> : <span>*</span></label><input name="youremail" id="youremail" type="text"  /><span id="youremailInfo"></span></div>
	<div class="row  clearfix" ><label><?php _e( SUBJECT_TEXT );?> : <span>*</span></label><input name="frnd_subject" value="<?php //echo $post->post_title;?>" id="frnd_subject" type="text"  /></div>
	<div class="row  clearfix" ><label><?php _e( COMMENTS_TEXT );?> : <span>*</span></label>
	 <textarea name="frnd_comments" id="frnd_comments" cols="" row  clearfixs=""><?php _e( EMAIL_FRND_CONTENT_DEFAULT );?></textarea></div>
	<input name="Send" type="submit" value="Send " class="button " />
</form>
</div>

<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/email_frnd_validation.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/library/js/inquiry_validation.js"></script>
			
<div id="basic-modal-content2" class="clearfix">
 <form method="post" name="agt_mail_agent" id="agt_mail_agent" action="<?php echo get_option( 'siteurl' ) . '/?page=send_inqury';?>" target="submit_information" >
  <input type="hidden" name="pid" id="agt_mail_agent_pid" value="<?php echo $post->ID;?>" />
  <input type="hidden" name="aid" id="agt_mail_agent_aid" value="<?php echo $post->post_author;?>" />  
	<h3><?php _e( POP_TITLE_TEXT );?> </h3>
	<p id="inquiry_send_success" class="sucess_msg" style="display:none;"></p>
	<div class="row  clearfix" ><label><?php _e( AGT_NAME_TEXT );?> :  <span>*</span></label><input name="inq_name" id="agt_mail_name" type="text"  /><span id="span_agt_mail_name"></span></div>
	 <div class="row  clearfix" ><label><?php _e( AGT_EMAIL_TEXT );?> :  <span>*</span></label><input name="inq_email" id="agt_mail_email" type="text"  /><span id="span_agt_mail_email"></span></div>
	<div class="row  clearfix" ><label><?php _e( AGT_PHONE_TEXT );?> :</label><input name="inq_phone" id="agt_mail_phone" type="text"  /></div>
	<div class="row  clearfix" ><label><?php _e( AGT_MESSAGE_TEXT );?> :  <span>*</span></label>
	 <textarea name="inq_msg" id="agt_mail_msg" cols="" row  clearfixs=""><?php _e( AGENT_CONTENT_DEFAULT );?></textarea>
	 <span id="span_agt_mail_msg"></span>
	</div>
	<input name="Send" type="submit"  value="<?php _e( AGT_SUBMIT_BTN );?>" class="button clearfix" />
 </form>
</div>
<!-- here -->


<iframe name="submit_information" id="submit_information" width="0" height="0" style="border:0">
