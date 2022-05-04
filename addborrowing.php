
<?php

	session_start();
    include("connect.php");  
    error_reporting(~E_NOTICE);
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
$bw_date  = date('Y-m-d');
$bw_returndate = date("Y-m-d",strtotime("+1 weeks"));
$bw_returndate1 = date("Y-m-d",strtotime("+15 day"));
$m_id = $_POST["m_id"];
$bd_status = "1";
$bl_status = "1";

  $sqll = "SELECT t.ut_id FROM member m , usertype t where t.ut_id = m.ut_id and m.m_id = '$m_id'";
    $resull = mysql_query($sqll, $conn);
    $r = mysql_fetch_array($resull);
// $sql = "select *
// FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
// inner join booklist bl on bd.bl_id = bl.bl_id
// inner join book b on b.b_id = bl.b_id
// inner join bookcategory bc on bc.bc_id = b.bc_id    
// inner join member m on m.m_id = bw.m_id ";
// $result = mysql_query($sql,$conn);
if(empty($_SESSION['shopping_cart'])){
    // echo"<script language=\"javascript\">";
    // echo"alert('หนังสือเล่มนี้ถูกสมาชิกนี้ยืมอยู่แล้ว');";
    // echo"window.location = 'frm_addborrowing.php';";
    // echo"</script>"; 
    echo error_h3("กรุณาเลือกรายการหนังสือ");
    return;
}else{
    foreach($_SESSION['shopping_cart'] as $bl_id){
    $sql5 = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id 
                        inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['shopping_cart'][$bl_id]."'";
    $result5 = mysql_query($sql5,$conn);
    $row5 = mysql_fetch_array($result5);

    // $cart = is_array($_SESSION['shopping_cart']) ? count($_SESSION['shopping_cart']) : 0;
    // // $result1 = mysql_query($cart,$conn);
    // // $record1=mysql_fetch_array($cart);
    // // $lending=$record1[0];
    // echo $cart;
    // $sqllending="SELECT COUNT(bd.bl_id) FROM borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  WHERE bd.bl_id='$bl_id'  AND bd.bd_status='1' ";
    // $result1 = mysql_query($sqllending,$conn);
    // $record1=mysql_fetch_array($result1);
    // $lending=$record3[0];
// echo $lending."ฟฟฟฟฟ"."<br>";
    // $sqlcart = "SELECT COUNT(bl_id) FROM booklist  where bl_id='$bl_id'";
    // $querycart = mysql_query($sqlcart,$conn);
    // $record1=mysql_fetch_array($querycart);
    // $lending1=$record1[0];
    // echo $lending1;

    $sqlholding="SELECT COUNT(bw.m_id) FROM borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  WHERE bw.m_id='$m_id' AND bd.bd_status='1'  ";
    $result2 = mysql_query($sqlholding,$conn);
    $record2=mysql_fetch_array($result2);
    $holding=$record2[0];
// echo $holding."ฟฟฟฟฟ"."<br>";
// echo $bl_id;
    
    }
} 
  
