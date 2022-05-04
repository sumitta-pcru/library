
<?php
	session_start();
	
	$bl_id = $_GET['bl_id']; 
	$act = $_GET['act'];

	
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['return'][$bl_id]);
	}
    echo $_SESSION['return'][$bl_id];
	header("location:frm_addbookre.php");
