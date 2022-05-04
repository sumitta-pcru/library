<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

</head>

<body>
<?php
include "connect.php";
include "script.php";
include "alert.php";


$ut_name = $_POST["ut_name"];
$ut_date = $_POST["ut_date"];
$ut_rate = $_POST["ut_rate"];
$ut_advance = $_POST["ut_advance"];
$ut_num = $_POST["ut_num"];

if($ut_name && $ut_date && $ut_rate && $ut_advance && $ut_num){
	$sql = "SELECT * FROM usertype WHERE ut_name = '$ut_name'";
	$result = mysql_query($sql,$conn);
	$total = mysql_num_rows($result);

	if($total == 0){
		$sql = "INSERT INTO usertype (ut_name,ut_date,ut_rate,ut_advance,ut_num) VALUES('$ut_name','$ut_date','$ut_rate',$ut_advance,$ut_num)";
		mysql_query($sql,$conn)
			or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
		mysql_close();
		echo success("บันทึกข้อมูลเรียบร้อยแล้ว","showusertype.php");
	}else{
		echo error_h3("ข้อมูลซ้ำ");
	}
}else{
	echo error_h3("กรุณาป้อนข้อมูลให้ครบ");
	return;
}
?>
</body>
</html>