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
    // $b_isbn = $_POST['b_isbn'];
	$b_name = $_POST['b_name'];
	$b_author = $_POST['b_author'];
	$b_year = $_POST['b_year'];
	$b_place = $_POST['b_place'];
    $b_num = $_POST['b_num'];
    $b_price = $_POST['b_price'];
    // $b_date = $_POST['b_date'];

	$bc_id = $_POST['bc_id'];

    $fileupload = $_FILES['photo']['tmp_name'];
    $fileupload_name = uniqid().$_FILES['photo']['name'];

	if ($b_id && $b_name && $b_author && $b_year && $b_place && $b_num && $b_price  ) {

		$sql = "SELECT * FROM book WHERE b_id ='$b_id ' or b_name = '$b_name' or b_author = '$b_author' or b_year = '$b_year' or b_place = '$b_place' or b_num = '$b_num' or b_price = '$b_price'  ";
		$result = mysql_query($sql,$conn);
		$total = mysql_fetch_array($result);

		if ($total == 0) {
			if ($fileupload != "") {
				if (!is_dir("./picture")) {
					mkdir("./picture");
				}
                copy($fileupload,"./picture/".$fileupload_name);
				$sql = "INSERT INTO book (b_id,b_name,b_author,b_year,b_place,b_price,b_num,b_pic,bc_id) VALUES ('$b_id','$b_name','$b_author','$b_year','$b_place','$b_price','$b_num','$fileupload_name','$bc_id')";
			} else {
				$sql = "INSERT INTO book (b_id,b_name,b_author,b_year,b_place,b_price,b_num,bc_id) VALUES ('$b_id','$b_name','$b_author','$b_year','$b_place','$b_price','$b_num','$bc_id')";
			}
			mysql_query($sql,$conn)
				or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
		} else {
			echo error_h3("ข้อมูลซ้ำ", "frm_addbook.php");
			return;
		}
	} else {
		
		echo error_h3("กรุณาป้อนข้อมูลให้ครบ");
		return;
	}

	mysql_close();
	echo success_h3("บันทึกข้อมูลเรียบร้อยแล้ว","showbook.php");
	?>
</body>
</html>