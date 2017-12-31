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

  <title>Login</title>

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
            <div class="col-md-8 hcenter">
                <img class="img-responsive" src="/assets/images/profile.png" alt="Ajanta Logo Image" />
                <div class="card-group" style="margin-top:15px;">
                    <div class="card p-4">
                        <form class="card-body" method="POST">

                            <h1>Login</h1>
                            <p class="text-muted">Sign In to your account</p>
                            <?php 
                            if(trim($errorMessage) != '')
                            {
                                echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                            } ?>
                            <div class="input-group mb-3">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input type="text" class="form-control" name="data[user_name]" placeholder="Username">
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" class="form-control" name="data[pass_word]" placeholder="Password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                  <button type="submit" class="btn btn-primary px-4">Login</button>
                                </div>
                                <div class="col-6 text-right">
                                  <button type="button" class="btn btn-link px-0">Forgot password?</button>
                                </div>
                            </div>
                        </form>
                    </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                <p></p>
                <a href="/auth/register" class="btn btn-primary active mt-3">Register Now!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="/assets/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>