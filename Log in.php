
<!DOCTYPE html>
<html>
<head>
  <title>
    ShakeIt
  </title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta charset="utf-8">
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/jquery-2.2.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/bootstrap-social.css" rel="stylesheet" >
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
                    logname.style.border = '3px solid green ';
                    document.getElementById('login').innerHTML="Exist";
                    document.getElementById('logerror').innerHTML="";
                  }
                  else{
                    logname.style.border = '3px solid red';
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
<style type="text/css">
  body{
    background-image: url('img/BUDAPEST_v2.jpg');
    background-position: center center;
    background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
  } 
</style>
<body>
  <div class="video">
    <video autoplay loop muted class="bgvideo" id="bgvideo">
      <source src="video/6.mp4" type="video/mp4">
    </video>
  </div>
  <div class="main">
    <div class="wrapper ">
        <form class="form-signin" method="post" action="login_process.php" id="login-form">       
          <h2 class="form-signin-heading"><strong>LOG IN</strong></h2>
            <div id="error">
              </div>
            <input type="email" class="form-control"  placeholder="Email Address" required autofocus="" name="user_email" id="user_email" onblur="myFunction('user_email')"  />
            <strong><p style = "color:red" id="logerror"></p></strong>
            <strong><p style = "color:green" id="login"></p></strong>
            <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password"/>      
            <label class="checkbox" >
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login" id="btn-login"><strong>Login</strong></button>
            <small class="small">
              <p>Do not have an account? <a href="join.php"><strong> Join us</strong></a></p>
            </small>
        </form>
    </div>
    
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>