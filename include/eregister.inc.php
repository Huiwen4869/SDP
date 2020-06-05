<?php

   if(isset($_POST["submit"])) {
    require 'conn.inc.php';
  
    $ename=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['pass']);
    $cpassword=mysqli_real_escape_string($conn,$_POST['cpass']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $phone=mysqli_real_escape_string($conn,$_POST['phone']);
    $gender=mysqli_real_escape_string($conn,$_POST['gender']);
    $position=mysqli_real_escape_string($conn,$_POST['position']);
   if($position=='manager'){
        $managerid=1;
    }
    else{
        $managerid=0;
    }


    
$fileName= $_FILES['file']['name'];
$fileTmpName= $_FILES['file']['tmp_name'];
$fileSize= $_FILES['file']['size'];
$fileError= $_FILES['file']['error'];
$fileType= $_FILES['file']['type'];


//header("location:../ucoming_movie.php?error= empty field name=$fileName tmpname=$fileTmpName")
//which file can upload
$fileExt =explode('.',$fileName);
$fileActualExt = strtolower(end($fileExt));

$allowed= array('jpg','jpeg','png','pdf');
if(in_array($fileActualExt,$allowed)){
    if($fileError === 0){
        if($fileSize < 5000000){
            $fileNewname =uniqid().".".$fileActualExt;
            
            $fileDestination= '../eimg/'.$fileNewname;
            move_uploaded_file($fileTmpName,$fileDestination);


        }
        else{
            echo"File too big";
        }
    }
    else"Uploading Error!!";
}
else{
    echo"Wrong files type!";
}
  





    if (empty($ename) || empty($email) || empty($password) || empty($cpassword) || empty($address) || empty($phone) || empty($gender) || empty($position)) {
        echo ("<script> alert('Please fill in the field'); </script>");
         //echo ("<script> window.location.replace('../eregister.php');</script>");
        
        exit();
        }
    
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$ename)){
            echo ("<script> alert('Invalid email and username'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit();
        }
        elseif(!filter_var($phone, FILTER_SANITIZE_NUMBER_INT) && !preg_match("/^[0-9]*$/",$phone)){
            echo ("<script> alert('Invalid phone number'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit();
        }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo ("<script> alert('Invalid email'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit();

        }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/",$ename)){
            echo ("<script> alert('Invalid user name'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit();

        }
    elseif ($password !== $cpassword) {
            echo ("<script> alert('Password does not match'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit();
        }



    
    else{
        $sql = "select emp_name FROM employee WHERE emp_name=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("<script> alert('SQL error 1'); </script>");
            exit();
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck=mysqli_stmt_num_rows($stmt);
        if ($resultCheck>0){
            echo ("<script> alert('Email has been taken'); </script>");
            echo ("<script> window.location.replace('../eregister.php');</script>");
            exit(); 
        }
        else{
            $sql="INSERT INTO employee(emp_name,emp_email,emp_phone,emp_address,emp_gender,emp_password,emp_img,emp_position,manager_id) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo ("<script> alert('SQL error 2'); </script>");
            exit(); 

        }
        else{
            $hashedpass= password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt,"ssisssssi",$ename,$email,$phone,$address,$gender,$hashedpass,$fileNewname,$position,$managerid);
            mysqli_stmt_execute($stmt);
            echo ("<script> alert('Sucess!'); </script>");
            echo ("<script> window.location.replace('../emp-dashboard.php');</script>");
            exit(); 
        }
    }
}
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else{
header("location:../elogin.php");
            exit(); 
}









?>