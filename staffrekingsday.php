<?php
include 'check.php';
include 'connect.php';
include 'script.php';

$date = date('Y-m-d');
if(isset($_POST['d_s'])) {
    $d_s = $_POST['d_s'];

}else{
$d_s = ""; 
}

$valid_uname = $_SESSION['valid_uname'];
$sql = "select *
            FROM  bookings bk inner join member m on m.m_id = bk.m_id 
            inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
            inner join booklist bl on bt.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id where bk.bk_date = '$date' or bk.bk_date = '$d_s' ORDER BY bk.bk_id";
$result = mysql_query($sql,$conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();

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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
                <!-- <script>
                    $(document).ready(function() {
                        $('#example').DataTable( {
                            "aaSorting" :[[0,'ASC']],
                        });
                    } );
                </script> -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">รายงานการจองหนังสือประจำวัน</h1>
                        <form id="form1" name="form1" class="form-inline" method="post" action="staffrekingsday.php">
                                <div class="form-group">
                                    <label for="exampleInputName2">วันที่ :</label>
                                    <input type="date" class="form-control" id="datepicker"
                                           name="d_s" placeholder=" select">
                                </div>

                                &nbsp;&nbsp;<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                        </form>
                    </div>


                    <script>
                        $('#datepicker').datepicker({
                            uiLibrary: 'bootstrap',
                            format: "yyyy-mm-dd HH:mm:ss",
                            type : "date"
                        });
                    </script>


                </div>
                <!-- /.container-fluid -->
				  <div class="container-fluid">

                    <!-- Page Heading -->
                   
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายละเอียดข้อมูล</h6>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td width="85" align="center"> รหัสการจอง</td>
                                            <td width="70" align="center">ชื่อหนังสือ</td>
                                            <td width="100" align="center">วันที่จอง</td>
                                            <td width="70" align="center">ชื่อผู้ใช้</td>
                                            <td width="70" align="center">สถานะ</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                        if(isset($_POST['d_s'])) {
                                            $d_s = $_POST['d_s'];
                                        }else{
                                            $d_s = ""; 
                                        }//ตัวแปรวันที่เริ่มต้น

                                    $sql1 = "SELECT * FROM  bookings bk inner join member m on m.m_id = bk.m_id 
                                                    inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
                                                    inner join booklist bl on bt.bl_id = bl.bl_id
                                                    inner join book b on b.b_id = bl.b_id where bk.bk_date = '$d_s' ORDER BY bk.bk_id ASC "
                                    or die("Error:" . mysql_error());

                                    $result1 = mysql_query($sql1, $conn);//ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น

                                    
                                    // $sql2 = "SELECT bt.bk_status FROM  bookings bk inner join member m on m.m_id = bk.m_id 
                                    //                 inner join bookingdetails bt  on bk.bk_id = bt.bk_id  "
                                    // or die("Error:" . mysql_error());
                                    // $result2 = mysql_query($sql2, $conn);//ดูชื่อ ตัวแปรในไฟล์ connect ให้ดีว่า conหรือ condb หรืออย่างอื่น
                                    // $rs2 = mysql_fetch_array($result2);

                                    while ($rs = mysql_fetch_object($result1)) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo"$rs->bk_id";?></td>
                                        <td align="center"><?php echo"$rs->b_name";?></td>
                                        <td align="center"><?php echo"$rs->bk_date";?></td>
                                        <td align="center"><?php echo"$rs->m_name";?></td>
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
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->


</body>
</html>

<?php
mysql_close($conn);
