<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Icon -->
  <link rel="shortcut icon" type="file-content-type" href="images/HT Icon.ico" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
    .large.tooltip-inner {
      max-width: 300px;
      width: 350px;
      background-color: red;
    }

    .large.tooltip-arrow {
      background-color: red;
    }
  </style>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <img src="images/HT Icon.png" class="img" width="20%;">
    <a href=""><b>Register</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <!-- <form id="formReg">
      <div class="form-group has-feedback">
        <input id="inFirstName" type="text" class="form-control" name="first_name" placeholder="First name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="inMiddleName" type="text" class="form-control" name="middle_name" placeholder="Middle name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="inLastName" type="text" class="form-control" name="last_name" placeholder="Last name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="inEmail" type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="inPass" type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="inConfirm" type="password" class="form-control" name="confirm" placeholder="Confirm password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input id="cbAgree" name="agree" type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button id="btnRegister" type="button" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>        
      </div>
    </form> -->

    <form id="formReg" role="form">
      <div class="form-group">
        <label for="inFirstName" class="control-label">First Name</label>
        <input type="text" class="form-control" id="inFirstName" placeholder="First name" required>
      </div>
      <div class="form-group">
        <label for="inMiddleName" class="control-label">Middle Name</label>
        <input type="text" class="form-control" id="inMiddleName" placeholder="Middle name" required>
      </div>
      <div class="form-group">
        <label for="inLastName" class="control-label">Last Name</label>
        <input type="text" class="form-control" id="inLastName" placeholder="Last name" required>
      </div>
      <div class="form-group">
        <label for="inEmail" class="control-label">Email</label>
        <input type="email" class="form-control" id="inEmail" placeholder="Email" data-error="Email address is invalid" required>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form-group">
        <label for="inPassword" class="control-label">Password</label>
        <div class="form-inline row">
          <div class="form-group col-sm-5">
            <input type="password" data-minlength="6" class="form-control" id="inPassword" placeholder="Password" required>
            <div class="help-block">Minimum of 6 characters</div>
          </div>
          <div class="form-group col-sm-5">
            <input type="password" class="form-control" id="inConfirm" data-match="#inPassword" data-match-error="Password does not match!" placeholder="Confirm Password" required>
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" id="terms" data-error="You must agree first to the terms and agreement!" required>
                I agree to the <a href="#">terms</a>
              </label>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="col-xs-4">
          <button id="btnRegister" type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>        
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

<script src="js/register.js"></script>
<script src="plugins/validator/validator.js"></script>

</body>
</html>
