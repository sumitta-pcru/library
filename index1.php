<?php
include 'connect.php';
/*include 'check.php';*/
include 'scriptmem.php';
$sql1 = "select * 
            FROM book b inner join bookcategory bc on b.bc_id = bc.bc_id inner join booklist bl on bl.b_id=b.b_id  where bl.new='1'";
$result1 = mysql_query($sql1,$conn);

$sql2 = "select b.b_id,b.b_name,b.b_pic,bc.bc_name,COUNT(b.b_id) as num
            FROM book b inner join bookcategory bc on b.bc_id = bc.bc_id 
            inner join booklist bl on bl.b_id=b.b_id
            inner join borrowingdetails bw on bw.bl_id=bl.bl_id group by b.b_id order by num  DESC LIMIT 6";
$result2 = mysql_query($sql2,$conn)

or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();


?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <title>บริการยืม-คืน |โรงเรียนวังโป่งศึกษา</title>

	   <link rel="manifest" href="site.webmanifest">
      <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="public/css/fontawesome.css">
    <link rel="stylesheet" href="public/css/templatemo.css">
    <link rel="stylesheet" href="public/css/animated.css">
    <link rel="stylesheet" href="public/css/owl.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Chonburi&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Athiti:wght@500;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Chonburi&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Chonburi&family=Itim&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@700&display=swap');

    </style>
    
<!--

TemplateMo 563 SEO Dream

https://templatemo.com/tm-563-seo-dream

