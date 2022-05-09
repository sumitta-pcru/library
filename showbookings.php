<?php
include 'connect.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];

$sql = "select *
            FROM  bookings bk inner join member m on m.m_id = bk.m_id 
            inner join bookingsdetails bt  on bk.bk_id = bt.bk_id 
            inner join booklist bl on bt.bl_id = bl.bl_id
            inner join book b on b.b_id = bl.b_id and m.m_id = '$valid_uname' ";
$result = mysql_query($sql,$conn)
or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>

    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

    <link rel="stylesheet" href="datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="datatables/css/buttons.bootstrap4.min.css">
    
    <?php
        include 'scriptmem.php';
        ?>
</head>

<body>
    <?php
    include './h/member_menu.php'
    ?>
    <div class="container-fluid" style="background-color: #f8f9fd;">
        <div class="container-fluid">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3" style="margin-top: 15px">
                <div class="breadcrumb-title pe-3" style="font-size: 23px; ">จัดการหน้าหลัก</div>

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                จัดการข้อมูลการจองหนังสือ
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto" style="margin-top: 10px">
                    <a class="btn btn-success" href="frm_addbooking.php"><i
                            class="fas fa-plus-circle"></i>เพิ่มการจอง</a>
                </div>
            </div>
            <sup>
                <h6 class="mb-0" style="margin-top: 20px">จัดการข้อมูลการจองหนังสือ</h6>
            </sup>
            <hr>
            <div class="card">
                <div class="card-body">

                    <table class="table" id="example" width="100%" style="margin-top: 10px; margin-bottom: 10px">
                        <thead class="table-secondary" align="center">
                            <tr>
                                <td width="85" align="center"> รหัสการจอง</td>
                                <td width="100" align="center">วันที่จอง</td>
                                <td width="70" align="center">สถานะ</td>
                                <td width="70" align="center">ชื่อหนังสือ</td>
                                <td width="70" align="center">ชื่อผู้ใช้</td>
                                <td width="70">&nbsp;</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                           
                        while ($rs = mysql_fetch_object($result)) {
                            //while ($rs = mysql_fetch_object($result)){
                                
                            
                            ?>
                            <tr>
                                <td align="center"><?php echo"$rs->bk_id";?></td>
                                <td align="center"><?php echo"$rs->bk_date";?></td>
                                <td align="center"><?php
                                    if($rs->dk_status==0){
                                        echo "จอง";
                                    }elseif ($rs->dk_status==1){
                                        echo "ยืม";
                                    }elseif ($rs->dk_status==2){
                                        echo "ยกเลิก";
                                    }

                                    ?>
                                </td>
                                <td align="center"><?php echo"$rs->b_name";?></td>
                                <td align="center"><?php echo"$rs->m_name";?></td>
                                <td align="center">
                                    <!-- <a class="btn btn-warning"
                                        href="frm_editbookings.php?bk_id=<?php echo $rs->bk_id;?>">
                                        <i class="fas fa-pen"></i> แก้ไข
                                    </a> -->
                                    <?php 
                                    if($rs->dk_status!=2){ ?>
                                        <a class="btn btn-danger" href="frm_delbookings.php?dk_id=<?php echo $rs->dk_id;?>&amp;bl_id=<?php echo $rs->bl_id;?>"
                                        style="color: white">
                                        <i class="fas fa-trash-alt"></i> ยกเลิก

                                    </a>
                                    <?php } ?>
                                    <?php if($rs->dk_status==2) {  ?>
                                        <a class="btn btn-secondary "style="color: white">
                                        <i class="fas fa-trash-alt"></i> ยกเลิก

                                    </a>
                                    
                                    <?php }?>
                                </td>
                            </tr>


                            <?php
                        }
                    // }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
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