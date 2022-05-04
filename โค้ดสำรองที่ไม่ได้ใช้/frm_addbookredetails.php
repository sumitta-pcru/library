<?php
include 'connect.php';
include 'script.php';
include 'check.php';
$valid_uname = $_SESSION['valid_uname'];

$br_date  = date('Y-m-d');
// $bw_returndate = date("Y-m-d",strtotime("+1 weeks"));
// $bw_returndate1 = date("Y-m-d",strtotime("+15 day"));
// $bd_status = "1";
// $bl_status = "1";
$m_id = $_GET["m_id"];
// $bk_id = $_GET["bk_id"];
// $bk_id=$_GET['bk_id'];
// echo $bk_id;
// echo $m_id;
// if(isset($_GET['dk_id'])){
//    $dk_id = $_GET['dk_id'];  
//   }else{
//       $dk_id = ""; 
//   }
//   if(isset($_GET['m_id'])){
//       $m_id = $_GET['m_id'];  
//     }else{
//          $m_id=""; 
//     }

$sql = "select *
            FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
            inner join booklist bl on bd.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id
            inner join bookcategory bc on bc.bc_id = b.bc_id    
            inner join member m on m.m_id = bw.m_id  where bw.m_id = '$m_id' and bd.bd_status=1 ";
$result = mysql_query($sql,$conn)
or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result);

$sql1 = "select * 
            FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
            inner join booklist bl on bd.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id
            inner join bookcategory bc on bc.bc_id = b.bc_id    
            inner join member m on m.m_id = bw.m_id  where bw.m_id = '$m_id' and bd.bd_status=1";

