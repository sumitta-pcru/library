<?php
session_start();
if (isset($_SESSION["valid_uname"]) && isset($_SESSION["valid_pwd"])) {
include "connect.php";
// include 'scriptmem.php';
// include 'script.php';
$br_id = $_GET["br_id"];
$rb_id = $_GET["rb_id"];
$valid_uname = $_SESSION['valid_uname'];
$sql1 = "SELECT * FROM member WHERE m_id = '$valid_uname'";
$result1 = mysql_query($sql1, $conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs1 = mysql_fetch_object($result1);

$sql11 = "select *
            FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
            inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
            inner join borrowing bw on bw.bw_id = bd.bw_id 
            inner join bill bi on rd.rb_id = bi.rb_id  
            inner join booklist bl on bl.bl_id = bd.bl_id                
            inner join book b on b.b_id = bl.b_id  
            inner join member m on m.m_id = br.mr_id 
			inner join usertype ut on ut.ut_id=m.ut_id where rd.rb_id =  $rb_id ";
$result11 = mysql_query($sql11, $conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs11 = mysql_fetch_object($result11);


$sql 	= "select *
            FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
            inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
            inner join borrowing bw on bw.bw_id = bd.bw_id 
            inner join bill bi on rd.rb_id = bi.rb_id 
            inner join booklist bl on bl.bl_id = bd.bl_id                
            inner join book b on b.b_id = bl.b_id  
            inner join member m on m.m_id = bw.m_id 
			inner join usertype ut on ut.ut_id=m.ut_id where rd.br_id = '$br_id' ";
$result = mysql_query($sql,$conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();

$sql3 	= "select *
            FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
            inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
            inner join borrowing bw on bw.bw_id = bd.bw_id 
            inner join bill bi on rd.rb_id = bi.rb_id  
            inner join booklist bl on bl.bl_id = bd.bl_id                
            inner join book b on b.b_id = bl.b_id  
            inner join member m on m.m_id = bw.m_id 
			inner join usertype ut on ut.ut_id=m.ut_id where rd.rb_id =  $rb_id ";
$result3 = mysql_query($sql3,$conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs2 = mysql_fetch_object($result3);

// $sql4 	= "select rd.rate
//             FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
//             inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
//             inner join borrowing bw on bw.bw_id = bd.bw_id 
//             inner join booklist bl on bl.bl_id = bd.bl_id                
//             inner join book b on b.b_id = bl.b_id  
//             inner join member m on m.m_id = br.m_id 
// 			inner join usertype ut on ut.ut_id=m.ut_id where br.br_id =  $br_id ";
// $result4 = mysql_query($sql4,$conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
// while ($rs2 = mysql_fetch_object($result4)){
//      $sum = $rs2->rate + $rs2->rate;
//             echo $sum;
// }

$sql2 = "select *
            FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
            inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
            inner join borrowing bw on bw.bw_id = bd.bw_id  where rd.rb_id =  $rb_id ";
$query = mysql_query($sql2,$conn)or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$row = mysql_fetch_object($query);


$bw_returndate = date_create($row->bw_returndate);
$br_date = date_create($row->br_date);
$datediff = date_diff( $br_date,$bw_returndate);	
$diff = $datediff->format('%a');
	
$date = date($row->br_date);	

	
function DateThai($date)
	{
		$strYear = date("Y",strtotime($date))+543;
		$strMonth= date("n",strtotime($date));
		$strDay= date("j",strtotime($date));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	
	
	
//$bw_returndate = date($row->bw_returndate);
//$br_date = date($row->br_date);	
//
//$date =  (strtotime($bw_returndate) - strtotime($br_date))/ ( 60 * 60 * 24 );
//	if($br_date<=$bw_returndate){
//		echo "0"; 
//	}else{
//		echo $diff; 
//	}
//		
//echo $bw_returndate; 	
	
mysql_close(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ใบเสร็จค่าปรับ</title>
   <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
   <!-- <link rel="stylesheet" href="./public/css/bootstrap.min.css" type="text/css"> -->

    <style type="text/css" media="print">
        #paper
        {
            width: 21cm;
            min-height: 20cm;
            padding: 2.5cm;
            position: relative;
        }
    </style>

    <style type="text/css" media="screen">
        #paper
        {
            background: #FFF;
            border: 1px solid #666;
            margin: 20px auto;
            width: 21cm;
            min-height: 25cm;
            padding: 50px;
            position: relative;

            /* CSS3 */

            box-shadow: 0px 0px 5px #000;
            -moz-box-shadow: 0px 0px 5px #000;
            -webkit-box-shadow: 0px 0px 5px #000;
        }
    </style>
    <style type="text/css" >

        #paper textarea
        {
            margin-bottom:25px;
            width: 50%;
        }

        #paper table, #paper th, #paper td {
            border: none;
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }

        #paper table.border, #paper table.border th, #paper table.border td { border: 1px solid #666; }

        #paper th
        {
            background: none;
            color: #000
        }

        #paper hr { border-style: solid; }

        #signature
        {
            bottom: 181px;
            margin: 50px;
            padding: 50px;
            position: absolute;
            right: 3px;
            text-align: center;
        }
         .float-left {
        float: left !important;
        }

        .float-right {
        float: right !important;
        }

        .float-none {
        float: none !important;
        } 
        

    </style>
</head>

<body>
<div id="paper">
    <table width="100%"  style="margin-top: -30px">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td height="55" colspan="2" align="center"><img src="public/images/logo.png" style="padding-left:170px" class="float-left" width="100" height="100" alt=""/>
            <h1 align="center" style="font-family: 'TH SarabunPSK'; text-align: center; padding-right:280px;"> ใบเสร็จค่าปรับ</h1></td>
        </tr>
        <tr>
            <td colspan="2" align="center">โรงเรียนวังโป่งศึกษา</td>
        </tr>
        <tr>
            <td colspan="2" align="center">โรงเรียนวังโป่งศึกษา 14 หมู่ 13 ตำบลวังโป่ง อำเภอวังโป่ง จังหวัดเพชรบูรณ์ 67240 สังกัด สพม.40</td>
        </tr>
        <tr>
            <td height="31" colspan="2" align="center">โทร 05-6786435</td>
        </tr>
		<tr><td height="18"></td></tr>
		<tr><td></td></tr>

        <tr>
            <td>ประเภทสมาชิก : <?php echo"$rs2->ut_name";?></td>
            <td align="right">เลขที่ใบเสร็จรับเงิน <?php echo"$rs2->bi_id";?></td>
        </tr>

        <tr>
            <td>รหัสสมาชิก : <?php echo"$rs2->m_id";?></td>
            <td width="33%" align="right">วันที่ : <?php echo DateThai($date);?> </td>
        </tr>
        <tr>
            <td>ชื่อ : <?php echo"$rs2->m_name";?></td>
            <td width="33%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td>ที่อยู่ : <?php echo"$rs2->m_add";?></td>

        </tr>
        <!-- <tr>
            <td height="29">เลขที่ใบอ้างอิง <?php echo"$rs2->bw_id";?></td>

        </tr> -->
        
    </table>
    <br>
    <table width="100%" border="1" cellspacing="0" class="border">
         <br>
        <tr>
            <td width="35" align="center">ลำดับ </td>
            <td width="375" align="center">ชื่อหนังสือ</td>
            <td width="93" align="center">วันที่ยืม</td>
            <td width="82" align="center">วันที่คืน</td>
            <td width="119" align="center">จำนวนวันที่เกินกำหนด</td>
            <td width="63" align="center">ราคา/วัน</td>
        </tr>
        <?php 
        $i=1;
        while ($rs = mysql_fetch_object($result)) {
            // $sum = $rs->rate + $rs->rate;
            // echo $sum;
        ?>
        <tr>
            <td align="center"><?php echo $i; ?> </td>
            <td align="center"> <?php echo"$rs->b_name";?> </td>
            <td align="center"><?php echo"$rs->bw_date";?></td>
            <td align="center"><?php echo"$rs->br_date";?></td>
            <td align="center"><?php if($br_date<=$bw_returndate){
											echo "0"; 
									 }else{
											echo $diff; 
								}?></td>
            <td align="center"><?php echo"$rs->ut_rate";?></td>
        </tr>
        
        
        <?php
        $sum = 0;
        if($i>1){
            $sum = $rs->rate +  $rs->rate ;
        }else{
            $sum = $rs->rate +  $sum ;
        }
        // $sum = 0;
      
        $i++;
            }
         ?>
       <tr>
            <td colspan="5" align="lift">รวมราคาทั้งสิน</td>
            <td align="center"><?php echo $sum; ?> บาท</td>
        </tr>
    </table>
    <table width="30%" align="right" style="margin-top: 100px" >
        <tr >
            <td  align="center">................................</td>
        </tr>
        <tr >
            <td   align="center">( <?php echo"$rs11->m_name"; ?> ) </td>
        </tr>
        <tr >
            <td  align="center">ผู้รับเงิน</td>
        </tr>

    </table>
	<table width="30%" align="right" style="margin-top: 100px" >
        <tr >
            <td  align="center">................................</td>
        </tr>
        <tr >
            <td   align="center">( <?php echo"$rs1->m_name"; ?> ) </td>
        </tr>
        <tr >
            <td  align="center">ผู้จ่ายเงิน</td>
        </tr>

    </table>
</div>
<div  align="center" >
    <input onclick="javascript:window.print()" type="image" src="img/printer.png" width="55px" name="print1">
</div><br>
    <div  align="center" >
    <button type="button" name="submit"  
      onclick="window.location='memshowbill.php'" class="btn btn-danger"> กลับ </button>
    </div>
<!-- <script src="./public/js/bootstrap.min.js" crossorigin="anonymous"></script> -->
</body>
</html>
    <?php
} else {
    echo "<script> alert('Please Login');window.history.go(-1);</script>";
    exit();
}
?>