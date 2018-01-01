<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>Register - Revisiting Ajanta</title>

  <!-- Icons -->
  <link href="/assets/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 hcenter">
          <img class="img-responsive" src="/assets/images/profile.png" alt="Ajanta Logo Image" />
        <div class="card mx-4" style="margin-top:15px;">
          <form class="card-body p-4" id="register-form">
            <h1>Register</h1>
            <p class="text-muted">Create your account</p>
            <div id="error">
                
            </div>
            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="icon-info"></i></span>
              <input type="text" class="form-control" id="first_name" placeholder="First Name" >
            </div>
            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="icon-info"></i></span>
              <input type="text" class="form-control" id="last_name" placeholder="Last Name" >
            </div>
            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="icon-user"></i></span>
              <input type="text" class="form-control" id="username" placeholder="Username" >
            </div>

            <div class="input-group mb-3">
              <span class="input-group-addon">@</span>
              <input type="email" class="form-control" id="email" placeholder="Email" >
            </div>

            <div class="input-group mb-3">
              <span class="input-group-addon"><i class="icon-lock"></i></span>
              <input type="password" class="form-control" id="password" placeholder="Password" >
            </div>

            <div class="input-group mb-4">
              <span class="input-group-addon"><i class="icon-lock"></i></span>
              <input type="password" class="form-control" id="conf_password" placeholder="Repeat password" >
            </div>

            <button type="submit" class="btn btn-block btn-success" id="create-account">Create Account</button>
          </form>
<!--          <div class="card-footer p-4">
            <div class="row">
              <div class="col-6">
                <button class="btn btn-block btn-facebook" type="button">
                  <span>facebook</span>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-block btn-twitter" type="button">
                  <span>twitter</span>
                </button>
              </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  
    <script>
      $(document).ready(function(){
          $('#register-form').submit(function(e){
              e.preventDefault();
              $('#create-account').attr('disabled', 'disabled');
              $('#error').html('<div class="alert alert-warning"><i class="fa fa-spin fa-spinner"></i> Submitting....</div>');
              
                var data = new Object();
              data['first_name'] = $('#first_name').val();
              data['last_name'] = $('#last_name').val();
              data['email_addres'] = $('#email').val();
              data['user_name'] = $('#username').val();
              data['pass_word'] = $('#password').val();
              data['conf_password'] = $('#conf_password').val();
              createAccount(data);
          });
      });
      
      function createAccount(data)
      {
          $.post('/auth/user/add', {data:data}, function(){
              $('#error').html('<div class="alert alert-success">User Registration Successful. <a href="/auth/login">Click Here to Login</a></div>');
                window.location.href = '#error';
                
          },'json').fail( function(xhr, textStatus, errorThrown) {
                $('#error').html('<div class="alert alert-danger">' + xhr.responseJSON + '</div>');
                window.location.href = '#error';
                $('#create-account').removeAttr('disabled', 'disabled');
            },'json');
      }
    </script>
<div style="display:none">
</body>
</html>