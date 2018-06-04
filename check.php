<?php
include("connection.php");
$name = $_GET['email'];
$password = $_GET['password'];
$result = mysql_query("SELECT * FROM users WHERE email = '".$name."'");
$row = mysql_fetch_array($result);
if($row['password'] == md5($password))
{  
	    session_start();
	    $_SESSION['name'] = $row['name'];
	    header("Location:index1.php");
}
else header("Location: index.php?login=false"); 
?>