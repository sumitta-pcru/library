<?php
	session_start();
    include("connect.php");  
    include("script.php");  
    include("alert.php");  
   
                                 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">

</head>

<body>
<?php
function datethai($strDate){
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

$bd_id = $_GET["bd_id"];
$sql = "select *
FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
inner join booklist bl on bd.bl_id = bl.bl_id
inner join book b on b.b_id = bl.b_id
inner join bookcategory bc on bc.bc_id = b.bc_id    
inner join member m on m.m_id = bw.m_id  where bd.bd_id='$bd_id'";
$result = mysql_query($sql,$conn)
or die ("Error Script").mysql_error();
$rs = mysql_fetch_array($result);
//post ข้อมูลมาเก็บไว้ที่ตัวแปร
$fullname =$rs["m_name"];
$bw_date =datethai($rs["bw_date"]);
$bw_returndate =datethai($rs["bw_returndate"]);

$b_name =$rs["b_name"];


///ส่วนที่ 1 line แจ้งเตือน จัดเรียงข้อความที่จะส่งเข้า line ไว้ในตัวแปร $message
$header = 'แจ้งกำหนดคืนหนังสือ🔔';

$message =
    $header .
    
    "\n" .
    'ชื่อ: ' .
    $fullname .
    "\n" .
 
    'ต้องคืนหนังสือภายในวันที่: ' .
    $bw_returndate .
   
    "\n" .
    'ชื่อหนังสือ: ' .
    $b_name .
    "\n";


///ส่วนที่ 2 line แจ้งเตือน  ส่วนนี้จะทำการเรียกใช้ function sendlinemesg() เพื่อทำการส่งข้อมูลไปที่ line
sendlinemesg();
header('Content-Type: text/html; charset=utf8');
$res = notify_message($message);



///ส่วนที่ 3 line แจ้งเตือน
function sendlinemesg()
{
    define('LINE_API', "https://notify-api.line.me/api/notify");
    define('LINE_TOKEN', "kjqyRHMDnD650ceX4A6NVd3arz6OKIS462JdUd5cTAo"); //เปลี่ยนใส่ Token ของเราที่นี่

    function notify_message($message)
    {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
echo success_h3("แจ้งเตือนสำเร็จ","showline.php");	
?>
</body>
</html>