-->

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script>
<script src="http://use.edgefonts.net/acme:n4:default;cooper-black-std:n4:default.js" type="text/javascript"></script>

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="#top" class="logo">
              <h4 style=" font-size: 200%; font-family: 'Chonburi'">ห้องสมุด วศ. <img src="public/images/logo-icon.png" > </h4>

            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a style="font-family:'Mitr' ; font-size: 120%"   href="#top" class="active" >หน้าหลัก</a></li>
              <li class="scroll-to-section"><a style="font-family:'Mitr'; font-size: 120%" href="#features ">หนังสือใหม่</a></li>
              <li class="scroll-to-section"><a style="font-family:'Mitr'; font-size: 120%" href="#about">หนังสือยอดนิยม</a></li>
              <li class="scroll-to-section"><a style="font-family:'Mitr'; font-size: 120%"  href="#services">คู่มือการใช้งาน</a></li>
              <li class="scroll-to-section"><a style="font-family:'Mitr'; font-size: 120%"  href="#contact">ติดต่อ</a></li>
              <li class="scroll-to-section"><div class="main-blue-button"><a href="frm_login.php">เข้าสู่ระบบ</a></div></li>
            </ul>
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <div class="row">
                  <div class="col-lg-4 col-sm-4">
                    <div class="info-stat">

                      <h4 style="font-size: 550% ;font-family: 'Chonburi'">ยินดีต้อนรับ</h4>
                    </div>
                  </div>


                  <div class="col-lg-12 mt-2" >
                    <h2 style="font-family: 'Kanit'" >บริการ &amp; ยืม-คืนหนังสือ</h2>
                  </div>
                  
                  <div class="row mt-4">
                      <div class="main-green-button col-sm mb-3">
                      <a href="frm_addbookings.php" style="font-size: 16px">การจอง(นักเรียน)</a>
                      </div>
                      <div class="main-green-button col-sm mb-3">
                      <a href="frm_addborrowing.php" style="font-size: 16px">การยืม(เจ้าหน้าที่)</a>
                      </div>
                      <div class="main-green-button col-sm mb-3">
                      <a href="frm_addbookreturn.php" style="font-size: 16px">การคืน(เจ้าหน้าที่)</a>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 right-image">
              <div class="wow fadeInRight page-breadcrumb d-none d-sm-flex align-items-center mb-3 " data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="public/images/logo.png" class="rounded float-start">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

          <?php
            include 'script.php';
            ?>

        <div id="features" class="features section">
          <div class="container">
            <div class="row mt-5">
              <table align="center" class="table table-borderless "  style="width: 200%; height: 500px">
                <div class="col-lg-12 mt-2" >
                    <h2 class ="pb-2 border-bottom" style="font-family: 'Prompt' ">แนะนำหนังสือใหม่</h2>
                </div>  
                <div align="center" style="width: 100%">
                  <div class="table">
                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 " >
                      <?php
                        while ($rs1 = mysql_fetch_object($result1)) {
                      ?>
                        <div class="col mb-1">
                          <div class="card h-100">
                            <p class="card-header text-center"><strong><?php echo"$rs1->b_name";?></strong></p>
                              <div class="d-flex justify-content-center mt-4">
                                <img src="./picture/<?php echo $rs1->b_pic; ?>" class="card-img-top w-50" alt="...">
                              </div>
                              <div class="card-body ">
                                <h5 class="card-title"><?php echo"$rs1->bl_id";?></h5>
                                <h5 class="card-text"><?php echo"$rs1->bc_name";?></h5>                    
                              </div>
                          </div>
                        </div>        
                      <?php
                        }
                      ?>
                    </div>       
                  </div>
                </div>
              </table>
            </div>
          </div>
        </div>

  
        <div id="about" class="about-us section">
          <div class="container">
            <div class="row">
              <table align="center" class="table table-borderless "  style="width: 100%; height: 150px">
                <div class="col-lg-12 mt-2" >
                  <h2 class ="pb-2 border-bottom" style="font-family: 'Prompt' ">แนะนำหนังสือยอดนิยม</h2>
                </div>
                <div align="center" style="width: 100%">
                    <div class="table">
                      <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 " >
                        <?php
                          while ($rs2 = mysql_fetch_object($result2)) {
                        ?>
                          <div class="col mb-1">
                            <div class="card h-100">
                              <p class="card-header text-center"><strong><?php echo"$rs2->b_name";?></strong></p>
                                <div class="d-flex justify-content-center mt-4">
                                  <img src="./picture/<?php echo $rs2->b_pic; ?>" class="card-img-top w-50" alt="...">
                                </div>
                                <div class="card-body ">
                                  <h5 class="card-title"><?php echo"$rs2->b_id";?></h5>
                                  <h5 class="card-text"><?php echo"$rs2->bc_name";?></h5>
                                </div>
                            </div>
                          </div>        
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div> 
                </table>
              </div>
            </div>
          </div>



          <div id="services" class="our-services section">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 mt-2" >
                    <h2 class ="pb-2 mb-4" style="font-family: 'Prompt' ">คู่มือการใช้งานระบบ</h2>
                </div>
                <div class="col">
                    <img src="img/detail.svg" class="img-fluid">
                </div>
              </div>
            </div>  
          </div>


          <div id="contact" class="contact-us section">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="" method="post">
                      <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                          <div class="section-heading">
                            <h2 >  <span style="font-family: 'Mitr'; font-size: 40px">ติดต่อ</span> </h2>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="contact-info">
                            <ul>
                              <li>
                                <div class="icon" >
                                    <img src="public/images/contact-icon-01.png" alt="email icon">
                                </div>
                                    <a href="Mailto:wangpongsuksa@hotmail.co.th">wangpongsuksa@wpspb.ac.th</a>
                              </li>
                              <li>
                                <div class="icon">
                                    <img src="public/images/contact-icon-02.png" alt="phone">
                                </div>
                                    <a href="tel:056 786 435">056 786 435</a>
                              </li>
                              <li>
                                <div class="icon">
                                    <img src="public/images/contact-icon-03.png" alt="location">
                                </div>
                                    <a href="https://shorturl.asia/shZ">โรงเรียนวังโป่งศึกษา 14 หมู่ 13 ตำบลวังโป่ง อำเภอวังโป่ง จังหวัดเพชรบูรณ์ 67240 สังกัด สพม.40</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>

          <footer>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <p>

                  <br><a rel="nofollow" href=" " title="free CSS templates"> </a></p>
                </div>
              </div>
            </div>
          </footer>

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/js/owl-carousel.js"></script>
  <script src="public/js/animation.js"></script>
  <script src="public/js/imagesloaded.js"></script>
  <script src="public/js/custom.js"></script>

</body>
</html>