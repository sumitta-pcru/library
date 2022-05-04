
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

</head>
<body>

<?php

include "connect.php";
error_reporting(~E_NOTICE);
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


if ($m_id  && $m_name  && $m_add && $m_date && $m_idline  && $m_pass) {
    $sql = "SELECT * FROM member WHERE m_id = '$m_id' or m_name = '$m_name' or  m_add = '$m_add' or  m_date = '$m_date' or  m_idline = '$m_idline' or  m_pass = '$m_pass' ";
    $result = mysql_query($sql, $conn);
    $total = mysql_fetch_array($result);
    if($total == 0){
        $sql1 = "INSERT INTO member (m_id,m_name,m_add,m_date,m_idline,m_status,m_pass,ut_id) VALUES('$m_id','$m_name','$m_add','$m_date','$m_idline','$m_status','$m_pass','$ut_id')";
        mysql_query($sql1,$conn)
        or die("3. Can't Query").mysql_error();
        mysql_close();
        echo success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showmem.php");
        return;
    }else{
        echo error_h3("ข้อมูลซ้ำ");
        return;
        }
}
else{
        echo error_h3("กรุณาป้อนข้อมูลให้ครบ");
		return;
}

// else{
//     $msg = "";
//     if(!$m_id) $msg = $msg." รหัสผู้ใช้";
//     if(!$m_name) $msg = $msg." ชื่อ-สกุล";

//     echo error_h3("กรุณาป้อน{$msg}'");
// }

?>



</body>
</html>