<!DOCTYPE html> 
<html lang="en-US">
    <head>
        <title>Revisiting Ajanta Project</title>
        <meta charset="utf-8">
        <link href="/assets/css/loginstyle.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/animate.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    </head>
    


    <body class="background-colour">
        <div class="row">
            <header>
                <img class="img-responsive" src="/assets/images/profile.png" alt="Ajanta Logo Image">
                <div class="intro-text"><br/><br/>
                    <span class="name text-center">Revisiting Ajanta</span>
                </div><br/><br/>
                <div class="formopen">
                <?php
                echo form_open('/home/validate_credentials');
                echo '<h2 class="text-central">Enter Your Credentials</h2>';
                echo form_input('user_name', '', 'placeholder="Enter Your Username"');
                echo "\t\t\t\t\t\t";
                echo form_password('password', '', 'placeholder="Enter Your Password"');
                echo "\t\t\t\t\t\t";
                echo form_submit('submit', 'Login', 'class="btn btn-primary btn-large"');
                echo "\t\t\t";
                echo anchor('home/signup', '<h5>Are you New User, then Signup!</h5>');
                
                //echo anchor('rest', '<h5>Check YOUR REST !</h5>');
                //echo anchor('rest_server', '<h5>Check WORKING REST!</h5>');
                echo form_close();
                ?>
                </div>
            </header>
        </div>
    </body>
    <script>
  $(document).ready(function() {
    $(".formopen").addClass("animated bounce");
  });
</script>

</html>