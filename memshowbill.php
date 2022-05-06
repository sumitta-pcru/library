<?php
include 'connect.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];

$sql = "select *
            FROM bookreturndetails bi  inner join bookreturn br  on bi.br_id = br.br_id 
                inner join member m on m.m_id = br.mr_id  
                inner join borrowingdetails bd on bi.bd_id = bd.bd_id
                inner join borrowing bw on bw.bw_id = bd.bw_id 
                inner join bill bil on br.br_id = bil.br_id 
                inner join booklist bl on bd.bl_id = bl.bl_id
                inner join book b on b.b_id = bl.b_id   where bw.m_id = '$valid_uname' group by br.br_id ";
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
        <div class="container-fluid" >
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3" style="margin-top: 15px">
                <div class="breadcrumb-title pe-3" style="font-size: 23px; ">จัดการหน้ารายงาน</div>

                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">
                                รายงานข้อมูลค่าปรับ
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
            <sup><h6 class="mb-0" style="margin-top: 20px">รายงานข้อมูลค่าปรับ</h6></sup>
            <hr>
            <div class="card">
                <div class="card-body">

                    <table class="table" id="example" width="100%" style="margin-top: 10px; margin-bottom: 10px">
                        <thead class="table-secondary" align="center">
                        <tr>
                            <td width="85" align="center">รหัสการคืน</td>
                            <!-- <td width="70" align="center">รหัสรายการหนังสือ</td> -->
                            <td width="70" align="center">วันที่ยืม</td>
                            <td width="100" align="center">วันที่คืน</td>
                            <td width="100" align="center">ค่าปรับ</td>
                            <td width="100" align="center">เจ้าหน้าที่</td>
                            <td width="60" align="center"></td>
                        </tr>
                        </thead>

                        <tbody>

                        <?php
                        while ($rs1 = mysql_fetch_object($result)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo"$rs1->br_id";?></td>
                                <!-- <td align="center"><?php echo"$rs1->bl_id";?></td> -->
                                <td align="center"><?php echo"$rs1->bw_date";?></td>
                                <td align="center"><?php echo"$rs1->br_date";?></td>
                                <td align="center"><?php echo"$rs1->rate";?></td>
                                <td align="center"><?php echo"$rs1->m_name";?></td>
                                <td align="center">
                                            <a class="btn btn-secondary"  href="memprintbill.php?br_id=<?php echo $rs1->br_id;?>">
                                            <i class="fas fa-print"></i> พิมพ์ใบเสร็จ
                                            </a>
                                        </td>
                            </tr>

                            <?php
                        }
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
