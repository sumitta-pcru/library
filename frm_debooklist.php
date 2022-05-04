<?php
include 'connect.php';
include "script.php";
include 'check.php';
$bl_id = $_GET['bl_id'];
$sql = "select *
            FROM booklist bl inner join book b
            on  bl.b_id = b.b_id 
            where bl.bl_id = '$bl_id'";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result);
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

    <div id="wrapper">
        <?php
        include 'admin_menu.php'
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container" align="center" >
                                        <form  action="deletebooklist.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;"  >

                                                <!-- Form Name -->
                                                <legend><center><h2><b>ลบข้อมูลรายการหนังสือ</b></h2></center></legend><br>
                                                <!-- Text input-->
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">รหัสรายการ</label>
                                                    <input type="text" class="form-control" value="<?php echo "$rs[bl_id]";?>"
                                                           name="bl_id" id="bl_id" placeholder="กรุณาใส่รหัสรายการ"
                                                           aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ชื่อหนังสือ</label>
                                                    <input name="b_name" type="text"  class="form-control" id="b_name" placeholder="กรุณาใส่ชื่อหนังสือ" value="<?php echo "$rs[b_name]";?>"
                                                            aria-describedby="basic-addon1"readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                            <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">วันที่รับล่าสุด</label>
                                                    <input style="size: revert" type="date" class="form-control" id="b_date" name="b_date" placeholder=" select" value="<?php echo "$rs[b_date]";?>"readonly>
                                                </div>
                                                
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">สถานะ</label>
                                                    <input name="bl_status" type="text"  class="form-control" id="bl_status" placeholder="กรุณาใส่ชื่อหนังสือ" value="<?php 
                                                    if("$rs[bl_status]"==0){
                                                        echo "ปกติ";
                                                    }elseif("$rs[bl_status]"==1){
                                                        echo "ยืม";
                                                    }elseif("$rs[bl_status]"==2){
                                                        echo "ชำรุด";
                                                    }elseif("$rs[bl_status]"==3){
                                                        echo "สูญหาย";
                                                    }elseif("$rs[bl_status]"==4){
                                                        echo "สูญหาย";
                                                    }?>"
                                                    readonly>
                                        
                                                </div>
                                            </div>
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" align="center">
                                                        <input class="btn btn-success" type="submit" value="บันทึก">
                                                        <input class="btn btn-danger" type="reset" value="ยกเลิก">
                                                    </td>
                                                </tr>
                                    </div>
                                    </form>
                            </div>
                     </div>
                 </div>
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
    <script src="js/demo/chart-bar-demo.js"></script>

    
    </body>
    </html>

<?php
mysql_close($conn);