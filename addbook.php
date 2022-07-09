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

	$b_id = $_POST['b_id'];
    $isbn = $_POST['b_isbn'];
	$b_name = $_POST['b_name'];
	$a_id = $_POST['a_id'];
	$b_year = $_POST['b_year'];
	$lo_id = $_POST['lo_id'];
    $b_num = $_POST['b_num'];
    $b_price = $_POST['b_price'];
    $b_date = date('Y-m-d');
	$othername=$_POST['othername'];
	$bc_id = $_POST['bc_id'];



	$monthend1 = date('05');
    $monthend2 = date('09');

    $monthend3 = date('11');
    $monthend4 = date('03');

    $bl_status = '0';
    $new_status1 = '1';
    $new_status = '0';
    // $b_date = $_POST['b_date'];
    // $b_date = '2022-05-30';
    // $date1 = date("Y"); 
    // echo $b_date;
    // echo $datestart1.$date1;
    
    // $a = new DateTime($b_date);
    // $b_date =$a->format('Y-m-d');

	//$spl = "SELECT *, count(bl.b_id) from booklist bl inner join book b on bl.b_id = b.b_id where bl.b_id = '$b_id' ";
	//$query = mysql_query($sql);
	//$rs = mysql_fetch_array($query);
	
    $fileupload = $_FILES['photo']['tmp_name'];
    $fileupload_name = uniqid().$_FILES['photo']['name'];

	if ($b_year  && $b_num && $b_price  ) {
	
		
			$sql = "SELECT * FROM book WHERE b_id ='$b_id ' or b_name = '$b_name'   ";
			$result = mysql_query($sql,$conn);
			$total = mysql_fetch_array($result);
			if ($total == 0) {
				if ($fileupload != "") {
					if (!is_dir("./picture")) {
						mkdir("./picture");
					}
					copy($fileupload,"./picture/".$fileupload_name);
					$sql = "INSERT INTO book (b_id,b_isbn,b_name,b_year,b_price,b_num,b_pic,b_date,othername,bc_id,lo_id,a_id)
					VALUES ('$b_id','$isbn','$b_name','$b_year','$b_price','$b_num','$fileupload_name','$b_date','$othername','$bc_id','$lo_id','$a_id')";
				}else{
					$sql = "INSERT INTO book (b_id,b_isbn,b_name,b_year,b_price,b_num,b_date,othername,bc_id,lo_id,a_id) 
					VALUES ('$b_id','$isbn','$b_name','$b_year','$b_price','$b_num','$b_date','$othername','$bc_id','$lo_id','$a_id')";
					
				}//nofile
			}else{
				echo error_h3("ข้อมูลซ้ำ", "frm_addbook.php");
			}//$total
			mysql_query($sql,$conn)
			or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
			for($i=1; $i<= $b_num;$i++){
				if($i<=9){
					$isbn_id = $b_id.".0".$i;
				}else if($i>=10){
					$isbn_id = $b_id.".".$i;
				}
				$date = substr($b_date,8);
				$month = substr($b_date,5,-3);

				if(($month>=$monthend1) && ($month<=$monthend2)){
					// echo "datestart1";
					$sqlup1 = "UPDATE booklist SET new = '$new_status' WHERE MONTH(b_date)  NOT BETWEEN $monthend1 AND  $monthend2";
					$result1 = mysql_query($sqlup1 , $conn) or die ("Error in query: $sqlup1 " . mysql_error());
	
					$sql1 = "INSERT INTO booklist (bl_id,bl_status,b_date,b_id,new) VALUES('$isbn_id','$bl_status','$b_date','$b_id','$new_status1')"; 
					$result1 = mysql_query($sql1, $conn) or die ("Error in query: $sql1 " . mysql_error());
					// echo success_h3("บันทึกข้อมูลเรียบร้อยเเล้ว", "showbook.php");
				}else if(($month>=$monthend3) || ($month<=$monthend4)){
					echo "datestart2";
					$sqlup2 = "UPDATE booklist SET new = '$new_status' WHERE MONTH(b_date) BETWEEN $monthend1 AND  $monthend2";
					$result2 = mysql_query($sqlup2 , $conn) or die ("Error in query: $sqlup2 " . mysql_error());
		
					$sql2 = "INSERT INTO booklist (bl_id,bl_status,b_date,b_id,new) VALUES('$isbn_id','$bl_status','$b_date','$b_id','$new_status1')"; 
					$result2 = mysql_query($sql2, $conn) or die ("Error in query: $sql2 " . mysql_error());
					// echo success_h3("บันทึกข้อมูลเรียบร้อยเเล้ว", "showbook.php");
				}

			}//for

	}else{
		echo error_h3("กรุณาป้อนข้อมูลให้ครบ","frm_addbook.php");
		return;
	}
	mysql_close();
	echo success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showbook.php");
			
			
	?>
</body>
</html>

