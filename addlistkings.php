
<?php

session_start();
include("connect.php");  
include("script.php");  
include("alert.php");                                
?>


<?php
$valid_uname = $_SESSION['valid_uname'];
$bw_date  = date('Y-m-d');
$bw_returndate = date("Y-m-d",strtotime("+1 weeks"));
$bw_returndate1 = date("Y-m-d",strtotime("+15 day"));
$m_id = $_POST["m_id"];
$dk_id = $_POST["dk_id"];
$bl_id = $_POST["bl_id"];
$bd_status = "1";
$bl_status = "1";
$bk_status = "2";

$sqllending="SELECT COUNT(bd.bl_id) FROM borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  WHERE bd.bl_id='$bl_id' AND bw.m_id='$m_id' AND bd.bd_status='1' ";
$result1 = mysql_query($sqllending,$conn);
$record1=mysql_fetch_array($result1);
$lending=$record1[0];

$sqlholding="SELECT COUNT(bw.m_id) FROM borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  WHERE bw.m_id='$m_id' AND bd.bd_status='1' ";
$result2 = mysql_query($sqlholding,$conn);
$record2=mysql_fetch_array($result2);
$holding=$record2[0];

$sqll = "SELECT t.ut_id FROM member m , usertype t where t.ut_id = m.ut_id and m.m_id = '$m_id'";
$resull = mysql_query($sqll, $conn);
$r = mysql_fetch_array($resull);

// $sqlck ="select bk.bk_id from bookings bk 
//             inner join bookingdetails bt  on bk.bk_id = bt.bk_id 
//             where bk.bk_id = $bk_id ";
// $resultck = mysql_query($sqlck,$conn);
// $record3 = mysql_fetch_array($resultck);
// $check = $record3[0];


function endprocess(){
return success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showborrowing.php");  

}
if($holding>=5){
echo"<script language=\"javascript\">";

echo"alert('หนังสือเกินที่กำหนด');";
echo"window.history.go(-1);";
echo"</script>";
}else{
// foreach($_SESSION['shopping_cart'] as $bl_id);

if(empty($bl_id)){
    echo error_h3("กรุณาเลือกรายการหนังสือ");
    return;
}
else if ($bl_id !=null) {
    $sql = "SELECT * FROM borrowingdetails WHERE bl_id = '$bl_id'  ";
    $result = mysql_query($sql, $conn);
    $total = mysql_fetch_array($result);
    // for($i=1; $i>=$check; $i++){
        if ("$r[ut_id]" =='4'){
            $sql4  ="SELECT t.ut_id FROM member m , usertype t where m.ut_id = '$r[ut_id]'";
            $result4 = mysql_query($sql4,$conn);
            $total1 = mysql_num_rows($result4);
            // if ($total1 == 0){

            
            $sql1	= "insert into borrowing (bw_date,bw_returndate,m_id,mw_id) VALUES ('$bw_date','$bw_returndate','$m_id','$valid_uname')";
            $result1 = mysql_query($sql1,$conn);   
            $bw_id = mysql_insert_id();//คำสั่งให้ FK อ้างถึงกันในกรณี id เป็น Auto
            // foreach($_SESSION['shopping_cart'] as $bl_id){
            
            //     $sql2 = "select * from book b inner join bookcategory bc on  b.bc_id = bc.bc_id inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['shopping_cart'][$bl_id]."'";     
            //     $result2 = mysql_query($sql2,$conn);   
            //     $row2 = mysql_fetch_array($result2);                                                 
                
                    $sql3 = "insert into borrowingdetails (bd_status,bw_id,bl_id) VALUES('$bd_status','$bw_id','$bl_id')";
                    $result3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());
                        
                    $sql4 = "Update booklist Set bl_status='$bl_status' Where bl_id='$bl_id'";
                    $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());

                    $sql6 = "Update bookingsdetails Set dk_status='$bk_status' Where dk_id='$dk_id'";
                    $result6 = mysql_query($sql6, $conn) or die ("Error in query: $sql6 " . mysql_error());
            
        }else{
            // for($i=1; $i<=$check; $i++){
                $sql1	= "insert into borrowing (bw_date,bw_returndate,m_id,mw_id) VALUES ('$bw_date','$bw_returndate1','$m_id','$valid_uname')";
                $result1 = mysql_query($sql1,$conn);   
                $bw_id = mysql_insert_id();//คำสั่งให้ FK อ้างถึงกันในกรณี id เป็น Auto                                              
                    
                        $sql3 = "insert into borrowingdetails (bd_status,bw_id,bl_id) VALUES('$bd_status','$bw_id','$bl_id')";
                        $result3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());
                            
                        $sql4 = "Update booklist Set bl_status='$bl_status' Where bl_id='$bl_id'";
                        $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());

                        $sql6 = "Update bookingsdetails Set dk_status='$bk_status' Where dk_id='$dk_id'";
                        $result6 = mysql_query($sql6, $conn) or die ("Error in query: $sql6 " . mysql_error());
            // }
        }
    // }      
}

echo  "<script>
$(document).ready(function(){
    Swal.fire({
        title: '<h1>บันทึกข้อมูลเรียบร้อยแล้ว</h1>',
        text: '',
        type: 'success',
        //showCancelButton: true,
        confirmButtonColor: '#3085d6',
        //cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง'
      }).then((result) => {
        location.href = 'showborrowing.php';
      })
})

</script>"; 
mysql_close($conn); 
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
<link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
</head>
<body>
</body>
</html>
<!-- // $sql = "select *
// FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
// inner join booklist bl on bd.bl_id = bl.bl_id
// inner join book b on b.b_id = bl.b_id
// inner join bookcategory bc on bc.bc_id = b.bc_id    
// inner join member m on m.m_id = bw.m_id ";
// $result = mysql_query($sql,$conn);          
// echo $holding;
// if($check>1){
//    echo"<script language=\"javascript\">";
//    echo"alert('หนังสือเล่มนี้ถูกสมาชิกนี้ยืมอยู่แล้ว');";
//    echo"window.location = 'frm_addborrowing.php';";
//    echo"</script>";
// } -->
