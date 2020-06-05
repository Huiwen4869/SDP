<?php
//global session variable
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    include 'conn.inc.php';

    //email or user name to sign in
    $ename = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if (empty($ename)) {
        echo ("<script> alert('Empty username!'); </script>");
        echo ("<script> window.location.replace('../elogin.php');</script>");
        exit();
    } elseif (empty($pass)) {
        echo ("<script> alert('Empty Password'); </script>");
        echo ("<script> window.location.replace('../elogin.php');</script>");
        exit();
    } else {
        $sql = "SELECT * FROM employee WHERE emp_name=? OR emp_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("<script> alert('SQL error 1'); </script>");
            echo ("<script> window.location.replace('../elogin.php');</script>");

            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $ename, $ename);
            mysqli_stmt_execute($stmt);
            //sql result will insert to this variable from the select statement
            $result = mysqli_stmt_get_result($stmt);
            //check do we get the data from database

            if ($row = mysqli_fetch_assoc($result)) {
                //grab password from database
                $passcheck = password_verify($pass, $row['emp_password']);
                if ($passcheck == false) {
                    echo ("<script> alert('Wrong password!!!'); </script>");
                    echo ("<script> window.location.replace('../elogin.php');</script>");
                    exit();
                } elseif ($passcheck == true) {

                    $_SESSION['ename'] = $row['emp_name'];
                    $_SESSION['eid'] = $row['emp_id'];
                    $_SESSION['loggedin1'] = true;
                    $_SESSION['role'] = $row['manager_id'];

                    if ($_SESSION['role'] == "1") {
                        echo ("<script> alert('Welcome Admin!'); </script>");
                        echo ("<script> window.location.replace('../emp-dashboard.php');</script>");
                    } else {
                        echo ("<script> alert('Welcome $ename'); </script>");
                        echo ("<script> window.location.replace('../emp-dashboard.php');</script>");
                    }
                }
            } else {
                echo ("<script> alert('User does not exist'); </script>");
                echo ("<script> window.location.replace('../elogin.php');</script>");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo ("<script> window.location.replace('../emp-dashboard.php');</script>");
    exit();
}
