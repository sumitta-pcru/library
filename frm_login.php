<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>บริการยืม-คืน |โรงเรียนวังโป่งศึกษา</title>
	<link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/stylelogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
    </style>
    

    <?php
    include "script.php";
    ?>
</head>
<body>
	   <div class="wrap">
        <form action="login.php" method="post" style="margin-top: 60px; margin-bottom: 10px;">
			
           <div class="img" style="background-image: url(public/images/png.png);"></div>
	  <br>
		  <div class="col mt-2 mb-3" align="center"> 
                        <font style="font-family : 'Itim'" > <h1>ยินดีต้อนรับ</h1></font>
          </div>
            <div class="form-group">
            <label for="exampleInputEmail1" class="form-label"><font color="red">*ชื่อผู้ใช้และรหัสผ่าน : เลขประจำตัว</font></label>
                <input required type="text" class="form-control item" name="login"  placeholder="ชื่อผู้ใช้ ">
            </div>
            <div class="form-group">
                <input required type="password" class="form-control item" name="password"  placeholder="รหัสผ่าน">
            </div>

            <div class="form-check">
                <input required class="form-check-input" value="1" type="radio" name="user_status" id="exampleRadios1" value="option2">
                   <label class="form-check-label" for="user_status" style="font-size: 18px;"> เจ้าหน้าที่
                    </label>
             </div>
         
			 <div class="form-check">
                 <input required class="form-check-input" value="2" type="radio" name="user_status" id="exampleRadios1" value="option3">
                   <label class="form-check-label" for="user_status" style="font-size: 18px;"> สมาชิก
                    </label>
             </div>
            <div class="form-group">
                <button type="submit"  class="btn btn-block sing-in">เข้าสู่ระบบ</button>
            </div>
			 <div class="form-group">
                <a href="index1.php">
                <button type="button" class="btn btn-block back">กลับ</button>
            </a>             </div>
			  
      </form>
        </div>
  
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="public/js/scriptlogin.js"></script>
</body>
</html>