echo $holding;
// if($lending>1){
//    echo"<script language=\"javascript\">";
//    echo"alert('หนังสือเล่มนี้ถูกสมาชิกนี้ยืมอยู่แล้ว');";
//    echo"window.location = 'frm_addborrowing.php';";
//    echo"</script>";
// }else
    function endprocess(){
        return success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showborrowing.php");  

    }
    // if($record1<=111111){
    //     //    echo"<script language=\"javascript\">";
    //     //    echo"alert('หนังสือเล่มนี้ถูกสมาชิกนี้ยืมอยู่แล้ว');";
    //     //    echo"window.location = 'frm_addborrowing.php';";
    //     //    echo"</script>";
    //        echo error_h3("หนังสือเกินที่กำหนด");
    //        return;
    //     }else
        if($holding>=5){
    //    echo"<script language=\"javascript\">";
    //    echo"alert('หนังสือเกินที่กำหนด');";
    //    echo"window.location = 'frm_addborrowing.php';";
    //    echo"</script>";
        echo error_h3("ยืมหนังสือเกินที่กำหนด");
        return;
       
    }else{
        foreach($_SESSION['shopping_cart'] as $bl_id);
      
       
        if ($_SESSION['shopping_cart'] !=null) {
            $sql = "SELECT * FROM borrowingdetails WHERE bl_id = '$bl_id'  ";
            $result = mysql_query($sql, $conn);
            $total = mysql_fetch_array($result);

                if ("$r[ut_id]" =='4'){
                    $sql4  ="SELECT t.ut_id FROM member m , usertype t where m.ut_id = '$r[ut_id]'";
                    $result4 = mysql_query($sql4,$conn);
                    $total1 = mysql_num_rows($result4);
                    // if ($total1 == 0){

                    $sql1	= "insert into borrowing (bw_date,bw_returndate,m_id,mw_id) VALUES ('$bw_date','$bw_returndate','$m_id','$valid_uname')";
                    $result1 = mysql_query($sql1,$conn);   
                    $bw_id = mysql_insert_id();//คำสั่งให้ FK อ้างถึงกันในกรณี id เป็น Auto
                    foreach($_SESSION['shopping_cart'] as $bl_id){
                    
                        // $sql2 = "select * from book b inner join bookcategory bc on  b.bc_id = bc.bc_id inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['shopping_cart'][$bl_id]."'";     
                        // $result2 = mysql_query($sql2,$conn);   
                        // $row2 = mysql_fetch_array($result2);                                                 
                        
                            $sql3 = "insert into borrowingdetails (bd_status,bw_id,bl_id) VALUES('$bd_status','$bw_id','$bl_id')";
                            $result3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());
                                
                            $sql4 = "Update booklist Set bl_status='$bl_status' Where bl_id='$bl_id'";
                            $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());

                            // if($result1 && $result3){
                                // foreach($_SESSION['shopping_cart'] as $bl_id)
                                // {	
                                    unset($_SESSION['shopping_cart']);

                                // }
                                
                            // } 
                        } 
                    
                    }else{
                        $sql6	= "insert into borrowing (bw_date,bw_returndate,m_id,mw_id) VALUES ('$bw_date','$bw_returndate1','$m_id','$valid_uname')";
                        $result6 = mysql_query($sql6,$conn);   
                        $bw_id = mysql_insert_id();//คำสั่งให้ FK อ้างถึงกันในกรณี id เป็น Auto
                        foreach($_SESSION['shopping_cart'] as $bl_id){
                        
                            // $sql2 = "select * from book b inner join bookcategory bc on  b.bc_id = bc.bc_id inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['shopping_cart'][$bl_id]."'";     
                            // $result2 = mysql_query($sql2,$conn);   
                            // $row2 = mysql_fetch_array($result2);                                                 
                            
                                $sql7 = "insert into borrowingdetails (bd_status,bw_id,bl_id) VALUES('$bd_status','$bw_id','$bl_id')";
                                $result7 = mysql_query($sql7, $conn) or die ("Error in query: $sql7 " . mysql_error());
                                    
                                $sql8 = "Update booklist Set bl_status='$bl_status' Where bl_id='$bl_id'";
                                $result8 = mysql_query($sql8, $conn) or die ("Error in query: $sql8 " . mysql_error());
                            

                                // if($result6 && $result7){
                                    // foreach($_SESSION['shopping_cart'] as $bl_id)
                                    // {	
                                        unset($_SESSION['shopping_cart']);

                                    // }
                                    
                                // }
                            }
                            
                        }
            // }
    //          echo endprocess();
    //  echo success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showborrowing.php"); 
        }
    
   
    echo  "<script>
    $(document).ready(function(){
        Swal.fire({
            title: '<h3>บันทึกข้อมูลเรียบร้อยแล้ว</h3>',
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
</body>
</html>