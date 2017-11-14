<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Krerum | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?php
    echo $this->Html->css('bootstrap.min');
  ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <?php
    echo $this->Html->css('AdminLTE.min');
    echo $this->Html->css('iCheck/square/blue');
  ?>
  <style>
    body {
        background-image: url('https://unsplash.it/1366/768/?random&blur');
        position: absolute;
        top:0;
        bottom:0;
        right:0;
        left:0;
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }
  </style>
</head>
<body class="hold-transition">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div class="login-logo">
            <!-- <span><i style="vertical-align: middle;" class="icon fa fa-newspaper-o"></i></span> -->
          <a href="#" style="color: #222;"><b>Krerum</b></a>
        </div>
        <hr />
        <p class="login-box-msg">Sign in to start your session</p>
        <?php echo $content_for_layout ?>

        <!-- <form action="../../index2.html" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div> -->
            <!-- /.col -->
            <!-- <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div> -->
            <!-- /.col -->
          <!-- </div>
        </form> -->

        <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

        <!-- <a href="#">I forgot my password</a><br> -->
        <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <?php
        echo $this->Html->script('jQuery/jquery-2.2.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('../css/iCheck/icheck.min');
    ?>
    <!-- jQuery 2.2.3 -->
    <!-- <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script> -->
    <!-- Bootstrap 3.3.6 -->
    <!-- <script src="../../bootstrap/js/bootstrap.min.js"></script> -->
    <!-- iCheck -->
    <!-- <script src="../../plugins/iCheck/icheck.min.js"></script> -->
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    </body>
    </html>
