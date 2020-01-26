$(document).ready(function(){
////////////change pw FORM START

//global vars

	var changepw_frm = $("#changepw_frm");
	var new_passwd = $("#new_passwd");
	var new_passwdInfo = $("#new_passwdInfo");
	var cnew_passwd = $("#cnew_passwd");
	var cnew_passwdInfo = $("#cnew_passwdInfo");

	//On blur
	new_passwd.blur(validate_new_passwd);
	cnew_passwd.blur(validate_cnew_passwd);

	//On key press
	new_passwd.keyup(validate_new_passwd);
	cnew_passwd.keyup(validate_cnew_passwd);

	//On Submitting
	changepw_frm.submit(function(){
		if(validate_new_passwd() & validate_cnew_passwd())
			return true
		else
			return false;
	});

////////////change pw FORM END
////////////////////////////////////

	function validate_new_passwd()
	{
		if($("#new_passwd").val() == '')
		{
			new_passwd.addClass("error");
			new_passwdInfo.text("Please enter password");
			new_passwdInfo.addClass("message_error2");
			return false;
		}else
		{
		if($("#new_passwd").val())
		{
			var passwd = $("#new_passwd").val();
			if(passwd.length<5)
			{
				new_passwd.addClass("error");
				new_passwdInfo.text("Password should be minimum of 5 characters");
				new_passwdInfo.addClass("message_error2");
				return false;
			}else
			{
				new_passwd.removeClass("error");
				new_passwdInfo.text("");
				new_passwdInfo.removeClass("message_error2");
				return true;
			}
		}
		else{
			new_passwd.removeClass("error");
			new_passwdInfo.text("");
			new_passwdInfo.removeClass("message_error2");
			return true;
		}
		}
	}
	function validate_cnew_passwd()
	{
		if($("#cnew_passwd").val() == '')
		{
			cnew_passwd.addClass("error");
			cnew_passwdInfo.text("Please enter confirm password");
			cnew_passwdInfo.addClass("message_error2");
			return false;
		}else
		if($("#cnew_passwd").val())
		{
			var passwd = $("#cnew_passwd").val();
			if(passwd.length<5)
			{
				cnew_passwd.addClass("error");
				cnew_passwdInfo.text("Confirm password should be minimum of 5 characters");
				cnew_passwdInfo.addClass("message_error2");
				return false;
			}
		}
		if($("#cnew_passwd").val() != $("#new_passwd").val())
		{
			cnew_passwd.addClass("error");
			cnew_passwdInfo.text("Both passwords should be same");
			cnew_passwdInfo.addClass("message_error2");
			return false;
		}
		else{
			cnew_passwd.removeClass("error");
			cnew_passwdInfo.text("");
			cnew_passwdInfo.removeClass("message_error2");
			return true;
		}
	}

});