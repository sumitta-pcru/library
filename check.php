<?php
session_start();
if(isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])){
	include "connect.php";
	$valid_uname = $_SESSION['valid_uname'];
	
}
else{
	echo "<script>alert('Please Login');window.location='frm_login.php';</script>";
		exit();
	}
?>


