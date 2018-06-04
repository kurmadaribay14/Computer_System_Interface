<?php
$con = mysql_connect("localhost", "root", "");
if(!$con)
{	
	echo "Could not connect. " . mysql_error();
}
mysql_select_db("csi");
?>