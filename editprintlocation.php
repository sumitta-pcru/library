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
$lo_id = $_POST['lo_id'];
$lo_name = $_POST['lo_name'];

// check bank text
if($lo_name){
    // check diplicate priamry key
    $sql = "SELECT * FROM printlocation WHERE lo_name = '$lo_name' AND lo_id != '$lo_id'";
    $total = mysql_query($sql,$conn);

    if(mysql_num_rows($total) == 0){
        $sql = "UPDATE printlocation SET lo_name = '$lo_name' WHERE lo_id = '$lo_id'";
        mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    }else{
        echo error_h3("ชื่อสถานที่พิมพ์ซ้ำ","showusertype.php");
        return;
    }
}else{
    echo error_h3("กรุณาป้อนชื่อสถานที่พิมพ์","showprintloca.php");
    return;
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showprintloca.php");
?>
</body>
</html>