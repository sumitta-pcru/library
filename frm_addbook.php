<?php
include 'connect.php';
include "script.php";
include 'check.php';
    if(isset($_POST['b_name'])){
    $b_name = $_POST['b_name'];  
   }else{
       $b_name = ""; 
   }
   if(isset($_POST['a_id'])){
    $a_id = $_POST['a_id'];  
   }else{
       $a_id = ""; 
   }
   if(isset($_POST['bc_id'])){
    $bc_id = $_POST['bc_id'];  
   }else{
       $bc_id = ""; 
   }
    // $b_name = $_POST['b_name'];
	// $a_id = $_POST['a_id'];
	// $bc_id = $_POST['bc_id'];

    $a = mb_substr($b_name,0,1,'UTF-8');
    $b = $bc_id.$a_id.$a;
    // echo $b;

    $sql = "SELECT * FROM authorname  where  a_id = '$a_id'";
    $result = mysql_query($sql,$conn)
    or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    $rs = mysql_fetch_array($result);

    $sql1 = "SELECT bc_name FROM bookcategory  where  bc_id = '$bc_id'";
    $result1 = mysql_query($sql1,$conn)
    or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
    $rs1 = mysql_fetch_array($result1);
    $c = $rs1["bc_name"];
        // $c = $rs1->bc_id;
        // echo "$rs1[bc_name]";
        // echo $c;
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
                            <form action="addbook.php" method="post" enctype="multipart/form-data"
                                style="margin-top: 10px;">
                                <!-- Form Name -->
                                <legend>
                                    <center>
                                        <h2><b>เพิ่มรายละเอียดข้อมูลหนังสือ</b></h2>
                                    </center>
                                </legend><br>
                                <!-- Text input-->
                                <div class="form-row" style="margin-top: 20px">
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">รหัสหนังสือ</label>
                                        <input type="text" class="form-control"value="<?php echo $b; ?>" name="b_id" id="b_id" placeholder="กรุณาใส่ชื่อหนังสือ"
                                                           aria-describedby="basic-addon1"  readonly>
                                    </div>
                                    <span style="padding-left:150px"></span>

                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault02">รหัส ISBN</label>
                                        <input type="text" class="form-control" name="b_isbn" id="b_isbn"
                                            placeholder="กรุณาใส่รหัส ISBN" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">ชื่อหนังสือ</label>
                                        <input type="text" class="form-control"  value="<?php echo $b_name;?>" name="b_name" id="b_name"
                                             aria-describedby="basic-addon1" readonly>
                                    </div>
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">ชื่อผู้แต่ง</label>
                        
                                        <input type="text" class="form-control"  value="<?php echo "$rs[a_name]";?>"
                                             aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault02">ปีที่พิมพ์</label>
                                        <input type="text" class="form-control" name="b_year" id="b_year"
                                            placeholder="กรุณาใส่ปีที่พิมพ์" aria-describedby="basic-addon1"
                                            onkeypress="number(event)">
                                    </div>
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault02">ชื่อผู้แต่งร่วมคนอื่น</label>
                                        <input type="text" class="form-control" name="othername" id="othername"
                                            placeholder="ชื่อผู้แต่งร่วมคนอื่น" aria-describedby="basic-addon1"
                                            onkeypress="number(event)">
                                    </div>
                                    </div>
                                    <div class="form-row">
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">สถานที่พิมพ์</label>
                                        <select class="form-control select2" name="lo_id" id="lo_id">
                                            <?php
                                                        $sql1 = "SELECT * from printlocation ";
                                                        $result1 = mysql_query($sql1,$conn);
                                                        while ($rs1=mysql_fetch_array($result1)){
                                                            echo "<option value = $rs1[lo_id]>$rs1[lo_name]</option>";
                                                        }
                                                        ?>
                                        </select>
                                    </div>
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault02">ราคา</label>
                                        <input type="text" class="form-control" name="b_price" id="b_price"
                                            placeholder="กรุณาใส่ราคา" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">จำนวนเล่ม</label>
                                        <input type="text" class="form-control" name="b_num" id="b_num"
                                            placeholder="กรุณาใส่จำนวนเล่ม" aria-describedby="basic-addon1">
                                    </div>
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">ชื่อหมวดหมู่</label>
                        
                                        <input type="text" class="form-control"  value="<?php echo $c;?>"
                                             aria-describedby="basic-addon1" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <!-- <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                    <input type="text" class="form-control"  value="<?php echo $rs1->bc_id;?>" 
                                             aria-describedby="basic-addon1" readonly>
                                    </div> -->
                                    
                                </div>
                                <div class="form-row">
                                    <span style="padding-left:150px"></span>
                                    <div class="col-md-4 mb-3" align="left">
                                        <label for="validationDefault01">รูปภาพ</label>
                                        <input type="file" class="custom-file" name="photo" id="photo">
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
                                                        <input hidden="a_id" type="hidden" name="a_id" value="<?php echo $a_id;?>">
                                                        <input hidden="bc_id" type="hidden" name="bc_id" value="<?php echo $bc_id;?>">

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