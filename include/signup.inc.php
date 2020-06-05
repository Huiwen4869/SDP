<?php
if($_SERVER['REQUEST_METHOD']=="POST") {
        include 'conn.inc.php';

        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $password=mysqli_real_escape_string($conn,$_POST['password']);
        $confirmedPassword=mysqli_real_escape_string($conn,$_POST['c_password']);
        $date = date("Y-m-d");



        if( empty($username)|| empty($email)|| empty($password)|| empty($confirmedPassword) ) {
            
            echo ("<script> alert('Please fill in the field'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");

            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
            echo ("<script> alert('Invalid email and username'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");
            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo ("<script> alert('Invalid email'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");
            exit();

        }
        elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            echo ("<script> alert('Invalid user name'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");
            exit();

        }
        elseif ($password !== $confirmedPassword) {
            echo ("<script> alert('Password does not match'); </script>");
            echo ("<script> window.location.replace('../login.php');</script>");
            exit();
        }
        else{
            $sql="select cus_name FROM customer WHERE cus_name=?";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo ("<script> alert('SQL error 1'); </script>");
                exit(); 
            }
        else{
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck=mysqli_stmt_num_rows($stmt);
            if ($resultCheck>0){
                echo ("<script> alert('Username has been taken'); </script>");
                echo ("<script> window.location.replace('../login.php');</script>");
                exit(); 
            }
            else{

                $sql="INSERT INTO customer (cus_name, cus_email,cus_password,cus_date) VALUES (?, ?, ?,?);";
                $stmt=mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo ("<script> alert('SQL error 2'); </script>");
                exit(); 
            }
            else{
                $hashedpass= password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ssss",$username,$email,$hashedpass,$date);
                mysqli_stmt_execute($stmt);
                echo ("<script> alert('Sucess! welcome $username'); </script>");
                 echo ("<script> window.location.replace('../login.php');</script>");
                exit(); 
            }
        }
    }
}
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("location:../login.php");
                exit(); 
}
?>