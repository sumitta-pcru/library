<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
	<?php
include "script.php";?>
</head>
<body>
<?php
include "connect.php";
include "alert.php";

// $lo_id = $_POST["lo_id"];
$a_id = $_POST["a_id"];
$a_name = $_POST["a_name"];


if($a_id  !=null && $a_name  !="" ){
	$sql = "SELECT * FROM authorname WHERE  a_id='$a_id' and a_name='$a_name'";
	$result = mysql_query($sql,$conn);
	$total = mysql_num_rows($result);

	if($total == 0){
		$sql = "INSERT INTO authorname (a_id,a_name) VALUES('$a_id','$a_name')";
		mysql_query($sql,$conn)
			or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
		mysql_close();
		echo success("บันทึกข้อมูลเรียบร้อยแล้ว","showauthorname.php");
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