<?php 
include "connect.php";
include "script.php";
include "alert.php";
include 'check.php';
error_reporting(E_NOTICE);
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

$br_date = date('Y-m-d');
$br_totalrate = '0';
$rate = '3';
$bd_status = '0';
$bl_status = '0';
$year = date("Y");
$_SESSION['sum'];
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])) {
    include "connect.php";
    // include 'scriptmem.php';
    // include 'script.php';
    function DateThai($date)
        {
            $strYear = date("Y",strtotime($date))+543;
            $strMonth= date("n",strtotime($date));
            $strDay= date("j",strtotime($date));
            $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
            $strMonthThai=$strMonthCut[$strMonth];
            return "$strDay $strMonthThai $strYear";
        }
        $sql1 = "SELECT * FROM member WHERE m_id = '$valid_uname'";
        $result1 = mysql_query($sql1, $conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
        $rs1 = mysql_fetch_object($result1);
if(empty($_SESSION['return'])){

    echo error_h3("กรุณาเลือกรายการหนังสือ");
    return;
}else{
    // function endprocess(){
    //     return success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showborrowing.php");  

    // }  
    $sql1 = "INSERT INTO bookreturn (br_date,br_totalrate,mr_id) VALUES('$br_date','$rate','$valid_uname')";
    $query2 = mysql_query($sql1, $conn) or die ("Error in query: $sql1 " . mysql_error());
    $br_id = mysql_insert_id();

        foreach ($_SESSION['return'] as $bl_id) {     
            $sql="select * FROM borrowing bw   inner join borrowingdetails bd on bd.bw_id = bw.bw_id inner join member m  on bw.m_id = m.m_id where bd.bl_id= '$bl_id' and bd.bd_status='1' ";
            $query= mysql_query($sql,$conn);
            $result=mysql_fetch_object($query);
        //   echo  $_SESSION['sum'] ;
                // echo $result->bd_id;
                // echo $result->bw_returndate;
                // echo $br_date;
                // echo $result->bw_date;
                // echo $result->m_id; $result->bw_date< && $_SESSION['sum']==0 

                if($br_date<=$result->bw_returndate){
                    // echo 'ice';
                    $i = 0;
                    $func ='ice';
                    $sql3 = "INSERT INTO bookreturndetails (br_id,rate,bd_id) VALUES('$br_id','$br_totalrate','$result->bd_id')";
                    $query3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());

                    $sql4 = "Update borrowingdetails set bd_status ='$bd_status' where bd_id = '$result->bd_id'";
                    $result4 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());
                    $rb_id = mysql_insert_id();
                    $sql5 = "Update booklist set bl_status ='$bl_status' where bl_id = '$bl_id'";
                    $result2 = mysql_query($sql5, $conn) or die ("Error in query: $sql5 " . mysql_error());
                            unset($_SESSION['return']);
                }elseif($br_date>=$result->bw_returndate && $_SESSION['sum']!=0 ){
                    $i = 1;
                    $func ='ice2';
                    echo 'ice2';
                    $sql2 ="select ut_rate from  member m inner join usertype ut on m.ut_id=ut.ut_id  where m.m_id ='$result->m_id' limit 1 ";
                    $query2= mysql_query($sql2,$conn);
                    $result2=mysql_fetch_object($query2);

                    $datenow = date_create(date('Y-m-d'));
                    $bw_returndate = date_create($result->bw_returndate);
                    $datediff = date_diff($datenow,$bw_returndate );
                    $diff = $datediff->format('%a');
                    $sum = $diff  * $result2->ut_rate;
                
                    $sql3 = "INSERT INTO bookreturndetails (br_id,rate,bd_id) VALUES('$br_id','$sum','$result->bd_id')";
                    $query3 = mysql_query($sql3, $conn) or die ("Error in query: $sql3 " . mysql_error());
                    $rb_id = mysql_insert_id();
                    $sql6 = "INSERT INTO bill (bi_year,rb_id) VALUES('$year','$rb_id')";
                    $query4 = mysql_query($sql6, $conn) or die ("Error in query: $sql6 " . mysql_error());

                    $sql4 = "Update borrowingdetails set bd_status ='$bd_status'   where bd_id = '$result->bd_id'";
                    $result1 = mysql_query($sql4, $conn) or die ("Error in query: $sql4 " . mysql_error());
                    $rb_id   = mysql_insert_id();
                    $sql5 = "Update booklist set bl_status ='$bl_status'  where bl_id = '$bl_id'";
                    $result2 = mysql_query($sql5, $conn) or die ("Error in query: $sql5 " . mysql_error());
                            unset($_SESSION['return']);
                }
    }
}
if($i==0  &&  $func ='ice'){
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
    unset($_SESSION['sum']);
}else
if($i == 1  &&  $func ='ice2'){
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
            location.href = 'staffprintbill.php?br_id=".$br_id."';
          })
    })
    
    </script>"; 
    unset($_SESSION['sum']);
}
elseif($i == 1 && $i == 0){
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
            location.href = 'staffprintbill.php?br_id=".$br_id."';
          })
    })
    
    </script>"; 
    unset($_SESSION['sum']);
}

 mysql_close($conn); 

}

?>
</body>
</html>