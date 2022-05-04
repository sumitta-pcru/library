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
$ut_id = $_POST['ut_id'];
$ut_name = $_POST['ut_name'];
$ut_date = $_POST['ut_date'];
$ut_rate = $_POST['ut_rate'];
$ut_advance = $_POST['ut_advance'];
$ut_num = $_POST['ut_num'];
// check bank text
if($ut_name){
    // check diplicate priamry key
    $sql = "SELECT * FROM usertype WHERE ut_name = '$ut_name' AND ut_id != '$ut_id'";
    $total = mysql_query($sql,$conn);

    if(mysql_num_rows($total) == 0){
        $sql = "UPDATE usertype SET ut_name = '$ut_name',ut_date = '$ut_date',ut_rate = '$ut_rate',ut_advance = '$ut_advance',ut_num = '$ut_num' WHERE ut_id = '$ut_id'";
        mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    }else{
        echo error_h3("ชื่อตำเเหน่งซ้ำ","showusertype.php");
        return;
    }
}else{
    echo error_h3("กรุณาป้อนชื่อตำเเหน่ง","showusertype.php");
    return;
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showusertype.php");
?>
</body>
</html>