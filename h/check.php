<?php 
session_start();
include '../include/boots.php';


if(isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])){
	include '../include/connect.php' ;
}
else{
	echo '<div class="alert alert-danger" role="alert"> Please Login ! </div>';
	echo '<a href="../frm/frm_login.php"> 
			<button type="button" class="btn btn-primary"> Back </button> </a>';
	exit();
	
}


?>