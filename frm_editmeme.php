<?php
include 'connect.php';
include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];
$datenow = date_create(date('Y-m-d'));
	$sql = "select *
	FROM  bookings bk inner join member m on m.m_id = bk.m_id 
	inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
	inner join booklist bl on bt.bl_id = bl.bl_id
	inner join book b on b.b_id = bl.b_id and bk.m_id = '$valid_uname' where bt.dk_status ='0'";
	$result = mysql_query($sql,$conn);
	$i=0;

	while($row=mysql_fetch_array($result)){
		$bk_id[$i] = $row['bk_id'];
		$dk_id[$i] = $row['dk_id'];
        $bl_id[$i] = $row['bl_id'];
		$bk_status[$i] = $row['dk_status'];
		$bk_date[$i] = date_create($row['bk_date']);
		$datediff[$i] = date_diff($datenow,$bk_date[$i]);
		$diff[$i] = $datediff[$i]->format('%a');
		// echo $row['bk_status'];
		// echo  	$diff[$i] ;
		if($diff[$i]>=2){
			// $sql = "DELETE FROM bookings WHERE m_id = '$valid_uname'";
			// mysql_query($sql,$conn)
			// 	or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
			
			$sql2 = "UPDATE bookingsdetails SET dk_status = 2 WHERE dk_id = '$dk_id[$i] '";
			mysql_query($sql2,$conn)
				or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

            $sql2 = "UPDATE booklist SET bl_status = 0 WHERE bl_id = '$bl_id[$i] '";
            mysql_query($sql2,$conn)
            or die("3. ไม่สามารถประมวลผลคำสั่งได้").mysql_error();    
		}
		
        $i++;
	
	}
$sql = "SELECT * FROM member WHERE m_id = '$valid_uname'";
$result = mysql_query($sql, $conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs = mysql_fetch_array($result);
mysql_close();
?>

    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>ข้อมูลส่วนตัว</title>
        <link rel="stylesheet" href="public/css/all.css" type="text/css">
        <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

        <script>
            $(document).on('change', '.custom-file-input', function(event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            })
        </script>
        <?php
        include 'scriptmem.php';
        ?>
    </head>

    <body>
    <?php
    include './h/member_menu.php'
    ?>
    <div class="container-fluid">
        <br>


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><h6>โปรไฟล์</h6></li>
            </ol>
        </nav>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mt-3" align="center">
                                <h4>
                                    <?php $sql2 = "SELECT m.m_name FROM member m where  m.m_id = '$valid_uname'";
                                    $result2 = mysql_query($sql2,$conn);
                                    $rs2 = mysql_fetch_array($result2);
                                    echo "$rs2[m_name]";?></h4>
                                <p class="text-secondary mb-1">
                                    <?php
                                    $sql3 = "SELECT u.ut_name FROM member m inner join usertype u on m.ut_id=u.ut_id  where  m.m_id = '$valid_uname'  ";
                                    $result3 = mysql_query($sql3,$conn);
                                    $rs3 = mysql_fetch_array($result3);
                                    echo "$rs3[ut_name]";
                                    ?>
                                </p>
                                <p class="text-muted font-size-sm" >โรงเรียนวังโป่งศึกษา</p>
                            </div>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">ลงทะเบียนจองหนังสือ</h6>
                                <span class="col-6">
                                <a href="frm_addbooking.php" class="btn btn-primary w-100" style="border-radius: 30px"><i class="fas fa-mouse-pointer"></i> &nbsp;&nbsp;คลิกที่นี่</a>
                            </span>
                            </li>
                        </ul>
                    </div>
<br>
                    <div class="card mb-3">
                       
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><b>สแกนเพื่อรับการแจ้งเตือนคืนหนังสือ</b></h6>
                               
                            </li>
                        </ul>  
                        <div class="card-body">
                        <div class="mt-3" align="center">
                                <div class=" text-muted font-size-sm" > <img src="./img/qrline.jpg" class="card-img w-50" ></div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="col-lg-8">
                    <div class="card mb-3" >
                        <div class="card-body" >


                            <ul class="nav nav-tabs nav-primary mb-0" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">ข้อมูลส่วนตัว</a>
                                </li>
                            </ul>

                            <div class="card-body ">
                                <form action="editmeme.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                    <div class="form-group row">

                                        <label for="colFormLabel" class="col-sm-2 col-form-label">รหัสผู้ใช้</label>
                                        <div class="col">
                                            <input type="text" class="form-control " value="<?php echo "$rs[m_id]"; ?>" name="m_id"  readonly>
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="colFormLabel" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                                        <div class="col">
                                            <input type="text" class="form-control " value="<?php echo "$rs[m_name]"; ?>" name="m_name">
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="colFormLabel" class="col-sm-2 col-form-label">ที่อยู่</label>
                                        <div class="col">
                                <textarea name="m_add" class="form-control"
                                          aria-label="With textarea"><?php echo "$rs[m_add]"; ?></textarea>
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="colFormLabel" class="col-sm-2 col-form-label">ไอดีไลน์</label>
                                        <div class="col">
                                            <input value="<?php echo "$rs[m_idline]"; ?>" name="m_idline" type="text" class="form-control"
                                                   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>

                                    </div>
                                    <div class="form-group row">

                                        <label for="colFormLabel" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                                        <div class="col">
                                            <input value="<?php echo "$rs[m_pass]"; ?>" name="m_pass" type="text" class="form-control"
                                                   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div>

                                    </div>
                                    <br>

                                    <div align="center">
                                        <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
     </body>
    </html>

<?php
mysql_close($conn);