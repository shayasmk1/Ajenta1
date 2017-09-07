<!DOCTYPE html> 
<html lang="en-US">
  <head>
    <title>Ajanta BackEnd Support System</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/global.css" rel="stylesheet" type="text/css">
  </head>
  <body>
<?php
//form validation
echo validation_errors();
?>  	
<div class="container login">
<?php
			$attributes = array('class' => 'form-signin');
			
			//Form data is manipulated from user class and create_member() method
			echo form_open('home/create_member', $attributes);			
			
			echo "<span class='form-text'>Create Your Account Here !</span>";
			echo form_input('first_name', set_value('first_name'), 'placeholder="First name"');
			echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"');
			echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');
			echo form_input('username', set_value('username'), 'placeholder="Username"');
			echo form_password('password', '', 'placeholder="Password"');
			echo form_password('password2', '', 'placeholder="Password confirm"');
			
			$options = array(
					'administrator' => 'Administrator',
					'moderator' => 'Moderator',
					'dataentry' => 'Data Entry',
			);
			
			echo "<br><span class='form-text'>Choose Your Profile :</span>";
			echo form_dropdown('user_profile', $options, 'administrator', 'class="form-dropdown"');
			//echo form_input('$option[0]',set_value('user_profile'));
				
		
			echo form_submit('submit', 'SUBMIT');
			echo form_close();
			echo anchor('home/login', 'Already registered ?  Login Here !','class="form-text"');
?>

</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>    
    