$result1 = mysql_query($sql1, $conn);



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
                            <div class="row">
                                <div class="col-12">
                                        <form   method="post" enctype="multipart/form-data"  style="margin-top: 10px;" >
                                        <!-- <input name ="dk_id" type="hidden" id="dk_id" value="<?php echo "$rs[dk_id]"; ?> ">
                                       
                                        <input name ="bl_id" type="hidden" id="bl_id" value="<?php echo "$rs[bl_id]"; ?> "> -->
                                                <!-- Form Name -->
                                                <legend><center><h2><b>เพิ่มข้อมูลการยืม</b></h2></center></legend><br>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"style="font-size: 18px"> รหัสผู้ใช้</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" style="font-size: 18px" value="<?php echo "$rs[m_id]";?>" name="m_id" id="m_id" 
                                                               aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"style="font-size: 18px">ชื่อผู้ใช้</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" style="font-size: 18px" value="<?php echo "$rs[m_name]";?>" name="m_id" id="m_id" 
                                                               aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label"style="font-size: 18px">วันที่คืน</label>
                                                <div class="col-sm-9">
                                                <input type="text" class="form-control" style="font-size: 18px" value="<?php echo "$br_date";?>" name="m_id" id="m_id" 
                                                               aria-describedby="basic-addon1" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label" for="validationDefault01" style="font-size: 18px"> <strong>ชื่อหนังสือ :</strong> </label>
                                                    <div class="col-md-3 offset-md-7" >
                                                            <button class="btn btn-info chkll" id="chkall" >เลือกทั้งหมด</button>              
                                                    </div>
                                            </div>  

                                            <?php
                                             $i=0;
                                             $j=1;
                                            while($row=mysql_fetch_array($result1)){
                                                $bl_id = $row['bl_id'];
                                                $b_name[$i] = $row['b_name'];
                                                $bw_returndate[$i] = $row['bw_returndate'];
                                                
                                           
                                            ?>
                                        <div class="row col-md-10" align="left" >
                                            <!-- <div class="col-md-8 mb-1 "  align="left" > -->
                                            <div class="col col-md-8 mb-2" >
                                                <left>
                                                <label class="form-label"  for="validationDefault01" style="font-size: 18px"><?php echo $j.".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['b_name'];?></label>
                                                </left>
                                            </div>
                                            <div class="col-md-auto">
                                            <label class="form-label"  for="validationDefault01" style="font-size: 18px"><?php echo $row['bw_returndate'];?></label>
                                            </div>             
                                            <div class="col col-lg-2">
                                                <input type="checkbox" id="chk" class="form-control col-sm-9 " value="<?php echo $row['bl_id']; ?>"  name="bl_id<?php echo $i ?> "
                                                               aria-describedby="basic-addon1" >
                                            </div>
                                                   
                                                <!-- </div> -->
                                        </div>
                                        
                                            
                                            <?php
                                            $i++;
                                            $j++;


                                            
                                             }
                                            ?>
                                           
                                            <br>
                                                <tr align="center" >
                                                    <td colspan="2" >
                                                        <input class="btn btn-success" type="submit" value="บันทึก">
                                                        <input class="btn btn-danger" type="reset" value="ยกเลิก">
                                                    </td>
                                                </tr>
                                    <!-- </div> --> 
                                    <input name ="bw_id" type="hidden" id="bw_id" value="<?php echo "$rs[bw_id]"; ?> ">
                                    <input name ="summun" id="sumnum" type="hidden"  value="<?php echo "$i"; ?> ">
                                    </form>
                                    </div>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



    <script>
        $(document).ready(function(){
//             // function check_uncheck_checkbox(isChecked) {
//             $(document).on('click','.chkall',function(e){    
//                 var row = $('#sumnum').val();
//                 if(row !=0) {
// 		        $('input[name="bl_id<?php echo $i; ?>"]').each(function() { 
// 			this.checked = true; 
// 		});
// 	} else {
// 		$('#chk').each(function() {
// 			this.checked = false;
// 		});
// 	}
// })
            $(document).on('click','.chkll',function(e){
                e.preventDefault();
                var row = $('#sumnum').val();
                $('#chkall').removeClass();
                $("#chkall").html('ยกเลิกทั้งหมด');
                $('#chkall').addClass("btn btn-danger  uncheck");
               for(i=0; i<=row; i++){
                    $('input[name*="bl_id"]').prop('checked',true);
                    // console.log(i)  
               }
                   
            //    .attr('checked',$(this).is(':checked'));
                
            })

            $(document).on('click','.uncheck',function(e){
                e.preventDefault();
                var row = $('#sumnum').val();
                $('#chkall').removeClass();
                $("#chkall").html('เลือกทั้งหมด');
                $('#chkall').addClass("btn btn-info  chkll");
               for(i=0; i<=row; i++){
                    $('input[name*="bl_id"]').prop('checked',false);
                    // console.log(i)  
               }
                   
            //    .attr('checked',$(this).is(':checked'));
                
            })
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );
        
    });
    </script>
    
    <!-- <script>
        $(document).ready(function(){
            // function check_uncheck_checkbox(isChecked) {
            $(document).on('click','.chkall',function(e){    
                var row = $('#sumnum').val();
                if(row !=0) {
		        $('#chk').each(function() { 
			this.checked = true; 
		});
	} else {
		$('#chk').each(function() {
			this.checked = false;
		});
	}
})
            // $(document).on('click','.chkall',function(e){
            //     e.preventDefault();
            //     var row = $('#sumnum').val();
            //     console.log( $('#sumnum').val())
               
            //         $('input[id*=chk]:checkbox').attr('checked',$(this).is(':checked'));
                
                
            // })
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );
        
    });
    </script> -->


    </body>
    </html>

<?php
mysql_close($conn);
// <!-- <div class="form" style="margin-top: 20px" >
//                                                 <span style="padding-left:370px"></span>
//                                                     <div class="col-md-8 mb-3" align="left">
//                                                         <label for="validationDefault01">ชื่อผู้ใช้</label>
//                                                         <input type="text" class="form-control" value="<?php echo "$rs[m_name]";?>" 
<!-- //                                                                aria-describedby="basic-addon1" readonly>
//                                                     </div>
//                                             </div> --> -->
//                                             <!-- <div class="form" style="margin-top: 20px" >
//                                                 <span style="padding-left:370px"></span>
//                                                     <div class="col-md-8 mb-3" align="left">
//                                                         <label for="validationDefault01">วันที่คืน</label>
//                                                         <input type="text" class="form-control" value="<?php echo "$br_date";?>" 
//                                                                aria-describedby="basic-addon1" readonly>
//                                                     </div>
//                                             </div> -->
//                                             <!-- <div class="form" style="margin-top: 20px" >
//                                                 <span style="padding-left:370px"></span>
//                                                     <div class="col-md-6 mb-3" align="left">
//                                                         <label for="validationDefault01">กำหนดคืน</label>
//                                                         <input type="text" class="form-control" value="<?php echo "$rs[bw_returndate]";?>" 
//                                                                aria-describedby="basic-addon1" readonly>
//                                                     </div>
//                                             </div> -->