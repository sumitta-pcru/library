<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title> บริการยืม-คืน |โรงเรียนวังโป่งศึกษา </title>
    <link rel="shortcut icon" type="image/x-icon" href="picture/icons.png">
    <?php
    include 'script.php';
    ?>
</head>
<body>
<?php
ob_start();
include "connect.php";
include "alert.php";

$login = $_POST['login'];
$password = $_POST['password'];
$Staff =$_POST['password'];
if (!empty($login) && !empty($password)) {
    if ($login == "Admin" && $password == "Admin") {
        session_start();
            $_SESSION["valid_uname"] = $login;
            $_SESSION["valid_pwd"] = $password;
            mysql_close($conn);
            echo success("ยินดีต้อนรับ",'showmem.php');
            exit();
        } else {
            echo error("ไม่พบผู้ใช้");
            exit();
        }
    }
 else {
    echo error("ขออภัย...!..กรุณากรอกข้อมูลให้ครบ");
    exit();
}

?>

</body>
</html>