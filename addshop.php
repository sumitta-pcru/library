<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

</head>
<body>

<?php
	session_start();
	include 'connect.php';
	$bl_id = $_POST['bl_id']; 
	$act = $_POST['act'];
 //echo $act;
//  echo $bl_id;

	$sqllending="SELECT COUNT(bt.bl_id) FROM bookingsdetails bt  WHERE bt.bl_id='$bl_id'  AND bt.dk_status='0' ";
	$result1 = mysql_query($sqllending,$conn);
	$record1=mysql_fetch_array($result1);
	$lending=$record1[0];
 echo $lending;
if($lending>=1){

           echo"<script language=\"javascript\">";
            echo"alert('หนังสือเล่มนี้ถูกจองแล้ว');";
            echo"window.location = 'frm_addborrowing.php';";
            echo"</script>";
            
}else{
	if($act=='add' && !empty($bl_id))
	{
		// echo "1";
		if(!isset($_SESSION['shopping_cart']))
		{
			// echo "2";
			//$_SESSION['shopping_cart']=[];
			$_SESSION['shopping_cart'][$bl_id] = $bl_id;
			header("location:frm_addborrowing.php");
		}else {
			// echo "3";
			$i = 0;
            foreach ($_SESSION['shopping_cart'] as $x) {
				$i++;
			}
			// echo $i;
			if ($i < 2) {
				$_SESSION['shopping_cart'][$bl_id] = $bl_id;
				header("location:frm_addborrowing.php");
				//echo $_SESSION['shopping_cart'][$bl_id] = $bl_id;
			}
			else {
				// echo "11";
				echo"<script language=\"javascript\">";
				echo"alert('จำนวนหนังสือเกินที่กำหนด');";
				echo"window.location ='frm_addborrowing.php';";
				echo"</script>";

				// echo"<script language=\"javascript\">";
				// echo"alert('บันทึกข้อมูลเรียบร้อยแล้ว');";
				// echo"window.location = 'showdept.php';";
				// echo"</script>";
			}	
		} 
	}
 
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['shopping_cart'][$bl_id]);
		header("location:frm_addborrowing.php");
	}
}
	//echo $_SESSION['shopping_cart'][$bl_id] = $bl_id;
	//header("location:frm_addborrowing.php");


?>
</body>
</html>
 