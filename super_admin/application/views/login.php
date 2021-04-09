<?php

?>
<!doctype html>

<html class="no-js" lang="">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>
        Login | Edurama Unity ERP      </title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">

	    <link rel="shortcut icon" href="https://edurama.in/unityerp/assets/login_page/img/favicon.png">
      <link rel="stylesheet" href="https://edurama.in/unityerp/assets/css/bootstrap.css">
      <link rel="stylesheet" href="https://edurama.in/unityerp/assets/login_page/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://edurama.in/unityerp/assets/login_page/css/normalize.css">
      <link rel="stylesheet" href="https://edurama.in/unityerp/assets/login_page/css/main.css">
      <link rel="stylesheet" href="https://edurama.in/unityerp/assets/login_page/css/style.css">
      <script src="https://edurama.in/unityerp/assets/login_page/js/vendor/modernizr-2.8.3.min.js"></script>
		  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

    </head>
    <body>
		<div class="main-content-wrapper">
			<div class="login-area">
				<div class="login-header">
					<!--<a href="https://edurama.in/unityerp/login" class="logo">-->
					<!--	<img src="https://edurama.in/unityerp/assets/login_page/img/logo-white.png" height="120" alt="">-->
					<!--</a>-->
					<!--h2 class="title">Edurama Unity ERP</h2-->
				</div>
				
       
    
				 <div id="status"></div>
				<div class="login-content">
					<form  id="loginform" action="<?php echo base_url('');?>index.php/login/user_login" method="post">
						<div class="form-group">
							<input type="email" class="input-field" name="email" placeholder="Email"
                required autocomplete="off">
						</div>
						<div class="form-group">
							<input type="password" class="input-field" name="password" placeholder="Password"
                required>
						</div>
						<button type="submit" class="btn btn-primary">Login<i class="fa fa-lock"></i></button>
					</form>

					<div class="login-bottom-links">
						<a href="<?php echo base_url('');?>index.php/login/forgot_password" class="link">
							Forgot Your Password ?
						</a>
					</div>
				</div>
			</div>
			<div class="image-area" style="background-image:url(https://www.waikawabay.school.nz/images/homepage/waikawa-bay-school-home-1.jpg")></div>
		</div>

    <script src="https://edurama.in/unityerp/assets/login_page/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="https://edurama.in/unityerp/assets/js/bootstrap-notify.js"></script>

<script>
$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
    $.ajax({
       type: "POST",
       url: '<?php echo base_url();?>login/user_login',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data === 'Login') {
            window.location = '<?php echo base_url();?>home';
          }
          else {
           $('#status').html("<div class='alert alert-danger'>Invalid Login Details Please check  </div>");
          }
       }
   });
 });
});

    </script>
    
    </body>
</html>
