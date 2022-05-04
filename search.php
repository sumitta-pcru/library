<?php
include 'connect.php';
include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];
$status = $_POST["status"];
$sql = "select *
            FROM book b join bookcategory bc on  b.bc_id = bc.bc_id 
            inner join booklist bl on bl.b_id = b.b_id WHERE bl.bl_status= $status ";
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
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">รายงานหนังสือแยกตามสถานะ</h1>
                        <form id="form1" name="form1" class="form-inline" method="post" action="search.php">
                                <div class="form-group">
                                    <label for="exampleInputName2">สถานะ &nbsp;</label>
                                    
                                        <select class="custom-select" name="status" id="status" style="width: 100px;">
                                          
                                        <option value="0">ว่าง</option>
                                            <option value="1">ยืม</option>
                                            <option value="2">ชำรุด</option>
                                            <option value="3">สูญหาย</option>
                                        </select>&nbsp;&nbsp;
                                        <input type="submit"  value="ค้นหา" class="btn btn-primary">
                                   
                                </div>
                        </form>
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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>

                                        <td width="5" align="center">รหัสรายการหนังสือ</td>
                                        <td width="100" align="center">ชื่อหนังสือ</td>
                                        <td width="10" align="center">รูปภาพ</td>
                                        <td width="10" align="center">หมวดหมู่</td>
                                        <td width="10" align="center">สถานะ</td>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    while ($rs1 = mysql_fetch_object($result)) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo"$rs1->bl_id";?></td>
                                            <td align="center"><?php echo"$rs1->b_name";?></td>
                                            <td align="center">
                                                <?php
                                                if($rs1->b_pic !=""){
                                                    ?>
                                                    <img src="./picture/<?php echo $rs1->b_pic; ?>" width="30%" height="10%">
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td align="center"><?php echo"$rs1->bc_name";?></td>
                                            <td align="center">
                                            <?php
                                                if ($rs1->bl_status == 0) {
                                                    echo "ว่าง";
                                                }elseif($rs1->bl_status == 1) {
                                                    echo "ยืม";
                                                } elseif($rs1->bl_status == 2) {
                                                    echo "ชำรุด";
                                                }else{
                                                    echo "สูญหาย";
                                                }
                                                ?>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>



</body>
</html>

<?php
mysql_close($conn);