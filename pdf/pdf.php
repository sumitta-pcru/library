<?php

include 'connect.php';
include 'check.php';

$valid_uname = $_SESSION['valid_uname'];
$br_id=$_GET['br_id'];
$sql 	= 'select *
            FROM bookreturn br inner join bookreturndetails rd on br.br_id = rd.br_id
            inner join borrowingdetails bd on rd.bd_id = bd.bd_id 
            inner join borrowing bw on bw.bw_id = bd.bw_id 
            inner join booklist bl on bl.bl_id = bd.bl_id                
            inner join book b on b.b_id = bl.b_id  
            inner join member m on m.m_id = br.m_id 
			inner join usertype ut on ut.ut_id=m.ut_id
		   
		  ';

$result = mysql_query($sql, $conn)
or die("3. ไม่สามารถประมวลผลคำสั่งได้") . mysql_error();
$rs = mysql_fetch_object($result);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ใบเสร็จรับเงินค่าสมาชิกรายเดือน</title>
    <?php include("inc.css.php"); ?>

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
    </style>
</head>

<body>
<div id="paper">
    <table width="100%"  style="margin-top: -30px">
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td height="55" colspan="2"><h1 align="center" style="font-family: 'TH SarabunPSK'; text-align: center;">ใบเสร็จรับเงิน</h1></td>
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

	
        <tr>
            <td>ประเภทสมาชิก : <?php echo"$rs->ut_name";?></td>
            <td align="right">เลขที่ใบเสร็จรับเงิน <?php echo"$rs->br_id";?></td>
        </tr>
		
        <tr>
            <td>รหัสสมาชิก : <?php echo"$rs->m_id";?></td>
            <td width="33%" align="right">วันที่ : <?php echo"$rs->br_date";?> เวลา <?php echo"$rs->br_date";?> น.</td>
        </tr>
        <tr>
            <td>ชื่อ : <?php echo"$rs->m_name";?></td>
            <td width="33%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td>ที่อยู่ : <?php echo"$rs->m_add";?></td>
            
        </tr>
        <tr>
            <td height="29">เลขที่ใบอ้างอิง <?php echo"$rs->bw_id";?></td>
            
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" class="border">
        <tr>
            <td width="35" align="center">ลำดับ </td>
            <td width="375" align="center">ชื่อหนังสือ</td>
            <td width="93" align="center">วันที่ยืม</td>
            <td width="82" align="center">วันที่คืน</td>
            <td width="119" align="center">จำนวนวันที่เกินกำหนด</td>
            <td width="63" align="center">ราคา/วัน</td>
        </tr>
        <tr>
            <td align="center">1</td>
            <td align="center"> <?php echo"$rs->b_name";?> </td>
            <td align="center"><?php echo"$rs->bw_date";?></td>
            <td align="center"><?php echo"$rs->bw_returndate";?></td>
            <td align="center"><?php echo"$rs->bw_id";?></td>
            <td align="center"><?php echo"$rs->ut_rate";?></td>
        </tr>
        <tr>
            <td colspan="5" align="lift">จำนวนเงิน</td>
            <td align="right">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" align="lift">รวมราคาทั้งสิน</td>
            <td align="center">&nbsp;</td>
        </tr>
    </table>
    <table width="30%" align="right" style="margin-top: 100px" >
        <tr >
            <td  align="center">................................</td>
      </tr>
        <tr >
            <td   align="center">( ศิริยา ชัยรัตนสุนทร ) </td>
        </tr>
        <tr >
            <td  align="center">ผู้รับเงิน   </td>
        </tr>
  </table>

</div>
</body>
</html>