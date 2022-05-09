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

$sql = "SELECT * FROM book WHERE b_id = '$b_id'";
$result = mysql_query($sql,$conn);
$rs = mysql_fetch_array($result);
$sql1 = "SELECT COUNT(bl.b_id) FROM booklist bl inner join book b on bl.b_id = b.b_id WHERE bl.b_id = '$b_id'";
$result2 = mysql_query($sql1,$conn);
$record2=mysql_fetch_array($result2);
$holding=$record2[0];

//echo $holding;
if($holding>0){
    echo success_h3("ไม่สามรถลบข้อมูลได้","showbook.php");
}else{
    if("$rs[b_pic]" != ""){ @unlink("./picture/$rs[b_pic]"); }
    $sql = "DELETE FROM book WHERE b_id = '$b_id'";
mysql_query($sql,$conn)
	or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
echo success_h3("ลบข้อมูลเรียบร้อยเเล้ว","showbook.php");
}
mysql_close();

?>
</body>
</html>