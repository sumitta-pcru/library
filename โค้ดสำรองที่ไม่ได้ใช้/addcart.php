<meta charset="UTF-8">
<?php
	session_start();
	
	$bl_id = $_POST['bl_id']; 
	$act = $_POST['act'];
 
	if($act=='add' && !empty($bl_id))
	{
		if(!isset($_SESSION['cart']))
		{
			$_SESSION['cart']=[];
			
		}else {
			$_SESSION['cart'][$bl_id] = $bl_id;
			
		} 

	}
 
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['cart'][$bl_id]);
	}
	
	echo $_SESSION['cart'][$bl_id] = $bl_id;
	header("location:frm_addbookings.php");
?>