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

$b_id = $_POST['b_id'];

// $b_name = $_POST['b_name'];
// $a_id = $_POST['a_id'];
$b_year = $_POST['b_year'];
$lo_id = $_POST['lo_id'];
// $b_num ='0';
$b_pic = $_POST['b_pic'];
$b_price = $_POST['b_price'];
$othername=$_POST['othername'];
// $b_date = $_POST['b_date'];
// $bc_id = $_POST['bc_id'];

$fileupload = $_FILES['photo']['tmp_name'];
$fileupload_name =$_FILES['photo']['name'];

//$sql = "SELECT b_id,b_isbn,b_name,b_author,b_year FROM book where b_id = '$b_id' ";
//$total = mysql_query($sql,$conn);
//if(mysql_num_rows($total) > 0){
//	echo error_h3("อาจารย์ซ้ำ","showbook.php");
//	return;,b_num = '$b_num',b_num = '$b_num'b_id = '$b_id',b_id = '$b_id',
//}

if($fileupload != ""){
	if($b_pic != ""){
		@unlink("./picture/$b_pic");
	}
	copy($fileupload,"./picture/".$fileupload_name);
	$sql = "UPDATE book SET b_year = '$b_year',lo_id = '$lo_id',b_price = '$b_price',othername = '$othername',b_pic = '$fileupload_name' WHERE b_id = '$b_id'";

}else{
    $sql = "UPDATE book SET b_year = '$b_year',lo_id = '$lo_id',b_price = '$b_price',othername = '$othername' WHERE b_id = '$b_id'";
}

mysql_query($sql,$conn)
	or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยเเล้ว","showbook.php");
return;
?>
</body>
</html>