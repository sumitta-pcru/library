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
    <link href="datatables/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="datatables/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" type="text/css">
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
                        <div class="container" align="center">
                            <form action="frm_addbook.php" method="post" enctype="multipart/form-data"
                                style="margin-top: 10px;">
                                <!-- Form Name -->
                                <legend>
                                    <center>
                                        <h2><b>เพิ่มข้อมูลหนังสือ</b></h2>
                                    </center>
                                </legend><br>
                                <!-- Text input-->
                                <div class="form-row" style="margin-top: 20px">
                                    <span style="padding-left:370px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">หมวดหมู่</label>
                                        <select class="form-control select2" name="bc_id" id="bc_id">
                                            <?php
                                                        $sql1 = "SELECT * from bookcategory ";
                                                        $result1 = mysql_query($sql1,$conn);
                                                        while ($rs1=mysql_fetch_array($result1)){
                                                            echo "<option value = $rs1[bc_id]>$rs1[bc_name]</option>";
                                                        }
                                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row" >
                                    <span style="padding-left:370px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">ชื่อผู้แต่ง</label>
                                        <select class="form-control select2" name="a_id" id="a_id">
                                            <?php
                                                        $sql1 = "SELECT * from authorname ";
                                                        $result1 = mysql_query($sql1,$conn);
                                                        while ($rs1=mysql_fetch_array($result1)){
                                                            echo "<option value = $rs1[a_id]>$rs1[a_name]</option>";
                                                        }
                                                        ?>
                                        </select>
                                    </div>
                                </div>
                               
                                
                                <div class="form-row" >
                                    <span style="padding-left:370px"></span>     
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">ชื่อหนังสือ</label>
                                        <input type="text" class="form-control" name="b_name" id="b_name"
                                            placeholder="กรุณาใส่ชื่อหนังสือ" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <br>
                                <tr align="center">
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

    <script src="jquery/jquery.min.js"></script>
    <script src="datatables/select2/js/select2.full.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/sb-admin-2.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

    <script src="numlock.js"></script>

</body>

</html>

<?php
mysql_close($conn);