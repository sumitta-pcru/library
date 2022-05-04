<?php
include 'connect.php';
mysql_select_db('db_book'); 
$w= $_POST['term'];


 $sql = "SELECT m_id,m_name FROM member WHERE m_name LIKE '{$w}%' ";
 $rs = mysql_query($sql); 
 
while($row = mysql_fetch_assoc($rs)){
    $json = array(
        "name"=>$row['m_name']
    );
    
}

mysql_free_result($rs);
mysql_close($conn);
$json = json_encode($json);
echo $json;
?>