<?php

include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];

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
    <!-- <link href="css/form-control.css" rel="stylesheet" type="text/css"/> -->
    <!-- Custom styles for this template-->
   
    <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <!-- <script>
        .form-control {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: .375rem .75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out
}
    </script> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

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
                        <div class="container" align="center">
                            <form action="addbookre.php" method="post" enctype="multipart/form-data"
                                style="margin-top: 10px;">


                                <tr>
                                    <legend>
                                        <center>
                                            <h2><b>เพิ่มข้อมูลการคืน</b></h2>
                                        </center>
                                    </legend><br>
                                  
                                        
                                        <div class="form-group row" align="center">
                                        <span style="padding-left:100px"></span>
                                        <label for="colFormLabel"
                                            class="col-sm-2 ml-md-5 col-form-label">ชื่อรายการหนังสือ</label>
                                        <div class="col-sm-6">
                                            <select class="form-control select2" name="bl_id" id="bl_id">
                                                <i class="fas fa-users"></i>
                                                <?php
                                                $sql1 = "select *
                                                FROM borrowing bw   inner join borrowingdetails bd on bd.bw_id = bw.bw_id  
                                                inner join booklist bl on bd.bl_id = bl.bl_id
                                                inner join book b on b.b_id = bl.b_id  
                                                inner join member m on m.m_id = bw.m_id where  bd.bd_status = '1' ";
                                                $result1 = mysql_query($sql1, $conn);
                                                while ($rs1 = mysql_fetch_array($result1)) {
                                                    echo "<option value = $rs1[bl_id]>$rs1[bl_id]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </tr>

                                <tr align="center">
                                    <td>
                                        <button class="btn btn-success" type="submit" >เพิ่ม</button>

                                    </td>
                                </tr>
                                <input name="act" type="hidden" id="act" value="add">
                            </form>

                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="table-responsive" style="margin-top: -20px;">
                                <div class="container">
                                <form  action="addreturn.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row" align="center">
                                            <span style="padding-left:100px"></span>
                                            <label for="colFormLabel"class="col-sm-2 ml-md-5 col-form-label">ชื่อผู้ใช้</label>
                                            <div class="col-sm-6" >

                                                <select class="form-control select2" name="m_id" id="m_id" >
                                                    <i class="fas fa-users"></i>
                                                    <?php
                                                    $sql1 = "SELECT * from member where m_id  ";
                                                    $result1 = mysql_query($sql1, $conn);
                                                    while ($rs1 = mysql_fetch_array($result1)) {
                                                        echo "<option value = $rs1[m_id]>$rs1[m_name]</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div align="center">
                                            <td align="center">
                                                <button class="btn btn-primary" type="submit" >บันทึก</button>
                                                <button type="button" name="Submit2"
                                                    onclick="window.location='delbookre.php';" class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-shopping-cart"> </span> ยกเลิก
                                                </button>
                                            </td>
                                        </div>
                                       
                                    
                                    <table width="250%" cellspacing="0" border="0" align="center"
                                        class="table table-bordered" style="margin-top: 20px;">

                                        <div style="margin-top: 5px;">
                                            <a height="40" colspan="7" align="center"
                                                bgcolor="#CCCCCC"><strong><b>รายการหนังสือ</span></strong></a>
                                        </div>
                                        <thead class="table-secondary">
                                            <tr>
                                                <td>ที่</td>
                                                <td align="center">รหัสรายการหนังสือ</td>
                                                <td align="center">ชื่อหนังสือ</td>
                                                
                                                <td align="center">ลบ</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($_SESSION['return'])) {
                                                require_once('connect.php');
                                                $i = 0;
                                                
                                                foreach ($_SESSION['return'] as $bl_id) {
                                                    
                                                    $sql2 = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id 
                                                    inner join booklist bl on bl.b_id = b.b_id where bl_id='". $_SESSION['return'][$bl_id] ."'";
                                                    $result2 = mysql_query($sql2, $conn);
                                                    $row2 = mysql_fetch_array($result2);
                                                    // $bd_id = $row2['bd_id'.$i];
                                                    // $bl_id[$i] = $row2['bl_id'];
                                                    // echo $bl_id;
                                                    // echo  $_SESSION['return'][$bl_id];
                                                    // echo "<br>";
                                                    // echo "$row2[bw_id]";
                                                    // echo "<br>";
                                                    // echo "$row2[bd_id]";
                                                    // echo "<br>";
                                                    // echo "$row2[bw_date]";
                                                    // echo "<tr>";
                                                    echo "<td>";
                                                    echo $i += 1;
                                                    echo ".";
                                                    echo "</td>";
                                                    echo "<td align='center'>" . $row2["bl_id"] . "</td>";
                                                    echo "<td align='center'>" . " " . $row2["b_name"] . "</td>";
                                                   
                                                    echo "<td align='center'><a  href='deletebookre.php?bl_id=$bl_id&act=remove'><i class='fas fa-trash-alt' style='color:#EC7063'></i></a></td>";
                                                    echo "</tr>";
                                            }  
                                           
                                             } ?>
                                        </tbody>
                                    </table>
                                    <!-- <input name="act" type="hidden" id="act" value="act"> -->
                                </form>

                                </div>
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
        <script src="jquery/jquery.min.js"></script>
        <script src="datatables/select2/js/select2.full.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

       
        <!-- <script src="datatables/select2-bootstrap4-theme/select2-bootstrap4.min.js"></script> -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

        <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
        <!-- Core plugin JavaScript-->
        <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.js"></script>



        <!-- Page level plugins -->
        <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

        <!-- Page level custom scripts -->
        <!-- <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <script type="text/javascript" src="jquery-ui/jquery.js"></script>
        <script type="text/javascript" src="jquery-ui/jquery-ui.min.js"></script> -->

        <!-- <script>
    $(document).ready(function() {
        document.getElementById('m_id').select2();
    // $('.select2').select2();
});
</script> -->
        
        <script>
           $(document).ready(function() {
            $('.select2').select2();
            });
        </script>
</body>

</html>

<?php
mysql_close($conn);