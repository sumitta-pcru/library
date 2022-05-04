<?php
include 'check.php';
include 'connect.php';
include 'script.php';

$valid_uname = $_SESSION['valid_uname'];
$thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน",
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม");



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


    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
        include 'staff_menu.php'
        ?>
                <!-- <script>
                    $(document).ready(function() {
                        $('#example').DataTable( {
                            "aaSorting" :[[0,'ASC']],
                        });
                    } );
                </script> -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">รายงานค่าปรับหนังสือรายเดือน</h1>
                        <form id="form1" name="form1" class="form-inline" method="post" action="staffrefinemonth.php">
                            <div class="form-group">
                                <label for="exampleInputName2"> เลือกเดือน &nbsp;</label>
                            <select class="custom-select" name="month_check" id="datepicker" >
                                <?php for($i=1;$i<=12;$i++){ ?>
                                    <option value="<?=sprintf("%02d",$i)?>" <?=((isset($_POST['month_check'])
                                            && $_POST['month_check']==sprintf("%02d",$i)) || (!isset($_POST['month_check'])
                                            && date("m")==sprintf("%02d",$i)))?" selected":""?> >
                                        <?=$thai_month_arr[$i]?>
                                    </option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2">&nbsp;ปี&nbsp;</label>
                            <select class="custom-select" name="year_check" id="datepicker1">
                                <?php
                                $data_year=intval(date("Y",strtotime("-2 year")));
                                ?>
                                <?php for($i=0;$i<=6;$i++){ ?>
                                    <option value="<?=$data_year+$i?>" <?=((isset($_POST['year_check']) && $_POST['year_check']==intval($data_year+$i)) || (!isset($_POST['year_check']) && date("Y")==intval($data_year+$i)))?" selected":""?> >
                                        <?=intval($data_year+$i)+543?>
                                    </option>
                                <?php } ?>
                            </select>
                            </div>
                            &nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="showData" id="showData" <span class="glyphicon glyphicon-search"></span> ค้นหา</button>
                        </form>
                    </div>


                    <script>
                        $('#datepicker').datepicker({
                            uiLibrary: 'bootstrap',
                            format: "yyyy-mm",
                            type : "year"
                        });
                    </script>
                    <script>
                        $('#datepicker2').datepicker({
                            uiLibrary: 'bootstrap',
                            format: "yyyy-mm",
                            type : "year"
                        });
                    </script>



                    <!-- Content Row -->
                </div>
                <!-- /.container-fluid -->
				  <div class="container-fluid">

                    <!-- Page Heading -->
                   
                  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายละเอียดข้อมูล</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <td width="15%" align="center">รหัสการคืน</td>
                                            <td width="35%" align="center">ชื่อหนังสือ</td>
                                            <td width="15%" align="center">ค่าปรับ</td>
                                            <td width="20%" align="center">วันที่เสียค่าปรับ</td>
                                            <td width="20%">&nbsp;</td>

                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    if(!isset($_POST['month_check']) && !isset($_POST['year_check'])){
                                        $date_data_check=date("Y-m-");// จัดรูปแบบปีและเดือนของวันปัจจุบันในรูปแบบ 0000-00-
                                        $num_month_day=date("t"); // หาจำนวนวันของเดืนอ
                                        $use_month_check = $date_data_check;
                                        $start_date_check = $date_data_check."01";
                                        $end_date_check = $date_data_check.$num_month_day;
                                    }else{ // ถ้ามีการส่งข้อมูล เดือนและปี มา ให้ใช้เดือนและปี ของค่าที่ส่งมาเป้นตำกำหนด
                                        $date_data_check=$_POST['year_check']."-".$_POST['month_check']."-"; // จัดรูปแบบปีและเดืนอที่ส่งมาในรูปแบบ 0000-00-
                                        $num_month_day=date("t",strtotime($_POST['year_check']."-".$_POST['month_check']."-01")); // หาจำนวนวันของเดืนอ
                                        $use_month_check = $date_data_check;
                                        $start_date_check = $date_data_check."01";
                                        $end_date_check = $date_data_check.$num_month_day;

                                    }
                                    $sql = "SELECT * FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
                                                        inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
                                                        inner join borrowing bw on bw.bw_id = bd.bw_id 
                                                        inner join booklist bl on bl.bl_id = bd.bl_id                
                                                        inner join book b on b.b_id = bl.b_id 
                                                        inner join bill bi on rd.br_id = bi.br_id  
                                                        where br.br_date>='".$start_date_check."' AND br.br_date<='".$end_date_check."' ORDER BY br.br_id ASC ";
                                    $result = mysql_query($sql,$conn);


                                    while ($rs = mysql_fetch_object($result)) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo"$rs->br_id";?></td>
                                        <td align="center"><?php echo"$rs->b_name";?></td>
                                        <td align="center"><?php echo"$rs->rate	";?></td>
                                        <td align="center"><?php echo"$rs->br_date";?></td>
                                        <td align="center">                   
                                            <a class="btn btn-secondary"  href="staffprintbill.php?rb_id=<?php echo $rs->rb_id;?>">
                                                <i class="fas fa-print"></i> พิมพ์ใบเสร็จ
                                            </a>
                                        </td>
                                    </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

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

