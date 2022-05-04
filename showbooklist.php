<?php
include 'connect.php';
include 'script.php';
include 'check.php';
// $b_id = $_GET['b_id'];
if(isset($_GET['b_id'])){
    $b_id = $_GET['b_id'];
}else{
    $b_id = ""; 
}
$sql = "select bl.bl_id,bl.b_date,b.b_name,bl.bl_status 
            FROM booklist bl inner join book b
            on  bl.b_id = b.b_id 
            where bl.b_id = '$b_id'";
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
        include 'admin_menu.php'
        ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

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
                                            <td width="70" align="center">รหัสรายการหนังสือ</td>
                                            <td width="70" align="center">ชื่อหนังสือ</td>
                                            <td width="70" align="center">วันที่รับล่าสุด</td>
                                            <td width="70" align="center">สถานะ</td>
                                            <td width="70" align="center"></td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    while ($rs1 = mysql_fetch_object($result)) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo"$rs1->bl_id";?></td>
                                            <td align="center"><?php echo"$rs1->b_name";?></td>
                                            <td align="center"><?php echo"$rs1->b_date";?></td>  
                                            <td align="center"><?php
                                                if($rs1->bl_status==0){
                                                    echo "ปกติ";
                                                }elseif ($rs1->bl_status==1){
                                                    echo "ยืม";
                                                }elseif ($rs1->bl_status==2){
                                                    echo "ชำรุด";
                                                }
                                                else{
                                                    echo "สูญหาย";
                                                }
                                                ?>

                                            </td>
                                            <td align="center">

                                                <a class="btn btn-warning"  href="frm_editbooklist.php?bl_id=<?php echo $rs1->bl_id;?>">
                                                    <i class="fas fa-pen"></i> แก้ไข
                                                </a>
                                                <a class="btn btn-danger" href="frm_debooklist.php?bl_id=<?php echo $rs1->bl_id;?>">
                                                    <i class="fas fa-trash-alt"></i> ลบ
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


