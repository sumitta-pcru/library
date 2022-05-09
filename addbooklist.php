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
    // $datestart1 = date('1');
    // $datestart2 = date('1');
    // $datestart3 = date('1');
    // $datestart4 = date('1');

    $monthend1 = date('05');
    $monthend2 = date('09');

    $monthend3 = date('11');
    $monthend4 = date('03');

    $bl_id = $_POST['bl_id'];
    $b_id = $_POST['b_id'];
    $bl_status = '0';
    $new_status1 = '1';
    $new_status = '0';
    // $b_date = $_POST['b_date'];
    // $b_date = '2022-05-30';
    // $date1 = date("Y"); 
    // echo $b_date;
    // echo $datestart1.$date1;
    $a = new DateTime($_POST['b_date']);
    $b_date =$a->format('Y-m-d');


    $sql5 ="SELECT b_num FROM book where b_id = '$b_id'";
    $query = mysql_query($sql5,$conn);
    $rs = mysql_fetch_array($query);
    
    $sum = 0;  
    $sum = $rs["b_num"] + 1;

	if ($bl_id!= NULL ) {

		$sql = "SELECT * FROM booklist where bl_id = '$bl_id' ";
		$result = mysql_query($sql,$conn);
		$total = mysql_fetch_array($result);
        
        if($total == 0){
           
            $date = substr($b_date,8);
            $month = substr($b_date,5,-3);
            // echo $date;
            //  echo $month;
          
            if(($month>=$monthend1) && ($month<=$monthend2)){
                // echo "datestart1";
                $sqlup1 = "UPDATE booklist SET new = '$new_status' WHERE MONTH(b_date)  NOT BETWEEN $monthend1 AND  $monthend2";
                $result1 = mysql_query($sqlup1 , $conn) or die ("Error in query: $sqlup1 " . mysql_error());

                $sqlup3 = "UPDATE book SET b_num = '$sum' WHERE b_id ='$b_id'";
                $result3 = mysql_query($sqlup3 , $conn) or die ("Error in query: $sqlup3 " . mysql_error());

                $sql1 = "INSERT INTO booklist (bl_id,bl_status,b_date,b_id,new) VALUES('$bl_id','$bl_status','$b_date','$b_id','$new_status1')"; 
                $result1 = mysql_query($sql1, $conn) or die ("Error in query: $sql1 " . mysql_error());
                echo success_h3("บันทึกข้อมูลเรียบร้อยเเล้ว", "showbook.php");
            }elseif(($month>=$monthend3) || ($month<=$monthend4)){
                echo "datestart2";
                $sqlup2 = "UPDATE booklist SET new = '$new_status' WHERE MONTH(b_date) BETWEEN $monthend1 AND  $monthend2";
                $result2 = mysql_query($sqlup2 , $conn) or die ("Error in query: $sqlup2 " . mysql_error());
    
                $sqlup4 = "UPDATE book SET b_num = '$sum' WHERE b_id ='$b_id'";
                $result4 = mysql_query($sqlup4 , $conn) or die ("Error in query: $sqlup4 " . mysql_error());


                $sql2 = "INSERT INTO booklist (bl_id,bl_status,b_date,b_id,new) VALUES('$bl_id','$bl_status','$b_date','$b_id','$new_status')"; 
                $result2 = mysql_query($sql2, $conn) or die ("Error in query: $sql2 " . mysql_error());
                echo success_h3("บันทึกข้อมูลเรียบร้อยเเล้ว", "showbook.php");
            }
        }else {
            echo error_h3("ข้อมูลซ้ำ");
            return;
        }
        
    }
    else{
        echo error_h3("กรุณาป้อนข้อมูลให้ครบ");
		return;
}


    ?>
</body>
</html>