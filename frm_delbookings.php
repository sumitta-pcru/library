<?php
include 'connect.php';
include 'check.php';
$dk_id=$_GET['dk_id'];
$bl_id=$_GET['bl_id'];

$valid_uname = $_SESSION['valid_uname'];
$sql = "select *
           FROM  bookings bk inner join member m on m.m_id = bk.m_id 
           inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
           inner join booklist bl on bt.bl_id = bl.bl_id
           inner join book b on b.b_id = bl.b_id where  bt.dk_id ='$dk_id' ";
$result = mysql_query($sql,$conn)
or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
$rs = mysql_fetch_array($result);

// $sql1 = "select * FROM bookingdetails inner join booklist bl on bt.bl_id = bl.bl_id b on b.b_id = bl.b_id  where  bt.bl_id ='$bl_id' ";
// $result1 = mysql_query($sql1,$conn) or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
// $rs1 = mysql_fetch_array($result1);

// foreach($_SESSION['shopping_cart'] as $bl_id){
//     $sql5 = "select *  FROM  bookings bk inner join member m on m.m_id = bk.m_id 
//     inner join bookingdetails bt  on bk.bk_id = bt.bk_id 
//     inner join booklist bl on bt.bl_id = bl.bl_id
//     inner join book b on b.b_id = bl.b_id where bt.bl_id='".$_SESSION['shopping_cart'][$bl_id]."' ";
//     $result5 = mysql_query($sql5,$conn);
//     $row5 = mysql_fetch_array($result5); }   
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
        <?php include "scriptmem.php"; ?>
        <script>
            $(document).on('change', '.custom-file-input', function(event) {
                $(this).next('.custom-file-label').html(event.target.files[0].name);
            })
        </script>
    </head>
    <body>
    <?php include "./h/member_menu.php"; ?>
    <div class="container-fluid">
        <div class="container-fluid" >
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3" style="margin-top: 15px">
                <div class="breadcrumb-title pe-3" style="font-size: 23px; ">  จัดการข้อมูลการจองหนังสือ</div>

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                จัดการยกเลิกข้อมูลการจองหนังสือ
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <sup><h6 class="mb-0" style="margin-top: 20px">จัดการยกเลิกข้อมูลการจองหนังสือ</h6></sup>
            <hr>
            <div class="card">
                <div class="card-header" align="center">
                   <h4>ยกเลิกข้อมูลการจองหนังสือ</h4>
                </div>
                <div class="card-body">
                    <form action="deletebooking.php" method="post" enctype="multipart/form-data" style="margin-top: 10px; margin-bottom: 10px;">
                    <input name ="bl_id" type="hidden" id="bl_id" value="<?php echo "$rs[bl_id]"; ?> ">
                    <input name ="dk_id" type="hidden" id="dk_id" value="<?php echo "$rs[dk_id]"; ?> ">
                        <table class="table" style="width: 50%; height: 100%"  align="center" >
                            <!-- <tr>
                                <div class="form-group row" align="center">
                                    <span style="padding-left:180px"></span>
                                    <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">รหัสการจอง</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?php echo "$rs[bl_id]";?>" name="bk_id" id="bk_id"
                                               aria-describedby="basic-addon1" readonly>

                                    </div>
                                </div>
                            </tr> -->
                            <tr>
                                <div class="form-group row" align="center">
                                    <span style="padding-left:180px"></span>
                                    <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">ชื่อผู้ใช้</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control " value="<?php echo "$rs[m_name]"; ?>" name="m_name" readonly>
                                    </div>
                                </div>
                            </tr>

                            <tr>
                                <div class="form-group row" align="center">
                                    <span style="padding-left:180px"></span>
                                    <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">วันที่จอง</label>
                                    <div class="col-sm-6">

                                        <input  type="text" class="form-control"  name="bw_date"  value="<?php echo "$rs[bk_date]";?>" readonly>
                                    </div>
                                </div>
                            </tr>

                            <tr>
                                <div class="form-group row" align="center">
                                    <span style="padding-left:180px"></span>
                                    <label for="colFormLabel" class="col-sm-2 ml-md-5 col-form-label">ชื่อหนังสือ</label>
                                    <div class="col-sm-6">
                                    <input  type="text" class="form-control"   value="<?php echo "$rs[b_name]";?>" readonly>
                                        <!-- <select name="bl_id" disabled="disabled"  class="custom-select" id="bl_id" >
                                            
                                            // $sql1 = "select * FROM bookingdetails where  bl_id ='$bl_id'and bk_id='$bk_id' ";
                                            // $result1 = mysql_query($sql1,$conn) or die ("3.ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
                                            // $rs1 = mysql_fetch_array($result1);

                                            // $sql2 = "SELECT * from booklist bl,book b where b.b_id=bl.b_id and  bl.bl_status = '0' ";
                                            // $result2 = mysql_query($sql2,$conn);
                                            // while ($rs2=mysql_fetch_array($result2)){
                                            //     echo "<option value = \"$rs2[bl_id]\" ";
                                            //     if ("$rs1[bl_id]"=="$rs2[bl_id]") {echo'selected';}
                                            //     echo ">$rs2[b_name]";
                                            //     echo "</option>\n";
                                            // }
                                            //?> 

                                        </select > -->
                                    </div>
                                </div>
                            </tr>

                            <tr>
                                <td align="center">
                                    <input class="btn btn-success" type="submit" value="บันทึก">
                                    <input class="btn btn-danger" type="reset" value="ยกเลิก">
                                </td>
                            </tr>
                    </form>
                <!--            Inner Table-->

                </div>
            </div>
        </div>
    </div>
    </body>
    </html>


<?php
mysql_close($conn);