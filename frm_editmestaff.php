<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])) {
    include "connect.php";
    include "script.php";
    $valid_uname = $_SESSION["valid_uname"];
    $sql = "SELECT * FROM member WHERE m_id = '$valid_uname'";
    $result = mysql_query($sql, $conn)
    or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
    $rs = mysql_fetch_array($result);
    mysql_close();
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

        <script>
            $(document).on('change', '.custom-file-input', function(event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            })
        </script>
    </head>

    <body id="page-top">

    <div id="wrapper">
        <?php
        include 'staff_menu.php'
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container" align="center" >
                                <form  action="editmestaff.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;"  >
                                                <legend><center><h2><b>ข้อมูลส่วนตัว</b></h2></center></legend><br>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01"  >รหัสผู้ใช้</label>
                                                        <input value="<?php echo "$rs[m_id]"; ?>" name="m_name" type="text" class="form-control"
                                                               aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly>
                                                    </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ชื่อ-สกุล</label>
                                                    <input value="<?php echo "$rs[m_name]"; ?>" name="m_name" type="text" class="form-control"
                                                           aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" onkeypress="not_number(event)">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">ที่อยู่</label>
                                                    <textarea class="form-control" id="m_add"name="m_add" rows="3"><?php echo "$rs[m_add]";?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ไอดีไลน์</label>
                                                    <input type="text" class="form-control" value="<?php echo "$rs[m_idline]";?>" name="m_idline" id="m_idline" placeholder="กรุณาใส่ไอดีไลน์"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <!-- <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">รหัสผ่าน</label>
                                                    <input type="password" class="form-control"  value="<?php echo "$rs[m_pass]";?>" name="m_pass" id="m_pass"
                                                           placeholder="กรุณาใส่รหัสผ่าน"  aria-describedby="basic-addon1">
                                                </div>
                                            </div> -->
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" align="center">
                                                        <input class="btn btn-success" type="submit" value="บันทึก">
                                                        <input class="btn btn-danger" type="reset" value="ยกเลิก">
                                                    </td>
                                                </tr>
                                    
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

    <script src="numlock.js"></script>

    </body>
    </html>

    <?php
} else {
    echo "<script> alert('Please Login');window.location='frm_login.php';</script>";
    exit();
}
?>