<?php
include 'connect.php';
include "script.php";
include 'check.php';
$m_id=$_GET['m_id'];
$slq = "select * from member m  where m.m_id = '$m_id' ";
$result1 = mysql_query($slq,$conn)
or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result1);
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
        include 'admin_menu.php'
        ?>

                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Donut Chart -->
                    </div>
                </div>
                <!-- /.container-fluid -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                        <div class="card-body">
                            <div class="table-responsive">
                                    <div class="container" align="center" >
                                        <form  action="editmem.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;"  >
                                                <!-- Form Name -->
                                                <legend><center><h2><b>แก้ไขข้อมูลสมาชิก</b></h2></center></legend><br>
                                                <!-- Text input-->
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:150px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01"  >รหัสผู้ใช้</label>
                                                        <input type="text" class="form-control" value="<?php echo "$rs[m_id]";?>" name="m_id" id="m_id" 
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                <span style="padding-left:150px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault02">ชื่อ-สกุล</label>
                                                        <input type="text" class="form-control"  value="<?php echo "$rs[m_name]";?>" name="m_name" id="m_name" placeholder="กรุณาใส่ชื่อ-สกุล"
                                                               aria-describedby="basic-addon1">
                                                    </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">ที่อยู่</label>
                                                    <textarea class="form-control" id="m_add"name="m_add" rows="3"><?php echo "$rs[m_add]";?></textarea>
                                                </div>
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">วันที่เป็นสมาชิก</label>
                                                    <input style="size: revert" type="date" class="form-control" id="m_date" name="m_date" placeholder=" select" value="<?php echo "$rs[m_date]";?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ไอดีไลน์</label>
                                                    <input type="text" class="form-control" value="<?php echo "$rs[m_idline]";?>" name="m_idline" id="m_idline" placeholder="กรุณาใส่ไอดีไลน์"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">สถานภาพ</label>
                                                    <div style="width: -moz-fit-content" >
                                                        <select class="custom-select" name="m_status" id="m_status">
                                                            <option value="0">ปกติ</option>
                                                            <option value="1">ออก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">รหัสผ่าน</label>
                                                    <input type="password" class="form-control"  value="<?php echo "$rs[m_pass]";?>" name="m_pass" id="m_pass"
                                                           placeholder="กรุณาใส่รหัสผ่าน"  aria-describedby="basic-addon1">
                                                </div>
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">ประเภทผู้ใช้</label>
                                                    <td>
                                                        <select  class="custom-select" name="ut_id" id="ut_id" >
                                                            <?php
                                                            $sql2 = "SELECT * from usertype ";
                                                            $result2 = mysql_query($sql2,$conn);
                                                            while ($rs2=mysql_fetch_array($result2)){
                                                                echo "<option value = \"$rs2[ut_id]\" ";
                                                                if ("$rs[ut_id]"=="$rs2[ut_id]") {echo'selected';}
                                                                echo ">$rs2[ut_name]";
                                                                echo "</option>\n";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
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
                        </div><!-- /.container -->
                </div>
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        function deleteLocation(b_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete ",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "deletebook.php?b_id="+b_id;
                }
            })
        };
    </script>
    </body>
    </html>

<?php
mysql_close($conn);