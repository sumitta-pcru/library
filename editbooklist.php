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
$bl_status = $_POST['bl_status'];

if($bl_id){
    $sql = "SELECT * FROM booklist ";
    $total = mysql_query($sql,$conn);
        $sql = "UPDATE booklist SET bl_status = '$bl_status' WHERE bl_id = '$bl_id'";
        mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showbook.php");
?>
</body>
</html>