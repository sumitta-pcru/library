

<?php
	session_start();
	
   if(!empty($_SESSION["shopping_cart"]))
   {
       unset($_SESSION["shopping_cart"]);
   }
   echo $_SESSION['shopping_cart'];
   header("location:frm_addborrowing.php");
?>
	