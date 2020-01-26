var $answer = jQuery.noConflict();
$answer(document).ready(function(){

////////////LOGIN FORM START

//global vars

	var loginform = $answer("#loginform");

	var user_login = $answer("#user_login");

	var user_loginInfo = $answer("#user_loginInfo");

	var user_pass = $answer("#user_pass");

	var user_passInfo = $answer("#user_passInfo");

	

	//On blur

	user_login.blur(validate_user_login);

	user_pass.blur(validate_user_pass);



	//On key press

	user_login.keyup(validate_user_login);

	user_pass.keyup(validate_user_pass);

	

	//On Submitting

	loginform.submit(function(){

		if(validate_user_login() & validate_user_pass())

			return true

		else

			return false;

	});

////////////LOGIN FORM END



////////////REGISTRATION FORM START

	var registerform = $answer("#registerform");

	var user_login1reg = $answer("#user_login1reg");
	
	var user_login1regInfo = $answer("#user_login1regInfo");

	var user_name = $answer("#user_name");
	
	var user_email = $answer("#user_email");

	var user_emailInfo = $answer("#user_emailInfo");

	var user_fname = $answer("#user_fname");

	var user_fnameInfo = $answer("#user_fnameInfo");

	var user_pwdInfo = $answer("#user_pwdInfo");

	var user_pwd = $answer("#user_pwd");

	
		//On blur

	user_login1reg.blur(validate_user_login1reg);

	user_email.blur(validate_user_email);

	user_fname.blur(validate_user_fname);

	user_pwd.blur(validate_user_pwd);

	//On key press

	user_login1reg.keyup(validate_user_login1reg);

	user_email.keyup(validate_user_email);

	user_fname.keyup(validate_user_fname);
	user_pwd.keyup(validate_user_pwd);
	

	//On Submitting

	registerform.submit(function(){

		if(validate_user_login1reg() & validate_user_email() & validate_user_pwd() & validate_user_fname())

			return true

		else

			return false;

	});


////////////change pw FORM START

//global vars

	var changepw_frm = $answer("#changepw_frm");
	var new_passwd = $answer("#new_passwd");
	var new_passwdInfo = $answer("#new_passwdInfo");
	var cnew_passwd = $answer("#cnew_passwd");
	var cnew_passwdInfo = $answer("#cnew_passwdInfo");

	//On blur
	user_login.blur(validate_new_passwd);
	user_pass.blur(validate_cnew_passwd);

	//On key press
	user_login.keyup(validate_new_passwd);
	user_pass.keyup(validate_new_passwd);

	//On Submitting
	loginform.submit(function(){
		if(validate_new_passwd() & validate_new_passwd())
			return true
		else
			return false;
	});

////////////change pw FORM END

////////////REGISTRATION FORM END

	//validation functions

	function validate_user_login()
	{

		if($answer("#user_login").val() == '')

		{

			user_login.addClass("error");

			user_loginInfo.text("Please Enter Email");

			user_loginInfo.addClass("message_error2");

			return false;

		}

		else{

			user_login.removeClass("error");

			user_loginInfo.text("");

			user_loginInfo.removeClass("message_error2");

			return true;

		}

	}

	function validate_user_pass()
	{

		if($answer("#user_pass").val() == '')

		{

			user_pass.addClass("error");

			user_passInfo.text("Please Enter Password");

			user_passInfo.addClass("message_error2");

			return false;

		}

		else{

			user_pass.removeClass("error");

			user_passInfo.text("");

			user_passInfo.removeClass("message_error2");

			return true;

		}

	}
	
	function validate_user_pwd()
	{
		if($answer("#user_pwd").val() == '')
		{
			user_pwd.addClass("error");
			user_pwdInfo.text("Please Enter Password");
			user_pwdInfo.addClass("message_error2");
			return false;
		}else
		if($answer("#user_pwd").val())
		{
			var passwd = $answer("#user_pwd").val();
			if(passwd.length<5)
			{
				user_pwd.addClass("error");
				user_pwdInfo.text("Password should be minimum of 5 characters long");
				user_pwdInfo.addClass("message_error2");
				return false;
			}else
			{
				user_pwd.removeClass("error");
				user_pwdInfo.text("");
				user_pwdInfo.removeClass("message_error2");
				return true;	
			}
		}
	}

	function validate_user_login1reg(){
		var temp = /\s/; 
		if($answer("#user_login1reg").val() == ''){	
			user_login1reg.addClass("error");
			
			user_login1regInfo.text("Please Enter Username");

			user_login1regInfo.addClass("message_error2");

			return false;

		}
		if(temp.test($answer("#user_login1reg").val()))
		{
			user_login1reg.addClass("error");

			user_login1regInfo.text("User name should not contain space");

			user_login1regInfo.addClass("message_error2");

			return false;
		}
		else{

			user_login1reg.removeClass("error");

			user_login1regInfo.text("");

			user_login1regInfo.removeClass("message_error2");

			return true;

		}

	}

	function validate_user_fname()
	{

		if($answer("#user_fname").val() == '')

		{

			user_fname.addClass("error");

			user_fnameInfo.text("Please Enter Full Name");

			user_fnameInfo.addClass("message_error2");

			return false;

		}

		else{

			user_fname.removeClass("error");

			user_fnameInfo.text("");

			user_fnameInfo.removeClass("message_error2");

			return true;

		}

	}

	function validate_user_email()
	{

		var isvalidemailflag = 0;

		if($answer("#user_email").val() == '')

		{

			isvalidemailflag = 1;

		}else

		if($answer("#user_email").val() != '')

		{

			var a = $answer("#user_email").val();

			var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;

			//if it's valid email

			if(filter.test(a)){

				isvalidemailflag = 0;

			}else{

				isvalidemailflag = 1;	

			}

		}

		if(isvalidemailflag)

		{

			user_email.addClass("error");

			user_emailInfo.text("Please Enter valid E-mail");

			user_emailInfo.addClass("message_error2");

			return false;

		}else

		{

			user_email.removeClass("error");

			user_emailInfo.text("");

			user_emailInfo.removeClass("message_error");

			return true;

		}

		

	}

////////////////////////////////////

	function validate_new_passwd()
	{
		if($answer("#new_passwd").val() == '')
		{
			new_passwd.addClass("error");
			new_passwdInfo.text("Please Enter Password");
			new_passwdInfo.addClass("message_error2");
			return false;
		}else
		if($answer("#new_passwd").val())
		{
			var passwd = $answer("#new_passwd").val();
			if(passwd.length<5)
			{
				new_passwd.addClass("error");
				new_passwdInfo.text("Password should be minimum of 5 characters long");
				new_passwdInfo.addClass("message_error2");
				return false;
			}
		}
		else{
			new_passwd.removeClass("error");
			new_passwdInfo.text("");
			new_passwdInfo.removeClass("message_error2");
			return true;
		}
	}
	function validate_cnew_passwd()
	{
		if($answer("#cnew_passwd").val() == '')
		{
			cnew_passwd.addClass("error");
			cnew_passwdInfo.text("Please Enter Password");
			cnew_passwdInfo.addClass("message_error2");
			return false;
		}else
		if($answer("#cnew_passwd").val())
		{
			var passwd = $answer("#cnew_passwd").val();
			if(passwd.length<5)
			{
				cnew_passwd.addClass("error");
				cnew_passwdInfo.text("Password should be minimum of 5 characters long");
				cnew_passwdInfo.addClass("message_error2");
				return false;
			}
		}
		else{
			cnew_passwd.removeClass("error");
			cnew_passwdInfo.text("");
			cnew_passwdInfo.removeClass("message_error2");
			return true;
		}
	}

});