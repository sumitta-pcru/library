<?php 
include "connect.php";
include "script.php";
include "alert.php";
include 'check.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

<?php


$valid_uname = $_SESSION['valid_uname'];
// $m_id =$_POST['m_id'];
$br_date = date('Y-m-d');
$br_totalrate = '0';
$rate = '3';
$bd_status = '0';
$bl_status = '0';
$year = date("Y");

if(empty($_SESSION['return'])){
    // echo"<script language=\"javascript\">";
    // echo"alert('หนังสือเล่มนี้ถูกสมาชิกนี้ยืมอยู่แล้ว');";
    // echo"window.location = 'frm_addborrowing.php';";
    // echo"</script>"; 
    echo error_h3("กรุณาเลือกรายการหนังสือ");
    return;
}else{
    function endprocess(){
        return success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showborrowing.php");  

    }  
    $sql1 = "INSERT INTO bookreturn (br_date,br_totalrate,mr_id) VALUES('$br_date','$rate','$valid_uname')";
    $query2 = mysql_query($sql1, $conn) or die ("Error in query: $sql1 " . mysql_error());
    $br_id = mysql_insert_id();
//     foreach ($_SESSION['return'] as $bl_id) {     
      
   
//         $sql3="select * FROM borrowing bw   inner join borrowingdetails bd on bd.bw_id = bw.bw_id inner join member m  on bw.m_id = m.m_id where bd.bl_id= '$bl_id' and bd.bd_status='1' ";
//         $query7= mysql_query($sql3,$conn);
//         $i = 0;
//         while($result3=mysql_fetch_array($query7)){
//             $bl_id[$i] = $result3['bl_id'];
//             $bw_returndate[$i] = $result3['bw_returndate'];
           
      
//         // $sql4="select * FROM borrowing bw   inner join borrowingdetails bd on bd.bw_id = bw.bw_id inner join member m  on bw.m_id = m.m_id where bd.bl_id= '$bl_id[$i] '  and bd.bd_status='1' ";
//         // $query6= mysql_query($sql4,$conn);
//         // $result4=mysql_fetch_array($query6);
    
//     if($br_date>=$bw_returndate[$i]){
//             $sql6 = "INSERT INTO bill (bi_year,br_id) VALUES('$year','$br_id')";
//             $query4 = mysql_query($sql6, $conn) or die ("Error in query: $sql6 " . mysql_error());
//         } 
//         $i++;
//  }    
//  }   
        foreach ($_SESSION['return'] as $bl_id) {     
            $sql="select * FROM borrowing bw   inner join borrowingdetails bd on bd.bw_id = bw.bw_id inner join member m  on bw.m_id = m.m_id where bd.bl_id= '$bl_id' and bd.bd_status='1' ";
            $query= mysql_query($sql,$conn);
            $result=mysql_fetch_object($query);

                // echo $result->bd_id;
                // echo $result->bw_returndate;
                // echo $br_date;
                // echo $result->bw_date;
                // echo $result->m_id; $result->bw_date<

                if($br_date<=$result->bw_returndate){
                

                    
                    $sql3 = "INSERT INTO bookreturndetails (br_id,rate,bd_id) VALUES('$br_id','$br_totalrate','$result->bd_id')";
                    $query3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());

                    $sql4 = "Update borrowingdetails set bd_status ='$bd_status' where bd_id = '$result->bd_id'";
                    $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());

                    $sql5 = "Update booklist set bl_status ='$bl_status' where bl_id = '$bl_id'";
                    $result2 = mysql_query($sql5, $conn) or die ("Error in query: $sql5 " . mysql_error());

                    // if($query2 && $query3){
                    //     foreach($_SESSION['return'] as $bl_id)
                    //     {	
                            unset($_SESSION['return']);

                    //     }
                    // } 

                }else{ 
                    $sql2 ="select ut_rate from  member m inner join usertype ut on m.ut_id=ut.ut_id  where m.m_id ='$result->m_id' ";
                    $query2= mysql_query($sql2,$conn);
                    $result2=mysql_fetch_object($query2);

                    $datenow = date_create(date('Y-m-d'));
                    $bw_returndate = date_create($result->bw_returndate);
                    $datediff = date_diff($datenow,$bw_returndate );
                    $diff = $datediff->format('%a');
                    $sum = $diff  * $result2->ut_rate;
                    // echo $sum;
                    // $sql1 = "INSERT INTO bookreturn (br_date,br_totalrate,m_id,mr_id) VALUES('$br_date','$rate','$m_id','$valid_uname')";
                    // $query2 = mysql_query($sql1, $conn) or die ("Error in query: $sql1 " . mysql_error());

                    // $br_id = mysql_insert_id();
                    $sql3 = "INSERT INTO bookreturndetails (br_id,rate,bd_id) VALUES('$br_id','$sum','$result->bd_id')";
                    $query3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());
                    $rb_id = mysql_insert_id();
                    $sql6 = "INSERT INTO bill (bi_year,rb_id) VALUES('$year','$rb_id')";
                    $query4 = mysql_query($sql6, $conn) or die ("Error in query: $sql6 " . mysql_error());

                    $sql4 = "Update borrowingdetails set bd_status ='$bd_status'   where bd_id = '$result->bd_id'";
                    $result1 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());

                    $sql5 = "Update booklist set bl_status ='$bl_status'  where bl_id = '$bl_id'";
                    $result2 = mysql_query($sql5, $conn) or die ("Error in query: $sql5 " . mysql_error());
                    // if($query2 && $query3){
                    //     foreach($_SESSION['return'] as $bl_id)
                    //     {	
                            unset($_SESSION['return']);

                    //     }
                        
                    // } 
                }
            
            
        // }
    }
// }
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
            location.href = 'showbookreturn.php';
          })
    })
    
    </script>"; 
 mysql_close($conn); 
}

?>
</body>
</html>