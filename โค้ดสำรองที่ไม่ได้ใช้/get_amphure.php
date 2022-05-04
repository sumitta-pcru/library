<?php
include('connect.php');
$sql = "SELECT * FROM member WHERE ut_id={$_GET['ut_id']}";
$query = mysqli_query($conn, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {
    array_push($json, $result);
}
echo json_encode($json);
