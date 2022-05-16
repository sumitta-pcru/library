<?php
include 'connect.php';
include 'script.php';
include 'check.php';
// include 'linenotify.php';

$valid_uname = $_SESSION['valid_uname'];


// $sql1 = "select *
// FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
// inner join booklist bl on bd.bl_id = bl.bl_id
// inner join book b on b.b_id = bl.b_id
// inner join bookcategory bc on bc.bc_id = b.bc_id    
// inner join member m on m.m_id = bw.m_id where bd.bd_status='1' ORDER BY bw.bw_returndate ASC ";
// $result1 = mysql_query($sql1,$conn)
// or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

// $i=0;
// while($row = mysql_fetch_array($result1)){
//     // $bw_id[$i] = $row['bw_id'];
//     // $bw_date[$i] = $row['bw_date'];
//     $datenow = date_create(date('Y-m-d'));
//     $bw_returndate[$i] = $row['bw_returndate'];  
//     $date1[$i]=date_create($row['bw_date']);
//     $date2[$i]=date_create($row['bw_returndate']);
//     $diff[$i]=date_diff($datenow,$date2[$i]);
//     $datediff[$i] = $diff[$i]->format('%a');
//     echo $datediff[$i];
    // if($datediff[$i]>7){
    // echo "เลยกำหนด";

    // }
    // else{

    // }
// $i++;
// }

// echo $bw_returndate;
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

  
    <link rel="stylesheet" href="datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/buttons.bootstrap4.min.css">


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
        include 'staff_menu.php'
        ?>

                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">ข้อมูลแจ้งเตือนคืนหนังสือ</h1>
                        <!-- <form id="form1" name="form1" class="form-inline" method="post" action="searchborrwing.php">
                                <div class="form-group">
                                    <input name="search" type="text" id="search"  class="form-control" placeholder="กรุณาใส่ข้อมูล">&nbsp;&nbsp;
                                    <input type="submit"  value="ค้นหา" class="btn btn-primary">
                                   
                                    
                                </div>
                        </form> -->
                    </div>
					
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
                                            <td width="85" align="center"> รหัสการยืม</td>
                                            <td width="100" align="center">ชื่อหนังสือ</td>
                                            <!-- <td width="70" align="center">หมวดหมู่</td> -->
                                            <td width="70" align="center">วันที่ยืม</td>
                                            <td width="100" align="center">กำหนดคืน</td>
                                            <td width="100" align="center">เหลืออีก</td>
                                            <td width="60" align="center">ชื่อผู้ใช้</td>
                                            <td width="70">&nbsp;แจ้งเตือน</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                     $sql = "select *
                                    FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
                                    inner join booklist bl on bd.bl_id = bl.bl_id
                                    inner join book b on b.b_id = bl.b_id
                                    inner join bookcategory bc on bc.bc_id = b.bc_id    
                                    inner join member m on m.m_id = bw.m_id where bd.bd_status='1' ORDER BY bw.bw_returndate ASC";
                                    $result = mysql_query($sql,$conn)
                                    or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

                                    while ($rs1 = mysql_fetch_object($result)) {

                                    $sql1 = "select *
                                    FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
                                    inner join booklist bl on bd.bl_id = bl.bl_id
                                    inner join book b on b.b_id = bl.b_id
                                    inner join bookcategory bc on bc.bc_id = b.bc_id    
                                    inner join member m on m.m_id = bw.m_id where bd.bw_id='".$rs1->bw_id."' and bd.bd_status='1' ORDER BY bw.bw_returndate ASC";
                                    //  echo $sql1;
                                     $result1 = mysql_query($sql1,$conn)
                                     or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
                                     
                                    $sql2 = "select *
                                    FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
                                    inner join booklist bl on bd.bl_id = bl.bl_id
                                    inner join book b on b.b_id = bl.b_id
                                    inner join bookcategory bc on bc.bc_id = b.bc_id    
                                    inner join member m on m.m_id = bw.m_id where bd.bw_id='".$rs1->bw_id."' and bd.bd_status='1' ORDER BY bw.bw_id ASC ";
                                    //  echo $sql1;
                                    $result2 = mysql_query($sql2,$conn)
                                    or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
                                    $rs = mysql_fetch_array($result2);
                                    
                                    $now = date_create(date('Y-m-d'));
                                    $datee=date_create($rs['bw_returndate']);
                                     $i=0;
                                     if($now>$datee){$row = mysql_fetch_array($result1);
                                    
                                         // $bw_id[$i] = $row['bw_id'];
                                         // $bw_date[$i] = $row['bw_date'];
                                         $datenow = date_create(date('Y-m-d'));
                                         // $bw_returndate = $row['bw_returndate'];  
                                         // $date1=date_create($row['bw_date']);
                                         $date2=date_create($row['bw_returndate']);
                                         $datediff=date_diff($datenow,$date2);
                                         $diff = $datediff->format('%a');
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo"$row[bw_id]";?></td>
                                        <td align="center"><?php echo"$row[b_name]";?></td>
                                        <!-- <td align="center"><?php echo"$row[bc_name]";?></td> -->
                                        <td align="center"><?php echo"$row[bw_date]"
                                        
                                        
                                        ;?></td>
                                        <td align="center"><?php echo"$row[bw_returndate]";?></td>

                                      <td align="center">  <?php if($datenow<=$date2){
                                                echo $diff." วัน" ;
                                                }else{
                                                    echo "เกิน ".$diff." วัน" ;
                                                }
                                            ?>
                                         </td>
                                        <td align="center"><?php echo"$row[m_name]";?></td>
                                        <td align="center">
                                            <a class="btn btn-outline-success"  href="line.php?bd_id=<?php echo $rs1->bd_id;?>">
                                            <i class="fab fa-line"></i>
                                        </td>
                                    </tr>

                                        <?php
                                     }
                                    }
                                    ?>
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
    



    
</body>
</html>

<?php
mysql_close($conn);
