
<?php
	session_start();
	
	$bl_id = $_GET['bl_id']; 
	$act = $_GET['act'];
 
	if($act=='add' && !empty($bl_id))
	{
		if(!isset($_SESSION['shopping_cart']))
		{
			$_SESSION['shopping_cart']=[];
			
		}else {
			$_SESSION['shopping_cart'][$bl_id] = $bl_id;
			
		} 

	}
 
	if($act=='remove' && !empty($bl_id))  //ยกเลิก
	{
		unset($_SESSION['shopping_cart'][$bl_id]);
	}


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
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this template-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>





    </head>

    <body id="page-top">

    <div id="wrapper">
        <?php
        include 'staff_menu.php'
        ?>
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
					<div align="center" >								
						<h3><b>เพิ่มข้อมูลการยืม</b></h3>
					</div>
						<div class="table-responsive" style="margin-top: 40px" >							
							<form id="frmcart" name="frmcart" method="post" action="?act=update">
									<table class="table table" id="dataTable" width="100%" cellspacing="0" border="0">
									<div>
          <a height="40" colspan="7" align="center" bgcolor="#CCCCCC"><strong><b>รายการหนังสือ</span></strong></a>
</div>	
									<thead class="table-secondary">
										
										<tr>
										<td>ลำดับที่</td>
										<td  align="center">รหัสรายการหนังสือ</td>
										<td  align="center">ชื่อหนังสือ</td>
										<td  align="center">หมวดหมู่</td>
										<td  align="center">ลบ</td>
										</tr>
										</thead>
										<tbody>

									<?php
										if(!empty($_SESSION['shopping_cart'])){
												require_once('connect.php');
		
												$i = 0;
											foreach($_SESSION['shopping_cart'] as $bl_id){
												$sql = "select * from book b join bookcategory bc on  b.bc_id = bc.bc_id 
														inner join booklist bl on bl.b_id = b.b_id where bl_id='".$_SESSION['shopping_cart'][$bl_id]."'";
												$result = mysql_query($sql,$conn);
												$row = mysql_fetch_array($result);
												//while($row = mysql_fetch_array($result)) {
													echo "<tr>";
													echo "<td>";
													echo $i += 1;
													echo ".";
													echo "</td>";
													echo "<td align='center'>" . $row["bl_id"] . "</td>";
													echo "<td align='center'>"." " . $row["b_name"] . "</td>";
													echo "<td align='center'>"." " . $row["bc_name"] . "</td>";
													//remove 
													echo "<td align='center'><a  href='cart.php?bl_id=$bl_id&act=remove'><i class='fas fa-trash-alt'></i></a></td>";
													echo "</tr>";
												//}
											}
										}
									?>
										<tr>
										<td width="200" align="center" ></td>
										<td colspan="4" align="right">
										<a class="btn btn-warning"  href="frm_addbor.php">
										<i class="far fa-arrow-alt-circle-left" style="color:#000000"></i> <font color="#000000">กลับไปหน้ารายการหนังสือ</font> </a>
										<button type="button" name="Submit2"  onclick="window.location='delshop.php';" class="btn btn-danger"> 
                                            <span class="glyphicon glyphicon-shopping-cart"> </span> ยกเลิก </button>
										</tr>
									</tbody>
									</table>
								</form>
						</div>
							<hr>
						<div class="container" align="center" >
							<form  action="addborrowing.php" method="post" enctype="multipart/form-data"  style="margin-top: 10px;" >
								<br>
									<div class="form-row" style="margin-top: 5px" >
										<span style="padding-left:370px"></span>
											<div class="col-md-4 mb-3" align="left">
												<label for="validationDefault01">วันที่ยืม</label>
												<input type="date" class="form-control" id="bw_date" name="bw_date"  placeholder=" select" value="<?php echo date('Y-m-d'); ?>" readonly>
											</div>
									</div>
									<div class="form-row" style="margin-top: 20px">
										<span style="padding-left:370px"></span>
											<div class="col-md-4 mb-3" align="left">
											<label for="validationDefault02">กำหนดคืน</label>
											<input type="date" class="form-control" id="bw_returndate" name="bw_returndate" placeholder=" select" value=""
												onfocus="(this.type='date')"
												onfocusout="(this.type='date')" min=<?php echo date('Y-m-d'); ?>>
											</div>
									</div>
									<div class="form-row" style="margin-top: 20px">
										<span style="padding-left:370px"></span>
											<div class="col-md-4 mb-3" align="left">
											<label for="validationDefault02">ชื่อผู้ใช้</label>
											<select class="custom-select" name="m_id" id="m_id">
											<?php $sql="SELECT * FROM member where m_id";
											$result = mysql_query($sql,$conn);
											while($rs=mysql_fetch_array($result)){ echo"<option value=$rs[m_id]>$rs[m_name]</option>";}
											?>
											</select>
											</div>
									</div>
									<br>
									<tr align="center" >
										<td colspan="2" >
											<input class="btn btn-success" type="submit" value="บันทึก">        
											<input class="btn btn-danger" type="reset" value="ยกเลิก">
										</td>
									</tr>
							</form>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>

</body>
</html>