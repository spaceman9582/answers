jQuery(function ($) {
//$(document).ready(function(){
//global vars
	var questionform = $("#questionform");
	var post_title = $("#post_title");
	
	var post_title_span = $("#post_title_span");

//On blur
	post_title.blur(validate_post_title);
	
//On key press
	post_title.keyup(validate_post_title);
	
//On Submitting
	questionform.submit(function(){
		if(validate_post_title())
			return true
		else
			return false;
	});

//validation functions
	function validate_post_title()
	{
		if($("#post_title").val() == '')
		{
			post_title.addClass("error");
			post_title_span.text("Please Enter Question Title");
			post_title_span.addClass("message_error2");
			return false;
		}
		else{
			post_title.removeClass("error");
			post_title_span.text("");
			post_title_span.removeClass("message_error2");
			return true;
		}
	}

	
});

function set_login_registration_frm(val) {
	if(val=='existing_user'){
 		if(typeof document.getElementById('login_user_frm_id') != 'undefined'){document.getElementById('login_user_frm_id').style.display = '';}
		if(typeof document.getElementById('contact_detail_id') != 'undefined'){document.getElementById('contact_detail_id').style.display = 'none';}
		
		document.getElementById('user_log').required = true;
		document.getElementById('user_pass').required = true;
		
	}else {
 		if(typeof document.getElementById('login_user_frm_id') != 'undefined'){document.getElementById('login_user_frm_id').style.display = 'none';}
		if(typeof document.getElementById('contact_detail_id') != 'undefined'){document.getElementById('contact_detail_id').style.display = '';}
		
		document.getElementById('user_log').required = false;
		document.getElementById('user_pass').required = false;
	}
}