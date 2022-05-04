<?php
include 'connect.php';
include 'script.php';


function datethai($strDate){
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

$datenow = date_create(date('Y-m-d'));

$sql = "select *
        FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
        inner join booklist bl on bd.bl_id = bl.bl_id
        inner join book b on b.b_id = bl.b_id
        inner join bookcategory bc on bc.bc_id = b.bc_id    
        inner join member m on m.m_id = bw.m_id  where bd.bd_status='1' ";
$result1 = mysql_query($sql,$conn);
$i=0;
while ($row = mysql_fetch_array($result1)) {
    $bd_id[$i] = $row['bd_id'];
    $bw_returndate[$i] = date_create($row['bw_returndate']);
    $datediff[$i]=date_diff($datenow,$bw_returndate[$i]);
    $diff[$i] = $datediff[$i]->format('%a');
 
    $sql1 = "select *
                FROM  borrowingdetails bd inner join borrowing bw  on bd.bw_id = bw.bw_id  
                inner join booklist bl on bd.bl_id = bl.bl_id
                inner join book b on b.b_id = bl.b_id
                inner join bookcategory bc on bc.bc_id = b.bc_id    
                inner join member m on m.m_id = bw.m_id where bd.bd_id='".$bd_id[$i]."' and  bd.bd_status='1' ";
                $result2 = mysql_query($sql1,$conn)
                or die ("ไม่สามารถประมวลผลคำสั่งได้").mysql_error();
                    // while ($rs = mysql_fetch_array($result2)){
                $rs = mysql_fetch_array($result2);


            if($diff[$i]==2){
               
                //post ข้อมูลมาเก็บไว้ที่ตัวแปร
                $fullname =$rs["m_name"];
                $bw_date =datethai($rs["bw_date"]);
                $bw_returndatee =datethai($rs["bw_returndate"]);
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
                        $bw_returndatee .
                    
                        "\n" .
                        'ชื่อหนังสือ: ' .
                        $b_name .
                        "\n";
                    
                    
                // }
                     
            }
            $i++;     
    }
    

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

?>