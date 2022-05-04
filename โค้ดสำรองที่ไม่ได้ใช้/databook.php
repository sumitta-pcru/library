<?php
include 'connect.php';
mysql_select_db('db_book'); 
$w= $_GET['term'];


 $sql = "SELECT b_name from book b inner join booklist bl on bl.b_id = b.b_id WHERE b_name LIKE '{$w}%' ";
 $rs = mysql_query($sql); 
 $json = array();
while($row = mysql_fetch_assoc($rs)){
    $json[] = $row['b_name'];
    $json[] = $row['bl_id'];
}

mysql_free_result($rs);
mysql_close($conn);
$json = json_encode($json);
echo $json;
?>