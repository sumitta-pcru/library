<?php
include 'connect.php';
include "script.php";
include 'check.php';
$b_id = $_GET['b_id'];
$sql = "SELECT b.b_id,b.b_name,bl.bl_id FROM book b inner join booklist bl on  b.b_id = bl.b_id  where  b.b_id = '$b_id' ORDER BY bl.bl_id DESC LIMIT 1 ";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result);
$id = $rs['bl_id'];
$b_id = $rs['b_id'];

$id_list = substr($id,-2)+1;

if($id_list<=9){
    $a = ".0".$id_list;
}else{
    $a = ".".$id_list;
}
$bl_id = $b_id.$a;
// echo $bl_id;
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
                                        <form  action="addbooklist.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;"  >
                                            <!-- <input hidden="bl_id" type="hidden" name="bl_id" value="<?php echo "$rs[bl_id]"?>"> -->
                                            
                                                <!-- Form Name -->
                                                <legend><center><h2><b>เพิ่มข้อมูลรายการหนังสือ</b></h2></center></legend><br>
                                                <!-- Text input-->
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">รหัสหนังสือ</label>
                                                        <input type="text" disabled="disabled" class="form-control"  value="<?php echo "$rs[b_id]";?>"
                                                                aria-describedby="basic-addon1" readonly>
                                                    </div>
                                            </div>
                                            <!-- <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">รหัส ISBN</label>
                                                    <input name="b_isbn" type="text" disabled="disabled" class="form-control" id="b_isbn" placeholder="กรุณาใส่รหัส ISBN" value="<?php echo "$rs[b_isbn]";?>"
                                                           aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div> -->
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ชื่อหนังสือ</label>
                                                    <input  type="text"  disabled="disabled"  class="form-control" id="b_name" value="<?php echo "$rs[b_name]";?>"
                                                            aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">รหัสรายการ</label>
                                                    <input type="text" class="form-control"
                                                           name="bl_id" id="bl_id" placeholder="กรุณาใส่รหัสรายการ"
                                                           value="<?php echo $bl_id;?>"
                                                                aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <!-- <div class="form-row">
                                            <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">วันที่รับล่าสุด</label>
                                                    <input type="date" class="form-control" id="b_date"
                                                           name="b_date" placeholder=" select" value=""
                                                           onfocus="(this.type='date')"
                                                           onfocusout="(this.type='date')" max=<?php echo date('Y-m-d'); ?>>
                                                </div>
                                            </div>     -->
                                            <!-- <div class="form-row">
                                            <span style="padding-left:370px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">สถานะ</label>
                                                    <select  class="custom-select" name="bl_status" id="bl_status" >
                                                        <option value="0">เก่า</option>
                                                        <option value="1">ใหม่</option>
                                                        
                                                    </select>
                                                </div>
                                            </div> -->
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" align="center">
                                                        <input class="btn btn-success" type="submit" value="บันทึก">
                                                        <input class="btn btn-danger" type="reset" value="ยกเลิก">
                                                    </td>
                                                </tr>
                                    </div>
                                            <input hidden="b_id" type="hidden" name="b_id" value="<?php echo "$rs[b_id]"?>">
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