
<?php
	session_start();
	
	$bl_id = $_POST['bl_id']; 
	$act = $_POST['act'];

 
	if($act=='add' && !empty($bl_id))
	{
		if(!isset($_SESSION['return']))
		{
			$_SESSION['return'][$bl_id] = $bl_id;
			header("location:frm_addbookre.php");
		}else {
			$_SESSION['return'][$bl_id] = $bl_id;
			header("location:frm_addbookre.php");
		} 
		// echo $_SESSION['return'];
	}
 
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['return'][$bl_id]);
		header("location:frm_addbookre.php");
	}

	// echo $_SESSION['return'][$bl_id] = $bl_id;
	// header("location:frm_addbookre.php");

?>
 