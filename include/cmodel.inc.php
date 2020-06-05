<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include 'conn.inc.php';
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $mnumber = mysqli_real_escape_string($conn, $_POST['mnumber']);
    $manufacturer = mysqli_real_escape_string($conn, $_POST['manufacturer']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    if (empty($mname) || empty($mnumber) || empty($manufacturer) || empty($category)) {
        echo ("<script> alert('Please fill in the field'); </script>");
        echo ("<script> window.location.replace('../cmodel.php');</script>");

        exit();
    } else {
        $sql = "select mname FROM model WHERE mname=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("<script> alert('SQL error 1'); </script>");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $mname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                echo ("<script> alert('Model has been existed'); </script>");
                echo ("<script> window.location.replace('../cmodel.php');</script>");
                exit();
            } else {

                $sql = "INSERT INTO model (mname,mnumber,manufacturer,category) VALUE (?,?,?,?); ";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo ("<script> alert('SQL error 2'); </script>");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $mname, $mnumber, $manufacturer, $category);
                    mysqli_stmt_execute($stmt);
                    echo ("<script> alert('Model added sucessfully'); </script>");
                    echo ("<script> window.location.replace('../main.php');</script>");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo ("<script> window.location.replace('../cmodel.php');</script>");
}
