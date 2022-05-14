<?php
include "connect.php";
include "alert.php";
include 'script.php';
	session_start();

    
	if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])) {
        
        
        $valid_uname = $_SESSION["valid_uname"];
        
	if(isset($_GET['bl_id'])){
        $bl_id = $_GET['bl_id'];  
      }else{
          $bl_id = ""; 
      }
      if(isset($_GET['act'])){
          $act = $_GET['act'];  
        }else{
            $act = ""; 
        }

        $date = date("Y");
        
        $sqllending="SELECT COUNT(bt.bl_id) FROM bookingsdetails bt  WHERE bt.bl_id='$bl_id'  AND bt.dk_status='0' ";
        $result1 = mysql_query($sqllending,$conn);
        $record1=mysql_fetch_array($result1);
        $lending=$record1[0];

        $sqlholding="SELECT COUNT(bk.m_id) FROM bookings bk inner join bookingsdetails bt  on bk.bk_id = bt.bk_id  WHERE bk.m_id='$valid_uname' AND bt.dk_status='0' ";
        $result2 = mysql_query($sqlholding,$conn);
        $record2=mysql_fetch_array($result2);
        $holding=$record2[0];

        $sqlholding3="SELECT COUNT(bk.m_id) FROM bookings bk inner join bookingsdetails bt  on bk.bk_id = bt.bk_id  WHERE bk.m_id='$valid_uname' AND bt.dk_status='2' AND DATE_FORMAT(bk.bk_date,'%Y') = '$date' ";
        $result3 = mysql_query($sqlholding3,$conn);
        $record3=mysql_fetch_array($result3);
        $holding3=$record3[0];
        
        
// if($lending>=1){
//     //   
//             echo"<script language=\"javascript\">";
//             echo"alert('หนังสือเล่มนี้ถูกจองแล้ว');";
//             echo"window.location = 'frm_addbooking.php';";
//             echo"</script>";
            
// }
// else
if($holding3>=10){
    //   
            echo"<script language=\"javascript\">";
            echo"alert('คุณไม่สามารถจองหนังสือได้');";
            echo"window.location = 'frm_addbooking.php';";
            echo"</script>";
            
}
else{


	if($act=='add' && !empty($bl_id))
	{
        
		if(!isset($_SESSION['cart']))
		{
			// $_SESSION['cart']=[];
			$_SESSION['cart'][$bl_id] = $bl_id;
           
           
		}else {
            $i = 0;
            foreach ($_SESSION['cart'] as $x) {
				$i++;
			}
			// echo $i;
			if ($i < 5 ) {
				$_SESSION['cart'][$bl_id] = $bl_id;
				
			}else {
				// echo "11";
				echo"<script language=\"javascript\">";
				echo"alert('จำนวนหนังสือเกินที่กำหนด');";
				echo"window.location ='frm_addbookings.php';";
				echo"</script>";
            }            
		} 

	}

	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['cart'][$bl_id]);
	}
  
}
    // var_dump($_SESSION['cart']) 
   date_default_timezone_set('asia/bangkok');
    $date =  Date("Y-m-d H:i");
   
