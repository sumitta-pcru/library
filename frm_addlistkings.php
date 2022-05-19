<?php
include 'connect.php';
include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];



$bw_date  = date('Y-m-d');
$bw_returndate = date("Y-m-d",strtotime("+1 weeks"));
$bw_returndate1 = date("Y-m-d",strtotime("+15 day"));
$bd_status = "1";
$bl_status = "1";
// $m_id = $_GET["m_id"];
// $bk_id=$_GET['bk_id'];
// echo $bk_id;
// echo $m_id;
if(isset($_GET['dk_id'])){
   $dk_id = $_GET['dk_id'];  
  }else{
      $dk_id = ""; 
  }
  if(isset($_GET['m_id'])){
      $m_id = $_GET['m_id'];  
    }else{
         $m_id=""; 
    }

$slq = "select * FROM  bookings bk inner join member m on m.m_id = bk.m_id 
inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
inner join booklist bl on bt.bl_id = bl.bl_id
inner join book b on b.b_id = bl.b_id  where bt.dk_id = '$dk_id' ";
$result1 = mysql_query($slq,$conn)
or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result1);

$sqll11 = "SELECT t.ut_id FROM member m , usertype t where t.ut_id = m.ut_id and m.m_id = '$m_id'";
// $sqll11 = "SELECT t.ut_id FROM member m, usertype t,bookings bk where t.ut_id = m.ut_id and m.m_id = bk.m_id and bk.m_id = '$m_id' and bk.bk_id = '$bk_id'";
$resull = mysql_query($sqll11, $conn);
$r = mysql_fetch_array($resull);


// echo  $resull;


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
        include 'staff_menu.php'
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container" align="center" >
                                        <form  action="addlistkings.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;" >
                                        <input name ="dk_id" type="hidden" id="dk_id" value="<?php echo "$rs[dk_id]"; ?> ">
                                        <input name ="m_id" type="hidden" id="m_id" value="<?php echo "$rs[m_id]"; ?> ">
                                        <input name ="bl_id" type="hidden" id="bl_id" value="<?php echo "$rs[bl_id]"; ?> ">
                                                <!-- Form Name -->
                                                <legend><center><h2><b>เพิ่มข้อมูลการยืม</b></h2></center></legend><br>
                                                <!-- Text input-->
                                           
                                                <div class="form-row" style="margin-top: 20px" >
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">ชื่อรายการหนังสือ</label>
                                                        <input type="text" class="form-control" value="<?php echo "$rs[b_name]";?>" name="b_id" id="b_id" 
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px" >
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">ชื่อผู้ใช้</label>
                                                        <input type="text" class="form-control" value="<?php echo "$rs[m_name]";?>" 
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px" >
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">วันที่ยืม</label>
                                                        <input type="text" class="form-control" value="<?php echo date('Y-m-d');?>" 
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                            </div>
                                            <div class="form-row" style="margin-top: 20px" >
                                                <span style="padding-left:370px"></span>
                                                    <div class="col-md-4 mb-3" align="left">
                                                        <label for="validationDefault01">กำหนดคืน</label>
                                                        <input type="text" class="form-control" value="<?php 
                                                       if ("$r[ut_id]" =='4'){

                                                        echo $bw_returndate;
                                                    }
                                                    else{
                                                        echo $bw_returndate1;
                                                    }?>" 
                                                               aria-describedby="basic-addon1" readonly>
                                                    </div>
                                            </div>
                                           
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" >
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>




    <script>
        $(document).ready(function(){

            $('#country').typeahead({
                source: function(query, result)
                {
                    $.ajax({
                        url:"fetch.php",
                        method:"POST",
                        data:{query:query},
                        dataType:"json",
                        success:function(data)
                        {
                            result($.map(data, function(item){
                                return item;
                            }));
                        }
                    })
                }
            });

        });
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        
    </script>


    </body>
    </html>

<?php
mysql_close($conn);