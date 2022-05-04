<?php
include 'connect.php';

$valid_uname = $_SESSION['valid_uname'];
$sql1 = "SELECT * FROM member WHERE m_id = '$valid_uname'";
$result1 = mysql_query($sql1, $conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs1 = mysql_fetch_array($result1);
mysql_close();
?>
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/stylelogin.css" type="text/css">
<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

<!-- Custom styles for this template-->


<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #abdde5">
    <a class="navbar-brand"  > <img class="sidebar-brand-icon rotate-n-15" style="width: 70px" height="53px" src="img/smart.svg"><font class="sidebar-brand-text mx-lg-n1">บริการยืม-คืน</font></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse  justify-content-end " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="frm_addbooking.php">ทำการจองหนังสือ </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="showbookings.php">ข้อมูลการจองหนังสือ </a>
                </li>
               
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        รายงาน
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="memreportkings.php">
                            <i class="far fa-calendar-check fa-fw mr-2 text-gray-400"></i>
                            การจองหนังสือ
                        </a>
                        <a class="dropdown-item" href="memrebookpop.php" >
                            <i class="fas fa-book fa-sm fa-fw mr-2 text-gray-400"></i>
                             หนังสือยอดนิยม
                        </a>
                        <a class="dropdown-item" href="memrebooknew.php">
                            <i class="fas fa-book fa-sm fa-fw mr-2 text-gray-400"></i>
                            หนังสือใหม่
                        </a>
                        <a class="dropdown-item" href="memrebook.php" >
                            <i class="fas fa-book fa-sm fa-fw mr-2 text-gray-400"></i>
                            หนังสือทั้งหมด
                        </a>
                         <a class="dropdown-item" href="memrebookcate.php" >
                            <i class="fas fa-book-open fa-sm fa-fw mr-2 text-gray-400"></i>
                            หมวดหมู่หนังสือ
                        </a>
                        <a class="dropdown-item" href="memreportbor-re.php">
                            <i class="fas fa-sync-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            การยืม - คืน
                        </a>
                    
                        <a class="dropdown-item" href="memshowbill.php" >
                            <i class="fas fa-file-invoice fa-sm fa-fw mr-2 text-gray-400"></i>
                            ใบเสร็จค่าปรับ
                        </a>
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow ">
                        <div class="user-box dropdown ">
                            <a class="d-flex align-items-center nav-link dropdown-toggle "  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" style="width: 30px"
                                     src="img/undraw_profile.svg">
                                    <div class="user-info ps-3">
                                        <p class="user-name mb-0">
                                        <?php $sql2 = "SELECT m.m_name FROM member m where  m.m_id = '$valid_uname'";
                                    $result2 = mysql_query($sql2,$conn);
                                    $rs2 = mysql_fetch_array($result2);
                                    echo "$rs2[m_name]";?>
                                        </p>
                                        <p class="designattion mb-0">
                                            <?php
                                            $sql3 = "SELECT u.ut_name FROM member m,usertype u where  m.m_id = '$valid_uname' and m.ut_id=u.ut_id";
                                            $result3 = mysql_query($sql3,$conn);
                                            $rs3 = mysql_fetch_array($result3);
                                            echo "$rs3[ut_name]";
                                            ?>
                                        </p>
                                    </div>
                        </a>
                        <!-- Dropdown - User Information -->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="frm_editmeme.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                โปรไฟล์
                            </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    ออกจากระบบ
                                </a>
                        </div>
                        </div>
                    </li>

            </ul>

        </div>
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
</nav>
