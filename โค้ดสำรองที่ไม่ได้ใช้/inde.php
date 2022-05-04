<?php
    include 'connect.php';

    $id=$_GET['id'];
    $sql = "SELECT * FROM offit where id = '$id'";
    $result = mysql_query($sql,$conn)
    or die ("Can't Query").mysql_error();
    $rs1 = mysql_fetch_array($result);


    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบครุภัณฑ์ </title>
	<link rel="shortcut icon"type="image/x-icon" href="picture/logo.png" >
    <?php
    include "scriptmem.php";
    ?>
	
</head>
<body>
<?php
include 'menu.php'
?>
<div class="container-fluid">
	<div class="container-fluid">
             <br>
<div class="container">
    <div class="card"  align="center">
        <div class="card-body" align="center" >
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">รหัสครุภัณฑ์</label>
                <div class="col-sm-10">
                    <input disabled="disabled" value="<?php echo "$rs1[id]";?>" type="text" class="form-control"
                           name="off_id" id="off_id"
                           aria-describedby="basic-addon1">
                </div>
            </div>

            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">ชื่อครุภัณฑ์</label>
                <div class="col-sm-10">
                    <input disabled="disabled" value="<?php echo "$rs1[name]";?>" type="text" class="form-control"
                           name="off_name" id="off_name"
                           aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="form-group row ">

                <div class="form-group col-4">
                    <div>
                        <?php

                        if("$rs1[pic]" !=""){
                            ?>

                            <img src="<?php echo"./picture/$rs1[pic]";?>" width="60%" height="70%">
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group col-8">
                    <label for="staticEmail" class="col-sm-4 col-form-label">ปรเภทครุภัณฑ์</label>
                    <div class="col-sm-10">
                        <input disabled="disabled" value="<?php echo "$rs1[cate]";?>" type="text" class="form-control"
                               name="off_type" id="off_type"
                               aria-describedby="basic-addon1">
                    </div>
                    <label for="staticEmail" class="col-sm-4 col-form-label">สถานที่จัดเก็บ</label>
                    <div class="col-sm-10">
                        <input disabled="disabled" value="<?php echo "$rs1[loca]";?>" type="text" class="form-control"
                               name="off_loca" id="off_loca"
                               aria-describedby="basic-addon1">
                    </div>
                    <label for="staticEmail" class="col-sm-4 col-form-label">หน่วยงานที่ใช้</label>
                    <div class="col-sm-10">
                        <input disabled="disabled" value="<?php echo "$rs1[off]";?>" type="text" class="form-control"
                               name="off_agency" id="off_agency"
                               aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">สถานที่จัดเก็บ</label>
                <div class="col-sm-10">
                    <input disabled="disabled" value="<?php echo "$rs1[loca]";?>" type="text" class="form-control"
                           name="off_loca" id="off_loca"
                           aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">หน่วยงานที่ใช้</label>
                <div class="col-sm-10">
                    <input disabled="disabled" value="<?php echo "$rs1[off]";?>" type="text" class="form-control"
                           name="off_agency" id="off_agency"
                           aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">วันที่ตรวจรับ</label>
                <div class="col-sm-10">
                    <input disabled="disabled" value="<?php echo "$rs1[data]";?>" type="text" class="form-control"
                           name="data" id="data"
                           aria-describedby="basic-addon1">
                </div>
  </div>
                     <?php
                     function timespan($seconds = 1, $time = '')
                     {
                         if ( ! is_numeric($seconds))
                         {
                             $seconds = 1;
                         }

                         if ( ! is_numeric($time))
                         {
                             $time = time();
                         }

                         if ($time <= $seconds)
                         {
                             $seconds = 1;
                         }
                         else
                         {
                             $seconds = $time - $seconds;
                         }

                         $str = '';
                         $years = floor($seconds / 31536000);

                         if ($years > 0)
                         {
                             $str .= $years.' ปี, ';
                         }

                         $seconds -= $years * 31536000;
                         $months = floor($seconds / 2628000);

                         if ($years > 0 OR $months > 0)
                         {
                             if ($months > 0)
                             {
                                 $str .= $months.' เดือน, ';
                             }

                             $seconds -= $months * 2628000;
                         }

                         $weeks = floor($seconds / 604800);

                         if ($years > 0 OR $months > 0 OR $weeks > 0)
                         {
                             if ($weeks > 0)
                             {
                                 $str .= $weeks.' สัปดาห์, ';
                             }

                             $seconds -= $weeks * 604800;
                         }

                         $days = floor($seconds / 86400);

                         if ($months > 0 OR $weeks > 0 OR $days > 0)
                         {
                             if ($days > 0)
                             {
                                 $str .= $days.' วัน, ';
                             }

                             $seconds -= $days * 86400;
                         }

                         $hours = floor($seconds / 3600);

                         if ($days > 0 OR $hours > 0)
                         {
                             if ($hours > 0)
                             {
                                 $str .= $hours.' ชั่วโมง, ';
                             }

                             $seconds -= $hours * 3600;
                         }

                         $minutes = floor($seconds / 60);

                         if ($days > 0 OR $hours > 0 OR $minutes > 0)
                         {
                             if ($minutes > 0)
                             {
                                 $str .= $minutes.' นาที, ';
                             }

                             $seconds -= $minutes * 60;
                         }

                         if ($str == '')
                         {
                             $str .= $seconds.' วินาที';
                         }

                         return substr(trim($str), 0, -1);
                     }


                     // ตัวอย่างการใช้งาน
                     $birthdate = strtotime( '2001-11-13' );
                     $today = time();

                     ?>


            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">อายุการใช้งาน</label>
                <div class="col-sm-10" >
                    <input disabled="disabled" value="<?php  echo timespan( $birthdate , $today );?>" id="mydateth3" type="text" class="form-control"
                                    aria-describedby="basic-addon1">
                </div>
            </div>
   </div>      
					
					
				
</div>
</div>
		
   </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>

</body>
</html>


