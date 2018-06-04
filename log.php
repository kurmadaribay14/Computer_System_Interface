<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Daily UI - Day 1 Sign In</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	
	<!-- Custom Stylesheet -->
  <script src="js/jquery-2.2.1.min.js"></script>
  <link rel="stylesheet" href="css/style2.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<script type="text/javascript">
    function myFunction(name){
      var logname = document.getElementById(''+name);
      if (logname.value.length == 0) {
          return;
      } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  if(xmlhttp.responseText == "yes"){
                    logname.style.border = '1px  green ';
                    document.getElementById('login').innerHTML="Exist";
                    document.getElementById('logerror').innerHTML="";
                  }
                  else{
                    logname.style.border = '1px red';
                    document.getElementById('logerror').innerHTML="This login doesn't exist";
                    document.getElementById('login').innerHTML="";
                  }
              }
          };
          xmlhttp.open("GET", "login_process.php?q=" + logname.value, true);
          xmlhttp.send();
      }
  }
  </script>
</head>

<body>
	<div class="container">
		
		<div class="login-box animated fadeInUp">
			<form class="form-signin" method="post" action="login_process.php" id="login-form">       
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<div id="error">
              </div>
			<label for="username">Username</label>
			<br/> 
			<input type="email" class="form-control"  required autofocus="" name="user_email" id="user_email"  onblur="myFunction('user_email')"  />
            <strong><p style = "color:red" id="logerror"></p></strong>
            <strong><p style = "color:green" id="login"></p></strong>
			<label for="password">Password</label>
            <br/> 
            <input type="password" class="form-control" required="" name="password" id="password"/>       
            <label class="checkbox" >
            </label>
			<br/>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login" id="btn-login"><strong>Sign In</strong></button>
			<br/>
			<br/>
			<input type="checkbox" name="terms" />Remember me
			<!--<a href="#"><p class="small">Forgot your password?</p></a>-->
			<small class="small">
              <p>Do not have an account? <a href="reg.php"><strong> Join us</strong></a></p>
            </small>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>
<script src="js/bootstrap.min.js"></script>
</html>