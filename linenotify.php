<?php
include 'connect.php';
include 'script.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];
$sql = "select *
            FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
            inner join booklist bl on bd.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id
            inner join bookcategory bc on bc.bc_id = b.bc_id    
            inner join member m on m.m_id = bw.m_id where bd.bd_status='1' ";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();


?>