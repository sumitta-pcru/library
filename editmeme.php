<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
include "connect.php";
include "script.php";
include "alert.php";
$m_name = $_POST['m_name'];
$m_add = $_POST['m_add'];
$m_idline = $_POST['m_idline'];
$m_pass = $_POST['m_pass'];


if($m_name) {
// check diplicate priamry key
//    $sql = "SELECT * FROM member WHERE  m_id != '$m_id'";
//    $total = mysql_query($sql,$conn);
//
//    if(mysql_num_rows($total) == 0){
    $sql = "UPDATE member SET m_name= '$m_name', m_add = '$m_add' ,m_idline = '$m_idline',m_pass = '$m_pass' WHERE m_name = '$m_name'";
    mysql_query( $sql, $conn )
    or die( "3. ไม่สามารถประมวลผลคำสั่งได้" ) . mysql_error();
}
mysql_close();
echo success_h3("แก้ไขข้อมูลเรียบร้อยเเล้ว","frm_editmeme.php");
?>
</body>
</html>