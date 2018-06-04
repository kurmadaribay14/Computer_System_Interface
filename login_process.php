<?php
	session_start();
	$con = mysqli_connect('localhost','root','','csi') or die("Unable to connect");

	if(isset($_GET['q'])){
		$sql = "SELECT * FROM user WHERE email = '".$_GET['q']."'";
		$res = mysqli_query($con, $sql);
		if(mysqli_num_rows($res)>0){
			echo "yes";
		}
		else{
			echo "no";
		}
		exit();

	}
	if(isset($_POST['btn-login'])){
		$user_email = $_POST['user_email'];
		$user_password = $_POST['password'];

		} 

		$sql = mysqli_query($con,"SELECT * from user where  email=\"$user_email\" and password=\"$password\"");
		if (mysqli_num_rows($sql)) {

			session_start();

			$_SESSION['user_email']=$user_email;
			$_SESSION['count'] = 1;

    		
     		$conn = mysqli_connect("localhost","root","","csi");
		     $count = $_SESSION['user_email'];
		     $query = "SELECT * FROM user WHERE email = '$count'";
		     $result = mysqli_query($conn, $query);
		     $row = mysqli_fetch_assoc($result);

		     
			
		}else{
			header('location:log.php');
		}
	

?>