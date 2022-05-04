
<?php
		session_start();
	
    if(!empty($_SESSION["cart"]))
    {
        unset($_SESSION["cart"]);
    }
     echo $_SESSION['cart'];
   header("location:frm_addbookings.php");
 
?>