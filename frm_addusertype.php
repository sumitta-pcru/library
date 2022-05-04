<?php
include 'connect.php';
include "script.php";
include 'check.php';
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

    </head

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
                                        <form  action="addusertype.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;"  >
                                                <!-- Form Name -->
                                                <legend><center><h2><b>เพิ่มข้อมูลประเภทผู้ใช้</b></h2></center></legend><br>
                                                <!-- Text input-->
                                            <div class="form-row" style="margin-top: 20px" >
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">ชื่อประเภท</label>
                                                        <input name="ut_name" id="ut_name" type="text" class="form-control"
                                                               placeholder="กรุณาใส่ชื่อประเภท" aria-label="ชื่อประเภท" aria-describedby="basic-addon1" onkeypress="not_number(event)">
                                                    </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">จำนวนวันที่ยืม</label>
                                                    <input name="ut_date" id="ut_date" type="text" class="form-control"
                                                           placeholder="กรุณาใส่จำนวนวันที่ยืม" aria-label="จำนวนวันที่ยืม" aria-describedby="basic-addon1" onkeypress="number(event)">
                                                </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">อัตราค่าปรับ</label>
                                                    <input name="ut_rate" id="ut_rate" type="text" class="form-control"
                                                           placeholder="กรุณาใส่อัตราค่าปรับ" aria-label="อัตราค่าปรับ" aria-describedby="basic-addon1" onkeypress="number(event)">
                                                </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ระยะเวลาการจอง</label>
                                                    <input name="ut_advance" id="ut_advance" type="text" class="form-control"
                                                           placeholder="กรุณาใส่ระยะเวลาการจอง" aria-label="ระยะเวลาการจอง" aria-describedby="basic-addon1" onkeypress="number(event)">
                                                </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">จำนวนเล่ม</label>
                                                    <input name="ut_num" id="ut_num" type="text" class="form-control"
                                                           placeholder="กรุณาใส่จำนวนเล่ม" aria-label="จำนวนเล่ม" aria-describedby="basic-addon1" onkeypress="number(event)">
                                                </div>
                                            </div>
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" >
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

    <script src="numlock.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    </body>
    </html>

<?php
mysql_close($conn);