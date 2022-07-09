<?php
include 'connect.php';
include 'script.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];

$datenow = date_create(date('Y-m-d'));
	$sql7 = "select *
	FROM  bookings bk inner join member m on m.m_id = bk.m_id 
	inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
	inner join booklist bl on bt.bl_id = bl.bl_id
	inner join book b on b.b_id = bl.b_id  where bt.dk_status ='0'";
	$result7 = mysql_query($sql7,$conn);
	$i=0;
// and bk.m_id = '$valid_uname'
	while($row=mysql_fetch_array($result7)){
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



$sql = "select *
            FROM  bookings bk inner join member m on m.m_id = bk.m_id 
            inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
            inner join booklist bl on bt.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id where bt.dk_status ='0'";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

  
    <link rel="stylesheet" href="datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/buttons.bootstrap4.min.css">


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include 'staff_menu.php'
        ?>

                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">ข้อมูลการจองหนังสือ</h1>
                        <!-- <form id="form1" name="form1" class="form-inline" method="post" action="searchborrwing.php">
                                <div class="form-group">
                                    <input name="search" type="text" id="search"  class="form-control" placeholder="กรุณาใส่ข้อมูล">&nbsp;&nbsp;
                                    <input type="submit"  value="ค้นหา" class="btn btn-primary">
                                   
                                    
                                </div>
                        </form> -->
                    </div>
					
                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
				  <div class="container-fluid">

                    <!-- Page Heading -->
                   
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายละเอียดข้อมูล</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                           
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <td width="85" align="center"> รหัสการจอง</td>
                                        <td width="100" align="center">วันที่จอง</td>
                                        <td width="70" align="center">สถานะ</td>
                                        <td width="70" align="center">ชื่อหนังสือ</td>
                                        <td width="70" align="center">ชื่อผู้ใช้</td>
                                        <td width="70">&nbsp;</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    while ($rs = mysql_fetch_object($result)) {
                                    ?>
                                    <tr>
                                    <td align="center"><?php echo"$rs->bk_id";?></td>
                                    <td align="center"><?php echo"$rs->bk_date";?></td>
                                    <td align="center"><?php
                                        if($rs->dk_status==0){
                                            echo "จอง";
                                        }elseif ($rs->dk_status==1){
                                            echo "ยกเลิก";
                                        }elseif ($rs->dk_status==2){
                                            echo "ยืม";
                                        }

                                        ?>
                                    </td>
                                    <td align="center"><?php echo"$rs->b_name";?></td>
                                    <td align="center"><?php echo"$rs->m_name";?></td>
                                    <td align="center">
                                        <a class="btn btn-success"
                                            href="frm_addlistkings.php?dk_id=<?php echo $rs->dk_id;?>&amp;m_id=<?php echo $rs->m_id;?>">
                                            <i class="fas fa-check-circle"></i> ทำการยืม
                                        </a>
                                       
                                    </td>
                                    </tr>

                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            
                            </div>
                        </div>
                    </div>
                    <input name ="m_id" type="hidden" id="m_id" value="<?php echo "$rs[m_id]"; ?> ">
                </div>
                <!-- /.container-fluid -->


            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">ยันยืนการออกจากระบบ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">คุณต้องการออกจากระบบใช่หรือไหม</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
  
    <script src="datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="datatables/js/dataTables.responsive.min.js"></script>
    <script src="datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="datatables/js/dataTables.buttons.min.js"></script>
    <script src="datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="datatables/js/buttons.html5.min.js"></script>
    <script src="datatables/js/buttons.print.min.js"></script>
    <script src="datatables/js/buttons.colVis.min.js"></script>
    <script src="showdatatables.js"></script>
    



    
</body>
</html>

<?php
mysql_close($conn);
