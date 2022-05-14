<?php
	session_start();
    include("connect.php");  
    include("script.php");  
    include("alert.php");  
   
                                 
?>
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

$valid_uname = $_SESSION['valid_uname'];

date_default_timezone_set('asia/bangkok');
$bk_date =  Date("Y-m-d H:i");
$bk_status = '0';

if(empty($_SESSION['cart'] )){
    echo error_h3("กรุณาเลือกรายการหนังสือ");
    return;
}else{
    $i = 0;
    foreach($_SESSION['cart'] as $bl_id){
        $sql5 = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id 
                            inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['cart'][$bl_id]."'";
        $result5 = mysql_query($sql5,$conn);
        $row5 = mysql_fetch_array($result5); 
        $i++;             
        }
   $sqlholding="SELECT COUNT(bk.m_id) as num FROM bookings bk inner join bookingsdetails bt  on bk.bk_id = bt.bk_id  WHERE bk.m_id='$valid_uname' AND bt.dk_status='0' ";
        $result2 = mysql_query($sqlholding,$conn);
        $record2=mysql_fetch_array($result2);
        $holding=$record2[0];
        $chk = $i+ $record2['num'];
//echo $chk;
    }
        if($chk>=6){
            echo   "<script>
            Swal.fire({
               icon: 'info',
               title: 'หนังสือเกินที่กำหนด ',
               text: 'จองไปแล้ว $holding เล่ม จองได้ทั้งหมดแค่ 5 เล่ม ',
               // showCancelButton: true,
               showConfirmButton: true,
               confirmButtonColor: '#3085d6',
               // cancelButtonColor: '#d33',
               confirmButtonText: 'ตกลง'
           }).then((result) => {
               window.location = 'frm_addbookings.php';
            })
          </script>";
          return;
        }else if($holding>=5){

            echo   "<script>
         Swal.fire({
            icon: 'info',
            title: 'ยืมหนังสือเกินที่กำหนด ',
            text: 'จำนวน $holding เล่ม',
            // showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง'
        }).then((result) => {
            window.location = 'frm_addbookings.php';
         })
       </script>";
       return;

        }else{
                
                    foreach($_SESSION['cart'] as $bl_id);
                
                    if ($bl_id !=null) {
                        $sql = "SELECT * FROM bookingsdetails WHERE bl_id = '$bl_id'  ";
                        $result = mysql_query($sql, $conn);
                        $total = mysql_fetch_array($result);
                
                            $sql = "INSERT INTO bookings (m_id,bk_date) VALUES('$valid_uname','$bk_date')";
                            $result = mysql_query($sql, $conn);
                                $bk_id = mysql_insert_id();//คำสั่งให้ FK อ้างถึงกันในกรณี id เป็น Auto
                                foreach($_SESSION['cart'] as $bl_id){
                            
                                    $sql1 = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['cart'][$bl_id]."'";     
                                    $result1 = mysql_query($sql1,$conn);   
                                    $row1 = mysql_fetch_array($result1);    
                                        $sql2 = "INSERT INTO bookingsdetails (bk_id,bl_id,dk_status) VALUES('$bk_id','$bl_id','$bk_status')";
                                        $result2 = mysql_query($sql2, $conn) or die ("Error in query: $sql2 " . mysql_error());

                                        $sql4 = "Update booklist Set bl_status='4' Where bl_id='$bl_id'";
                                        $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());
                                    }
                                    if($result && $result2){
                                        
                                        
                                        foreach($_SESSION['cart'] as $bl_id)
                                        {	
                                            unset($_SESSION['cart']);
                                    
                                        }
                                        
                                    }
                                    mysql_close($conn);
                                    echo success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showbookings.php");
                    }
                    // else{
                    //         echo error_h3("กรุณาเลือกรายการหนังสือ");
                    //         return;
                    // }  
                // }         
            }
            
?>
</body>
</html>