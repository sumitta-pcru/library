<?php
include 'connect.php';
include 'script.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];

// if(isset($_POST['d_s'])) {
//     $d_s = $_POST['d_s'];

// }else{
// $d_s = ""; 
// }


$sql = "select *
            FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
            inner join booklist bl on bd.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id
            inner join bookcategory bc on bc.bc_id = b.bc_id    
            inner join member m on m.m_id = bw.m_id  where bd.bd_status=1 ";
            // group by bw.bw_id 
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();

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
                        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 20px">เพิ่มการคืนหนังสือ</h1>
                        <form  class="form-inline" method="post" >
                                <div class="form-group">
                                          <button type="submit" name="submit" id="submit"  class="btn btn-warning"> 
                                          <span class="glyphicon glyphicon-shopping-cart"> </span><i class="far fa-arrow-alt-circle-left" style="color:#000"></i> <font color="#000">บันทึก</font>  </button>
                                         
                                   
                                   
                                    
                                </div>
                      
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
                                        <td width="85" align="center"> </td>
                                            <td width="85" align="center"> รหัสหนังสือ</td>
                                            <td width="60" align="center">ชื่อหนังสือ</td>
                                            <td width="60" align="center">ชื่อผู้ใช้</td>
                                            <td width="70" align="center">วันที่ยืม</td>
                                            <td width="100" align="center">กำหนดคืน</td>
                                            <!-- <td width="100" align="center">สถานะ</td> -->
                                            
                                            <td width="70">&nbsp;แจ้งเตือน</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    $i=0;
                                    while ($rs1 = mysql_fetch_object($result)) {
                                    ?>
                                    <tr>
                                    <td align="center"><?php echo $i;?></td>
                                        <td align="center" name="id_bl" id="id_bl"><?php echo"$rs1->bl_id";?></td>
                                        <td align="center"><?php echo"$rs1->b_name";?></td>
                                        <td align="center"><?php echo"$rs1->m_name";?></td>
                                        <td align="center"><?php echo"$rs1->bw_date";?></td>
                                        <td align="center"><?php echo"$rs1->bw_returndate";?></td>
                                        <!-- <td align="center"> -->
                                            <!-- <?php
                                            // if($rs1->bd_status==0){
                                            //     echo "คืนแล้ว";
                                            // }
                                            // else{
                                            //     echo "ยังไม่คืน";
                                            // }
                                            ?> -->
                                        <!-- </td> -->
                                        
                                        <td align="center">
                                        <input type="checkbox" id="bl_id" class="form-control col-sm-9 "  name="bl_id<?php echo $i;?> " value="<?php echo 'bl_id'.$i;?>"
                                                               aria-describedby="basic-addon1" >
                                        <!-- <input type="checkbox" id="bl_id" class="form-control col-sm-9 "  name="bl_id<?php echo $i;?> " value="<?php echo "$rs1->bl_id"?>"
                                                               aria-describedby="basic-addon1" > -->
                                            <!-- <a class="btn btn-primary"  href="frm_addbookredetails.php?m_id=<?php echo $rs1->m_id;?>">
                                            <i class="fas fa-reply"></i> ทำการคืน
                                            </a> -->
                                        </td>
                                    </tr>
                                    

                                        <?php
                                        $i++;
                                    }
                                    ?>
                                   
                                    </tbody>
                                </table> 
                                <input name ="bw_id" type="hidden" id="bw_id" value="<?php echo "$rs[bw_id]"; ?> ">
                                   <input name ="sumnum" id="sumnum" type="hidden"  value="<?php echo "$i"; ?> ">
                                </from>
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
    <script>
        $(document).ready(function(){
            $(document).on('click','#submit',function(e){
                e.preventDefault();
                var sumnum = $('#sumnum').val();
                var bl_id = $('#bl_id').val();
                
                for(i=0; i<=sumnum; i++){
                    var blid = bl_id[i]; 
                    if(blid){
                        console.log(blid)
                    }
                }
            })
        });

    </script>
 


    
</body>
</html>

<?php


mysql_close($conn);
