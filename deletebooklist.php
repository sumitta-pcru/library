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
$bl_id = $_POST['bl_id'];

$sql1 = "SELECT COUNT(bk.bl_id) FROM booklist bl inner join bookingsdetails bk on bl.bl_id = bk.bl_id WHERE bl.bl_id = '$bl_id'";
$result2 = mysql_query($sql1,$conn);
$record2=mysql_fetch_array($result2);
$holding=$record2[0];
$sql12 = "SELECT COUNT(bw.bl_id) FROM booklist bl inner join borrowingdetails bw on bl.bl_id = bw.bl_id WHERE bl.bl_id = '$bl_id'";
$result22 = mysql_query($sql12,$conn);
$record22=mysql_fetch_array($result22);
$holding2=$record22[0];

if($holding>0){
    echo success_h3("ไม่สามรถลบข้อมูลได้","showbook.php");
}elseif($holding2>0){
    echo success_h3("ไม่สามรถลบข้อมูลได้","showbook.php");
}else{
$sql = "DELETE FROM booklist WHERE bl_id = '$bl_id'";
    mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    mysql_close();
    echo success_h3("ลบข้อมูลเรียบร้อยเเล้ว","showbook.php");
}
?>
</body>
</html>