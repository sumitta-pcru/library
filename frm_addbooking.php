<?php
include 'connect.php';

include 'check.php';
$valid_uname = $_SESSION['valid_uname'];
$sql = "SELECT * FROM member WHERE m_id = '$valid_uname'";
$result = mysql_query($sql, $conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs = mysql_fetch_array($result);
mysql_close();

   

?>

    <!doctype html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>

        <link rel="stylesheet" href="datatables/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="datatables/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="datatables/css/buttons.bootstrap4.min.css">

  
        <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
        <?php include "scriptmem.php"; ?>
        <script>
            $(document).on('change', '.custom-file-input', function(event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            })
        </script>
         <link href="jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <?php include "./h/member_menu.php"; ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"  style="margin-top: 15px">
                        <div class="breadcrumb-title pe-3" style="font-size: 23px; "> รายการหนังสือ</div>
                            <div class="ps-3">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 p-0">
                                        <li class="breadcrumb-item active" aria-current="page">
                                            จัดการเพิ่มข้อมูลการจองหนังสือ
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                    </div>
                </div>
            </div>    
            <sup><h6 class="mb-0" style="margin-top: 20px">จัดการเพิ่มข้อมูลการจองหนังสือ</h6></sup>
            <div class="container">
                <div class="row justify-content-center ">
                        <div class="col-md-4 ">       
                            <form id="form1" name="form1"  method="post" action="searchrebook.php">
                                <div class="form-group row">
                                    <div class="input-group mr-2">
                                        <input name="search" type="text" id="search"  class="form-control d-block" placeholder="ค้นหาหนังสือ">&nbsp;&nbsp;
                                        <input type="submit"  value="ค้นหา" class="btn btn-primary  d-block">
                                                    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 ">
                            <form id="form2" name="form2"  method="post" action="searchrecate.php">
                                <div class="form-group row">
                                    <div class="input-group">
                                        <select class="custom-select mr-2" name="bc_id" id="bc_id" >
                                            <?php
                                                $sql2 = "SELECT * from bookcategory ";
                                                $result2 = mysql_query($sql2,$conn);
                                                    while ($rs2=mysql_fetch_array($result2)){
                                                        echo "<option value = \"$rs2[bc_id]\" ";
                                                    if ("$rs2[bc_id]") {echo'selected';}
                                                        echo ">$rs2[bc_name]";
                                                        echo "</option>\n";
                                                    }
                                            ?>
                                        </select>
                                            <input type="submit"   value="ค้นหา" class="btn btn-primary mr-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                            
                        <div class="col-md-4">
                           
                                <div class="form-group row">
                                    <div class="input-group">
                                <a class="btn btn-dark btn-block" href="frm_addbookings.php"><i class="far fa-list-alt "></i> รายการที่เลือก</a>
                                </div>
                                </div>
                          
                        </div>
                </div>
            </div>
            <br>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table">
                            <form method="post">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <?php
                                        $sql = "select *
                                            FROM book b join bookcategory bc on  b.bc_id = bc.bc_id 
                                            inner join booklist bl on bl.b_id = b.b_id where bl.bl_status = '0' ";
                                        $result = mysql_query($sql,$conn);
                                    ?>
                                    <div class="row row-cols-1 row-cols-md-4 g-4">
                                        <?php
                                            while ($row = mysql_fetch_object($result)) {
                                        ?>           
                                            <div class="col mb-5">
                                                <div class="card h-100">
                                                    <p class="card-header text-center"><strong><?php echo"$row->b_name";?></strong></p>
                                                        <div class="d-flex justify-content-center mt-4">
                                                            <img src="./picture/<?php echo $row->b_pic; ?>" class="card-img-top w-50" alt="...">

                                                        </div>
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title"><?php echo"$row->bl_id";?></h5>
                                                
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <a class="btn btn-success col-3"  href="frm_addbookings.php?bl_id=<?php echo $row->bl_id;?>&amp;act=add"><i class="fas fa-plus-circle"></i> </a>
                                                        </div>
                                                </div>
                                            </div>        
                                        <?php
                                            }
                                        ?>
                                    </div>                             
                                </table>
                            </form>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>

 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="datatables/js/dataTables.responsive.min.js"></script>
    <script src="datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="datatables/js/dataTables.buttons.min.js"></script>
    <script src="datatables/js/buttons.bootstrap4.min.js"></script>
    <script src="datatables/js/buttons.html5.min.js"></script>
    <script src="datatables/js/buttons.print.min.js"></script>
    <script src="datatables/js/buttons.colVis.min.js"></script>
    <script src="showdatatables.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->
     </body>
    </html>

<?php

mysql_close($conn);