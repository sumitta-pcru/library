
<?php
	session_start();
	
   if(!empty($_SESSION["return"]))
   {
       unset($_SESSION["return"]);
   }
   echo $_SESSION['return'];
   header("location:frm_addbookre.php");
?>
	