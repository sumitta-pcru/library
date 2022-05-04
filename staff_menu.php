<?php
include 'connect.php';
include 'script.php';


$valid_uname = $_SESSION['valid_uname'];


?>
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



<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="frm_editmestaff.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <img style="width: 80px"  src="img/smartt.svg">
        </div>
        <div class="sidebar-brand-text mx-1">บริการยืม-คืน <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="frm_editmestaff.php">
            <i class="fas fa-user-edit"></i>
            <span>แก้ไขข้อมูลส่วนตัว</span></a>
    </li>
    <!-- Divider -->

    <!-- Heading -->
    <div class="sidebar-heading">

    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="frm_listkings.php">
        <i class="fas fa-th-list"></i>
            <span>รายการที่จอง</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="frm_addborrowing.php">
            <i class="fas fa-share-square"></i>
            <span>ทำรายการการยืม</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="showborrowing.php">
            <i class="fas fa-exchange-alt"></i>
            <span>ข้อมูลการยืม</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="showline.php">
        <i class="far fa-bell"></i>
            <span>แจ้งเตือนคืนหนังสือ</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="frm_addbookre.php">
        <i class="fas fa-reply-all"></i>
            <span>ทำรายการการคืน</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="showbookreturn.php">
            <i class="fas fa-undo-alt"></i>
            <span>ข้อมูลการคืน</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-file-alt"></i>
            <span>รายงาน</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="staffbook.php">หนังสือทั้งหมด</a>
                <a class="collapse-item" href="staffrebookcate.php">หนังสือแยกตามหมวดหมู่</a>
                <a class="collapse-item" href="staffreportbook.php">หนังสือแยกตามสถานะ</a>
                <a class="collapse-item" href="staffrebookpop.php">หนังสือยอดนิยม</a>
                <a class="collapse-item" href="staffrebooknew.php">หนังสือใหม่</a>
                <a class="collapse-item" href="staffreportbor-re.php">การยืม - คืน</a>
                <a class="collapse-item" href="staffrebookbacklog.php">หนังสือค้างส่ง</a>
                <a class="collapse-item" href="staffrefine.php">ค่าปรับ</a>
                <a class="collapse-item" href="staffrefineday.php">ข้อมูลค่าปรับหนังสือรายวัน</a>
                <a class="collapse-item" href="staffrefinemonth.php">ข้อมูลค่าปรับหนังสือรายเดือน</a>
                <a class="collapse-item" href="staffrekingsday.php">การจองหนังสือประจำวัน</a>
                <a class="collapse-item" href="staffdatakings.php">สถิติการจอง</a>
                <a class="collapse-item" href="staffdatabor.php">สถิติการยืม</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>ออกจากระบบ</span></a>

    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Staff | 
                                    <?php $sql2 = "SELECT m.m_name FROM member m where  m.m_id = '$valid_uname'";
                                    $result2 = mysql_query($sql2,$conn);
                                    $rs2 = mysql_fetch_array($result2);
                                    echo "$rs2[m_name]";?> </span>

                                    
                        <img class="img-profile rounded-circle"
                             src="img/undraw_profile.svg">
                    </a>
                </li>
            </ul>

        </nav>
        

