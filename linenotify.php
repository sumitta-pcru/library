<meta charset="utf-8">
<?php
include 'connect.php';
include 'script.php';

sendlinemesg();
        header('Content-Type: text/html; charset=utf8');
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
 $text = '';

            
          
// if($result1){
    $header = 'แจ้งกำหนดคืนหนังสือ🔔';
    $text  .= $header."\n";
    $check = 0;
        while ($row = mysql_fetch_array($result1)) {
        
                    
            $bd_id[$i] = $row['bd_id'];
            $bw_returndate[$i] = date_create($row['bw_returndate']);
            $datediff[$i]=date_diff($datenow,$bw_returndate[$i]);
            $diff[$i] = $datediff[$i]->format('%a');
            $bw_returndate1[$i] =datethai($row['bw_returndate']);
        


                        // exit();
                        
                    if($diff[$i]==2){
                    
                        $text  .= "ชื่อ : ".$row["m_name"]."\n";
                        $text  .= "ชื่อหนังสือ : ".$row["b_name"]."\n";
                        $text  .= "ต้องคืนหนังสือภายในวันที่ : ".$bw_returndate1[$i]."\n";
                        $text  .= "\n";
                        $check++;
                    }
            $i++; 
            
            }   
if($check>0){
    notify_message($text);
}
             
    
        
    
   
        // }
       
    

      ///ส่วนที่ 2 line แจ้งเตือน  ส่วนนี้จะทำการเรียกใช้ function sendlinemesg() เพื่อทำการส่งข้อมูลไปที่ line
        
        // $res = notify_message($text);
    
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