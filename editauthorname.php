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
$id = $_POST['id'];
$a_id = $_POST['a_id'];
$a_name = $_POST['a_name'];

// check bank text
if($a_id  && $a_name ){
	$sql = "SELECT * FROM authorname WHERE  a_id='$a_id' and a_name='$a_name'";
    $total = mysql_query($sql,$conn);

    if(mysql_num_rows($total) == 0){
        $sql = "UPDATE authorname SET a_id = '$a_id', a_name = '$a_name' WHERE id = '$id'";
        mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    }else{
        echo error_h3("ชื่อสถานที่พิมพ์ซ้ำ","showauthorname.php");
        return;
    }
}else{
    echo error_h3("กรุณาป้อนชื่อสถานที่พิมพ์","showauthorname.php");
    return;
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showauthorname.php");
?>
</body>
</html>