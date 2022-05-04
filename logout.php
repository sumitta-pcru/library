<?php

    session_start();
    unset($_SESSION["valid_uname"]);
    unset($_SESSION["valid_pwd"]);
    session_destroy();

?>
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
<script>
    Swal.fire({
        icon: 'success',
        title: 'ออกจากระบบ...',
        text: 'คุณออกจากระบบสำเร็จ',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก'

    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "index1.php";
        }else {
            window.history.back(-1);
        }
    })

</script>
</body>
</html>