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

$m_id = $_POST['m_id'];
$m_name = $_POST['m_name'];
$m_add = $_POST['m_add'];
$m_date = $_POST['m_date'];
$m_idline = $_POST['m_idline'];
$m_status = $_POST['m_status'];
$m_pass = $_POST['m_pass'];
$ut_id = $_POST['ut_id'];

if($m_id ){
    // check diplicate priamry key
//    $sql = "SELECT * FROM member WHERE  m_id != '$m_id'";
//    $total = mysql_query($sql,$conn);
//
//    if(mysql_num_rows($total) == 0){
        $sql = "UPDATE member SET  m_name= '$m_name', m_add = '$m_add', m_date = '$m_date' ,m_idline = '$m_idline',m_pass = '$m_pass',ut_id = '$ut_id' WHERE m_id = '$m_id'";
        mysql_query($sql,$conn)
        or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
//    }else{
//        echo error_h3("สมาชิกซ้ำ","showmem.php");
//        return;
//    }
}else{
    $msg = "";
    if(!$m_name) $msg = $msg." รหัส";
    if(!$m_add) $msg = $msg." ชื่อ";
    if(!$m_date) $msg = $msg." วันที่เป็นสมาชิก";
    echo error_h3("กรุณาป้อน{$msg}","showmem.php");
    return;
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยแล้ว","showmem.php");
?>
</body>
</html>