
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
$sql1 = "SELECT COUNT(m.ut_id) FROM member m inner join  usertype ut on m.ut_id = ut.ut_id where m.ut_id = '$ut_id'";
$result2 = mysql_query($sql1,$conn);
$record2=mysql_fetch_array($result2);
$holding=$record2[0];
 //echo $holding;
if($holding>0){
    echo success_h3("ไม่สามรถลบข้อมูลได้","showusertype.php");
}else if($holding<0)
    {
    $sql = "DELETE FROM usertype WHERE ut_id = '$ut_id'";
    mysql_query($sql,$conn)
	    or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

    echo success_h3("ลบข้อมูลเรียบร้อยแล้ว","showusertype.php");
}
mysql_close();

?>
</body>
</html>