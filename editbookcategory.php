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
include "script.php";
include "connect.php";
include "alert.php";
$bc_name = $_POST["bc_name"];
$bc_id = $_POST["bc_id"];
// check bank text
if($bc_name && $bc_id){
	// check diplicate primary key
	$sql = " SELECT * FROM bookcategory WHERE bc_name = '$bc_name'";
	$total = mysql_query($sql,$conn);
	echo mysql_num_rows($total);
	if(mysql_num_rows($total) == 0){
		$sql = "UPDATE bookcategory SET bc_id = '$bc_id',bc_name = '$bc_name' WHERE bc_id = '$bc_id'";
		mysql_query($sql,$conn)
			or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
	}else{
		echo error_h3("ชื่อหมวดหมู่ซ้ำ","showbookcategory.php");
		return;
	}
	
}else{
	echo error_h3("กรุณาป้อนชื่อหมวดหมู่","showbookcategory.php");
	return;
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showbookcategory.php");
?>

</body>
</html>