<?php 
	session_start();	
	require 'dbconfig.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$passwordError = null;
		$password_confirmError = null;
	
		
		// keep track post values
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		
		$_SESSION['pass'] = $_POST['password'];

		$count = 0;
		
		// validate input
		$valid = true;
		if (empty($username)) {
			$nameError = 'Please enter Name and Surname';
			$valid = false;
		}		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($password)) {
			$passwordError = 'Please enter Password';
			$valid = false;
		}
		if (empty($password_confirm)) {
			$password_confirmError = 'Please confirm Password';
			$valid = false;
		}


		
		// insert data
		if ($valid && $password_confirm == $password && strlen($password) >= 6) {

		

			$sql = "INSERT INTO user (name,email,password) values(?, ?, ?)";
			$sql2 = "SELECT *FROM user WHERE email=$email";
			$q2 = $db_con->prepare($sql2);

			$q = $db_con->prepare($sql);
			$q->execute(array($username,$email,$password));

			$_SESSION['user_email']=$email;
			$_SESSION['count']=$count;
			header("Location: log.php");
		}
		elseif ($password_confirm != $password) {
			$password_confirmError = "Doesn't match";		
			$valid = false;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Sign In</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	
	<!-- Custom Stylesheet -->
  <script src="js/jquery-2.2.1.min.js"></script>
  <link rel="stylesheet" href="css/style2.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<script type="text/javascript">
		function checkForm() {
		// Fetching values from all input fields and storing them in variables.
		var name = document.getElementById("username1").value;
		var password = document.getElementById("password1").value;
		var email = document.getElementById("email1").value;
		var website = document.getElementById("password_confirm1").value;
		//Check input Fields Should not be blanks.
		if (name == '' || password == '' || email == '' || website == '') {
			alert("Fill All Fields");
		} else {
			//Notifying error fields
			var username1 = document.getElementById("username");
			var password1 = document.getElementById("password");
			var email1 = document.getElementById("email");
			var website1 = document.getElementById("password_confirm");
			//Check All Values/Informations Filled by User are Valid Or Not.If All Fields Are invalid Then Generate alert.
			if (username1.innerHTML == 'Must be 3+ letters' || password1.innerHTML == 'Password too short' || email1.innerHTML == 'Invalid email' || website1.innerHTML == 'Doesnt match') {
				alert("Fill Valid Information");
			} else {
			//Submit Form When All values are valid.
				document.getElementById("myForm").submit();
				}
			}
		}
		function validate(field, query) {
		var xmlhttp;
		if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else { // for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
			document.getElementById(field).innerHTML = "Validating..";
		} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	  		document.getElementById(field).innerHTML = xmlhttp.responseText;
		} else {
			document.getElementById(filed).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
			}
		}
		xmlhttp.open("GET", "validation.php?field=" + field + "&query=" + query, false);
		xmlhttp.send();
		}
</script>
</head>

<body>
	<div class="container">
		
		<div class="login-box animated fadeInUp">
			<form class="form-signin" method="post" action="login_process.php" id="login-form">       
			<div class="box-header">
				<h2>Registration</h2>
			</div>
			<div id="error">
              </div>
			<label for="username">Username</label>
			<br/> 
			<input type="text" id="username1" name="username" onblur="validate('username', this.value)" class="form-control" value="<?php echo !empty($name)?$name:'';?>">
			    	<strong><div id="username"></div></strong>
			
			<label for="password">Email</label>
            <br/> 
			<input type="email" id="email1" name="email"  onblur="validate('email', this.value)" class="form-control" value="<?php echo !empty($email)?$email:'';?>">
			    	<strong><div id='email'></div></strong>

			<label for="password">Password</label>
            <br/> 
            <input type="password" id="password1" name="password"  onblur="validate('password', this.value)" class="form-control" value="<?php echo !empty($password)?$password:'';?>">
					<strong><div id="password"></div></strong>
			<br/> 
			<label for="password">Password confirm</label>	
				<br/> 
			<input type="password" id="password_confirm1" name="password_confirm" onblur="validate('password_confirm', this.value)" class="form-control">
					<strong><div id="password_confirm"></div></strong> 
            <label class="checkbox" >
            </label>
			
			<button type="submit" class="btn btn-success btn-block up btn-lg" onclick="checkForm()" name='submit'><strong>Join</strong></button>
			<br/>
			<!--<a href="#"><p class="small">Forgot your password?</p></a>-->
			<small class="small">
		      		<p>Already have an account? <a href="log_in.php"><strong> Log in</strong></a></p>
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