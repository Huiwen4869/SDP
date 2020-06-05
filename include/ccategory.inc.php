

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include 'conn.inc.php';

    
    $cname =  mysqli_real_escape_string($conn,$_POST['cname']);
  
   
    if (empty($cname)) {
        echo ("<script> alert('Please fill in all of the field'); </script>");
        echo ("<script> window.location.replace('../ccategory.php');</script>");
    } 

    $sql="SELECT cat_name FROM category WHERE cat_name=?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo ("<script> alert('SQL error 1'); </script>");
        exit(); 
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$cname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck=mysqli_stmt_num_rows($stmt);
    if ($resultCheck>0){
        echo ("<script> alert('Category existed'); </script>");
        echo ("<script> window.location.replace('../ccategory.php');</script>");
    exit(); 
    }
    else{
        $sql = "INSERT INTO category( cat_name) VALUES (?) ";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo ("<script> alert('SQL error 2'); </script>");
        exit(); 
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$cname);
        mysqli_stmt_execute($stmt);
        echo ("<script> alert('Category added sucessfully'); </script>");
         echo ("<script> window.location.replace('../cstock.php');</script>");
        exit(); 
        }
    }
}
mysqli_stmt_close($stmt);
mysqli_close($conn);

}
else{
    header("location:../cstock.php");
                exit(); 
}

if(isset($_POST['delete'])){
    
}


