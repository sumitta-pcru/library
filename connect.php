<?php
 $server = "localhost";
 $user = "root";
 $password = "";
 $dbname = "db_book";
 $conn = mysql_connect($server,$user,$password);

 if(!$conn)
    die("1. Can't connect MySQL");

mysql_select_db($dbname,$conn)
    or die("2. Can't Use Databese");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");

?>




