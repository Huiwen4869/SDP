<?php
//global session variable
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include 'conn.inc.php';

    //email or user name to sign in
    $mailuid = mysqli_real_escape_string($conn, $_POST['username']);
    $lpass = mysqli_real_escape_string($conn, $_POST['pass']);

    if (empty($mailuid)) {
        echo ("<script> alert('Empty username!'); </script>");
        echo ("<script> window.location.replace('../login.php');</script>");
        exit();
    } elseif (empty($lpass)) {
        echo ("<script> alert('Empty Password'); </script>");
        echo ("<script> window.location.replace('../login.php');</script>");
        exit();
    } else {
        $sql = "SELECT * FROM customer WHERE cus_name=? OR cus_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("<script> alert('SQL error 1'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");

            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            //sql result will insert to this variable from the select statement
            $result = mysqli_stmt_get_result($stmt);
            //check do we get the data from database


            if ($row = mysqli_fetch_assoc($result)) {
                //grab password from database
                $passcheck = password_verify($lpass, $row['cus_password']);
                if ($passcheck == false) {
                    echo ("<script> alert('Wrong password!!!'); </script>");
                    echo ("<script> window.location.replace('../login.php');</script>");
                    exit();
                } elseif ($passcheck == true) {

                    $_SESSION['user'] = $row['cus_name'];
                    $_SESSION['userid'] = $row['cus_id'];
                    $_SESSION['userimg'] = $row['cus_img'];
                    $_SESSION['loggedin'] = true;
                    //$_SESSION['role'] = $row['cus_role'];
                    echo ("<script> alert('Welcome $mailuid'); </script>");
                    echo ("<script> window.location.replace('../homepage.php');</script>");
                }
            } else {
                echo ("<script> alert('Wrong Password'); </script>");
                echo ("<script> window.location.replace('../login.php');</script>");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo ("<script> window.location.replace('../main.php');</script>");
    exit();
}
