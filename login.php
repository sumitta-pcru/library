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
$user_status = $_POST['user_status'];
$Staff = 'Staff';
if (!empty($login) && !empty($password)) {
    if ($user_status == '2') {
        $sql = "SELECT * FROM member WHERE m_id = '$login' AND m_pass = '$password' ";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result);
        if ($total) {
            session_start();
            $_SESSION["valid_uname"] = $login;
            $_SESSION["valid_pwd"] = $password;
            $_SESSION["u_stat"] = $user_status;
            mysql_close($conn);
            echo success("ยินดีต้อนรับ",'frm_editmeme.php');
            exit();
        } else {
            echo error("ไม่พบผู้ใช้");
            exit();
        }
    } elseif ($user_status == '1'){
        $sql = "SELECT * FROM member WHERE m_id = '$login' AND m_pass =  '$Staff' ";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result);
        if ($total) {
            session_start();
            $_SESSION["valid_uname"] = $login;
            $_SESSION["valid_pwd"] = $password;
            $_SESSION["u_stat"] = $user_status;
            mysql_close($conn);

            echo success("ยินดีต้อนรับ",'frm_editmestaff.php');
            exit();
        } else {
            echo error("ไม่พบผู้ใช้");
            exit();
        }
    }
} else {
    echo error("ขออภัย...!..กรุณากรอกข้อมูลให้ครบ");
    exit();
}

?>

</body>
</html>