?>

    <!doctype html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>

        <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
        <?php include "scriptmem.php";
         
        ?>
        <script>
            $(document).on('change', '.custom-file-input', function(event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            })
        </script>
         <link href="jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
         <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <?php include "./h/member_menu.php"; ?>
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3" style="margin-top: 15px">
                <div class="breadcrumb-title pe-3" style="font-size: 23px; "> จัดการข้อมูลการจองหนังสือ</div>

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
            <sup><h6 class="mb-0" style="margin-top: 20px">จัดการเพิ่มข้อมูลการจองหนังสือ</h6></sup>
            <hr>
            <div class="card">
                <div class="card-header" align="center">
                   <h4>เพิ่มข้อมูลการจองหนังสือ</h4>
                </div>
                <div class="card-body">
                <form action="addbookings.php" method="post" enctype="multipart/form-data" style="margin-top: 10px; margin-bottom: 10px;">
                    <table class="table" style="width: 50%; height: 100%"  align="center" >
                        <tbody >
                        <tr>
                            <div class="form-group row" align="center">
                                <span style="padding-left:180px"></span>
                                <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">ชื่อผู้ใช้</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control " value="<?php echo "$rs1[m_name]"; ?>"  readonly>
                                </div>
                            </div>
                        </tr>

                        <tr>
                            <div class="form-group row" align="center">
                                <span style="padding-left:180px"></span>
                                <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">วันที่จอง</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="bk_date" name="bk_date"
                                               value="<?php echo $date; ?>" readonly>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td align="center">
                                <input class="btn btn-success" type="submit" value="บันทึก">  
                            </td>
                        </tr>
                        </tbody>
                    </table>
                        <input name ="act" type="hidden" id="act" value="<?php echo "$_GET[act]"; ?> ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2"></div>
                                <div class="col-md-9">
                                <div class="table-responsive">
                                    <table  width="250%" cellspacing="0" border="0" align="center" class="table table-bordered" id="table">
                                        <div>
                                            <a height="40" colspan="7" align="center" bgcolor="#CCCCCC"><strong><b>รายการหนังสือ</span></strong></a>
                                        </div>	
                                        <thead class="table-secondary">
                                                <tr>
                                                <td>ที่</td>
                                                <td  align="center">รหัสรายการหนังสือ</td>
                                                <td  align="center">ชื่อหนังสือ</td>
                                                <td  align="center">หมวดหมู่</td>
                                                <td  align="center">ลบ</td>
                                                </tr>
                                        </thead>
                                        <tbody>

                                        <?php
										if(!empty($_SESSION['cart'])){
												require_once('connect.php');
		
												$i = 0;
											foreach($_SESSION['cart'] as $bl_id){
												$sql2 = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id 
														inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['cart'][$bl_id]."'";
												$result2 = mysql_query($sql2,$conn);
												$row2 = mysql_fetch_array($result2);
												//while($row = mysql_fetch_array($result)) {
													echo "<tr>";
													echo "<td>";
													echo $i += 1;
													echo ".";
													echo "</td>";
													echo "<td align='center'>" . $row2["bl_id"] . "</td>";
													echo "<td align='center'>"." " . $row2["b_name"] . "</td>";
													echo "<td align='center'>"." " . $row2["bc_name"] . "</td>";
													//remove 
													echo "<td align='center'><a  href='frm_addbookings.php?bl_id=$bl_id&act=remove'><i class='fas fa-trash-alt' style='color:#EC7063'></i></a></td>";
													echo "</tr>";
												//}
											}
										}
									    ?>
                                        <tr>
                                            <td colspan="5" align="right">
                                                <button type="button" name="Submit2"  onclick="window.location='frm_addbooking.php';" class="btn btn-warning"> 
                                                    <span class="glyphicon glyphicon-shopping-cart"> </span><i class="far fa-arrow-alt-circle-left" style="color:#000000"></i> <font color="#000000">กลับไปหน้ารายการหนังสือ</font>  </button>
                                                <button type="button" name="Submit2"  onclick="window.location='delcart.php';"  class="btn btn-danger btndels"> 
                                                    <span class="glyphicon glyphicon-shopping-cart btndels"> </span>ยกเลิก </button>
                                            </td>
                                        </tr>
                                        </tbody>
							        </table>
                                    </div>
                                </div> 
                            </div>
                </form>
               
        </div>
                            </div>
                     </div>

                </div>
            </div>
        <!-- </div>
    </div> -->
    
    <script type="text/javascript" src="jquery-ui/jquery.js"></script>
    <script type="text/javascript" src="jquery-ui/jquery-ui.min.js"></script>
    <script src="js/sb-admin-2.js"></script>
  
    <!-- <script>
    $(document).ready(function(){
        
        Swal.fire({
            title: '<h1>ติดจอง</h1>',
            text: '',
            type: 'error',
            //showCancelButton: true,
            confirmButtonColor: '#3085d6',
            //cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง'
          }).then((result) => {
            location.href = 'frm_addbooking.php';
           
          })
    })
    
    </script>  -->
<script>
  $(function() {
     $( "#bl_id" ).autocomplete({
       source: "databook.php",
       minLength:1
     });
  });
</script>
<!-- <script>
    $(document).on('click','.btndels',function(e){
        e.preventDefault();
        $('#table').reset();
    })
</script> -->
     </body>
    </html>

    <?php
    
} else {
    echo "<script>alert('Please Login');window.location='frm_login.php';</script>";
   
  exit();
}
?>