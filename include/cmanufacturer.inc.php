<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include 'conn.inc.php';
    
    $manuname= mysqli_real_escape_string($conn,$_POST['manuname']);
    $manuphone = mysqli_real_escape_string($conn,$_POST['manuphone']);
    $manuemail = mysqli_real_escape_string($conn,$_POST['manuemail']);
    

    if(empty($manuname)||empty($manuphone)||empty($manuemail)){
        echo ("<script> alert('Please fill in the field'); </script>");
        echo ("<script> window.location.replace('../cmodel.php');</script>");

            exit();
    }
    elseif(!filter_var($manuemail, FILTER_VALIDATE_EMAIL)){
        echo ("<script> alert('Invalid email'); </script>");
        echo ("<script> window.location.replace('../cmanufacturer.php');</script>");
        exit();
    }
    else{
        $sql="select man_name FROM manufacturer WHERE man_name=?";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo ("<script> alert('SQL error 1'); </script>");
            exit(); 
        }
    else{
        mysqli_stmt_bind_param($stmt,"s",$manuname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck=mysqli_stmt_num_rows($stmt);
        if ($resultCheck>0){
            echo ("<script> alert('Manufacturer has been existed'); </script>");
            echo ("<script> window.location.replace('../cmanufacturer.php');</script>");
            exit(); 
        }
    else{

        $sql="INSERT INTO manufacturer (man_name,man_phone,man_email) VALUE (?,?,?); ";
        $stmt= mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo("<script> alert('SQL error 2'); </script>");
            exit(); 
            }
            else{
                mysqli_stmt_bind_param($stmt,"sss",$manuname,$manuphone,$manuemail);
                mysqli_stmt_execute($stmt);
                echo ("<script> alert('Manufacturer added sucessfully'); </script>");
                echo ("<script> window.location.replace('../cstock.php');</script>");
                exit(); 
                }
        
        }
    }
}
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
     echo ("<script> window.location.replace('../cmanufacturer.php');</script>");
}

?>