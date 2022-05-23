<?php
include 'connect.php';
include "script.php";
include 'check.php';
$b_id = $_GET['b_id'];
$sql = "SELECT * FROM book  b inner join authorname a on b.a_id = a.a_id 
                        inner join bookcategory bc on b.bc_id = bc.bc_id where  b.b_id = '$b_id'";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result);


// $c = $rs1["bc_name"];
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
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                                        <form  action="editbook.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;">
                                            <input name ="b_pic" type="hidden" id="b_pic" value="<?php echo "$rs[b_pic]"; ?>">
                                                <!-- Form Name -->
                                                <legend><center><h2><b>แก้ไขข้อมูลหนังสือ</b></h2></center></legend><br>
                                                <!-- Text input-->
                                            <div class="form-row" style="margin-top: 20px">
                                                <span style="padding-left:150px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01"  >รหัสหนังสือ</label>
                                                        <input type="text" class="form-control" value="<?php echo "$rs[b_id]";?>" name="b_id" id="b_id" placeholder="กรุณาใส่รหัสหนังสือ"
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                <span style="padding-left:150px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault02">รหัส ISBN</label>
                                                        <input type="text" class="form-control" value="<?php echo "$rs[b_isbn]";?>" name="b_isbn" id="b_isbn" placeholder="กรุณาใส่รหัส ISBN"
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">ชื่อหนังสือ</label>
                                                    <input type="text" class="form-control"  value="<?php echo  "$rs[b_name]";?>" name="b_name" id="b_name"
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
                                                    <input type="text" class="form-control" value="<?php echo "$rs[b_year]";?>" name="b_year" id="b_year" placeholder="กรุณาใส่ปีที่พิมพ์"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-0 " align="left">
                                                    <label for="validationDefault01">สถานที่พิมพ์</label>
                                                    <select class="form-control select2" name="lo_id" id="lo_id" >
                                                        <?php
                                                        $sql2 = "SELECT * from printlocation ";
                                                        $result2 = mysql_query($sql2,$conn);
                                                        while ($rs2=mysql_fetch_array($result2)){
                                                            echo "<option value = \"$rs2[lo_id]\" ";
                                                            if ("$rs[lo_id]"=="$rs2[lo_id]")
                                                            {echo'selected';}
                                                            echo ">$rs2[lo_name]";
                                                            echo "</option>\n";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                            <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault02">ราคา</label>
                                                    <input type="text" class="form-control" value="<?php echo "$rs[b_price]";?>" name="b_price" id="b_price" placeholder="กรุณาใส่ราคา"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">ชื่อหมวดหมู่</label>
                                                    <input type="text" class="form-control"  value="<?php echo "$rs[bc_name]";?>"
                                             aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                               <!-- <span style="padding-left:150px"></span>
                                                <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">จำนวนเล่ม</label>
                                                    <input type="text" class="form-control" value="<?php echo "$rs[b_num]";?>" name="b_num" id="b_num"
                                                           placeholder="กรุณาใส่จำนวนเล่ม"  aria-describedby="basic-addon1">
                                                </div> -->
                                                
                                                <!-- <span style="padding-left:150px"></span> -->
                                                <!-- <div class="col-md-4 mb-3" align="left">
                                                    <label for="validationDefault01">วันที่รับล่าสุด</label>
                                                    <input style="size: revert" type="date" class="form-control" id="b_date" name="b_date" placeholder=" select" value="<?php echo "$rs[b_date]";?>">
                                                </div> -->
                                               
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-2 mb-0" align="left">
                                                    <label for="validationDefault01">รูปภาพ</label>
                                                    <td align="center">
                                                        <?php

                                                        if("$rs[b_pic]" !=""){
                                                            ?>

                                                            <img src="<?php echo"./picture/$rs[b_pic]";?>" width="100%" height="55%">
                                                            <?php
                                                        }
                                                        ?>
                                                        <input style="margin-top: 20px" type="file" class="custom-file" name="photo" id="photo" >
                                                </div>
                                                
                                            </div>

                                            <!-- <div class="form-row">
                                                
                                                <span style="padding-left:150px"></span>
                                                <div class="col-md-2 mb-0" align="left">
                                                    <label for="validationDefault01">รูปภาพ</label>
                                                    <td align="center">
                                                        <?php

                                                        if("$rs[b_pic]" !=""){
                                                            ?>

                                                            <img src="<?php echo"./picture/$rs[b_pic]";?>" width="100%" height="55%">
                                                            <?php
                                                        }
                                                        ?>
                                                        <input style="margin-top: 20px" type="file" class="custom-file" name="photo" id="photo" >
                                                </div>
                                            </div> -->
                                            
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