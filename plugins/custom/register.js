function user_func(site_url){
	user = $('#user').val();
	if(user != ''){
		if(user.length >= 5){
			space = /\s/;
			if(!space.test(user)){

				$.ajax({
		          type : "post",
		          url : site_url+'register/check_user',
		          data : "user="+user,
		          cache : false,
		          success:function( out ){

		          	if(out == 0)
		          	{
		          		$('#e_user').fadeOut();
		          		$('#e_user_hid').val(0);
		          	}
		          	else
		          	{
		          		$('#e_user').fadeIn('slow');
		          		$('#e_user_hid').val(1);
						$('#e_user').html('Username Is Already Registered');
		          	}

		          }
        		});

			}
			else
			{
				$('#e_user').fadeIn('slow');
				$('#e_user_hid').val(1);
				$('#e_user').html('Space Not Allowed In Username');
			}
		}
		else
		{
			$('#e_user').fadeIn('slow');
			$('#e_user_hid').val(1);
			$('#e_user').html('Username Must Be 5 Characters');
		}
	}
	else{
		$('#e_user').fadeOut();
		$('#e_user_hid').val(0);
	}
}

function pass_func(){
	pass = $('#pass').val();
	cpass = $('#cpass').val();

	if(pass != '')
	{
		if(pass.length >= 5){
			$('#e_pass').fadeOut();
		}
		else
		{
			$('#e_pass').fadeIn('slow');
			$('#e_pass').html('Password Must Be 5 Characters');
		}
	}
	else
	{
		$('#e_pass').fadeOut();
		$('#e_pass_hid').val(0);
	}



	if(pass != '' && cpass != '')
	{
		
			if(pass === cpass){
				$('#e_cpass').fadeOut();
		        $('#e_pass_hid').val(0);
			}
			else
			{
				$('#e_cpass').fadeIn('slow');
				$('#e_pass_hid').val(1);
				$('#e_cpass').html('Password And Confirm Password Not Match');
			}
		
	}
	else
	{
		$('#e_cpass').fadeOut();
		$('#e_pass_hid').val(0);
	}
}

// Email 
function email_func(site_url){
	email = $('#email').val();
	if(email != ''){
		

		$.ajax({
		          type : "post",
		          url : site_url+'register/check_email',
		          data : "email="+email,
		          cache : false,
		          success:function( out ){

		          	if(out == 0)
		          	{
		          		$('#e_email').fadeOut();
		          		$('#e_email_hid').val(0);
		          	}
		          	else
		          	{
		          		$('#e_email').fadeIn('slow');
		          		$('#e_email_hid').val(1);
						$('#e_email').html('Email Is Already Registered');
		          	}

		          }
        		});


	}
	else{
		$('#e_email').fadeOut();
		$('#e_email_hid').val(0);
	}
}

///    Email     //////