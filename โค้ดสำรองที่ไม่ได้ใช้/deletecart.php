
<?php
	session_start();
	
	$bl_id = $_GET['bl_id']; 
	$act = $_GET['act'];

	
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['cart'][$bl_id]);
	}
    echo $_SESSION['cart'][$bl_id];
	header("location:frm_addbookings.php");

?>