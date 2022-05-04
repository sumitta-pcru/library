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
$dk_id=$_POST['dk_id'];
$bl_id=$_POST['bl_id'];
$dk_status = "2";
// echo $bl_id;
// $bl_status ='0';
// $sql = "select *
//            FROM  bookings bk inner join member m on m.m_id = bk.m_id 
//            inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
//             where  bk.bk_id ='$bk_id' ";
// //         //    and bt.bl_id ='$bl_id'
// $result = mysql_query($sql,$conn);
// $rs = mysql_fetch_array($result);

// $sqllending="SELECT COUNT(bt.bk_id) FROM   bookingsdetails bt     WHERE bt.bk_id='$bk_id' AND bt.dk_status='0' ";
// $result1 = mysql_query($sqllending,$conn);
// $record1=mysql_fetch_array($result1);
// $lending=$record1[0];


// if($lending<=1){
//     $sql = "DELETE FROM bookings WHERE bk_id = '$bk_id'";
//     mysql_query($sql,$conn) or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
//     $sql1 = "DELETE FROM bookingsdetails WHERE bl_id = '$bl_id'";
//     mysql_query($sql1,$conn) or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
// }else{
//     $sql1 = "DELETE FROM bookingsdetails WHERE bl_id = '$bl_id'";
//     mysql_query($sql1,$conn) or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
// }
$sql = "UPDATE bookingsdetails SET  dk_status = '$dk_status' WHERE dk_id = '$dk_id'";
mysql_query($sql,$conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
mysql_close();

echo success_h3("ยกเลิกข้อมูลเรียบร้อยเเล้ว","showbookings.php");



?>
</body>
</html>