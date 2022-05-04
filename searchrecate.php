<?php
include 'connect.php';

include 'check.php';
$valid_uname = $_SESSION['valid_uname'];

$bc_id = $_POST["bc_id"];
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
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3" style="margin-top: 15px">
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
                    <div class="ms-auto" style="margin-top: 10px">
                        <form id="form1" name="form1" class="form-inline" method="post" action="searchrebook.php">
                                        <div class="form-group">
                                           
                                        <input name="search" type="text" id="search"  class="form-control" placeholder="ค้นหาหนังสือ">&nbsp;&nbsp;
                                         <input type="submit"  value="ค้นหา" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;
                                        
                                        </div>
                        </form>
                    </div>
                    <div class="ms-2" style="margin-top: 10px">
                        <form id="form2" name="form2" class="form-inline" method="post" action="searchrecate.php">
                                        <!-- <div class="form-group"> -->
                                         <select class="custom-select" name="bc_id" id="bc_id" >
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
                                        </select>&nbsp;&nbsp;
                                        <input type="submit"   value="ค้นหา" class="btn btn-primary">
                                        <!-- </div> -->
                        </form>
                    </div>
                   
                    <div class="ms-auto" style="margin-top: 10px">
                        <a class="btn btn-dark" href="frm_addbookings.php"><i class="far fa-list-alt"></i> รายการที่เลือก</a>
                    </div>
            </div>
            <sup><h6 class="mb-0" style="margin-top: 20px">จัดการเพิ่มข้อมูลการจองหนังสือ</h6></sup>
            <br>
            <div class="container-fluid">
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table">
                                <form method="post">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    
                                <!-- <div class="row " > -->
                                    <?php
                                        $sql = "select *
                                        FROM book b join bookcategory bc on  b.bc_id = bc.bc_id 
                                        inner join booklist bl on bl.b_id = b.b_id 
                                        LEFT JOIN borrowingdetails bd on bl.bl_id = bd.bl_id 
                                        LEFT JOIN borrowing bw on bd.bw_id = bw.bw_id
                                        where  bl.bl_status BETWEEN '0' AND '1' and bd.bd_status = '1' ";
                                        $result = mysql_query($sql,$conn);
                                        $sql2 = "select *
                                        FROM book b join bookcategory bc on  b.bc_id = bc.bc_id 
                                        inner join booklist bl on bl.b_id = b.b_id
                                        where  bc.bc_id= $bc_id and bl.bl_status BETWEEN '0' AND '1' ";
                                        $result2 = mysql_query($sql2,$conn);

                                        ?>
                                        <div class="row row-cols-1 row-cols-md-4 g-4">
                                        <?php
                                        while ($row1 = mysql_fetch_object($result)) {
                                        while ($row = mysql_fetch_object($result2)) {
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
                                            <?php if($row->bl_status == 0 ){ ?> 
                                                <a class="btn btn-success col-3"  href="frm_addbookings.php?bl_id=<?php echo $row->bl_id;?>&amp;act=add"><i class="fas fa-plus-circle"></i> </a>
                                            <?php } ?>
                                            <?php if($row->bl_status == 1 ){?>
                                                <h6 class="card-title"><?php echo "สามารถจองหนังสือเล่มนี้ได้วันที่ : ".$row1->bw_returndate;?></h6>
                                            <?php } ?>
                                        </div>
                                        </div>
                                    </div>        
                                     <?php
                                    }
                                }
                                    ?>
                                    </div>
                                <!-- </div>    -->
                                                              
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>            
                </div>
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