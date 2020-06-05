<?php
   session_start();
   include 'conn.inc.php';
   if (isset($_POST['create'])) {
    
    $sname=mysqli_real_escape_string($conn,$_POST['sname']) ;
    $manufacturer =mysqli_real_escape_string($conn,$_POST['manufacturer']);
    $category =mysqli_real_escape_string($conn,$_POST['category']);
    $pdate =mysqli_real_escape_string($conn,$_POST['pdate']);
    $pcost =mysqli_real_escape_string($conn,$_POST['cost']);
    $pdescribe = mysqli_real_escape_string($conn,$_POST['pdescribe']);
    $price =mysqli_real_escape_string($conn,$_POST['price']);
    $width =mysqli_real_escape_string($conn,$_POST['width']);
    $height =mysqli_real_escape_string($conn,$_POST['height']);
    $quantity=1;
    
    $sql= "SELECT man_id FROM manufacturer WHERE man_name ='$manufacturer'";
    $result = mysqli_query($conn,$sql); 
    $row = mysqli_fetch_array($result);
    $id = $row['man_id'];

    $sql2 ="SELECT cat_id FROM category WHERE cat_name='$category'";
    $result2 = mysqli_query($conn,$sql2);
    $row2= mysqli_fetch_array($result2);
    $id2=$row2['cat_id'];
    
   

    

$mimg=$_FILES['file'];
    
$fileName= $mimg['name'];
$fileTmpName= $mimg['tmp_name'];
$fileSize= $mimg['size'];
$fileError= $mimg['error'];
$fileType= $mimg['type'];


//header("location:../ucoming_movie.php?error= empty field name=$fileName tmpname=$fileTmpName")
//which file can upload
$fileExt =explode('.',$fileName);
$fileActualExt = strtolower(end($fileExt));
$allowed= array('jpg','jpeg','png','pdf');
if(in_array($fileActualExt,$allowed)){
    if($fileError == 0){
        if($fileSize < 5000000){
            $fileNewname =uniqid().".".$fileActualExt;
            
            $fileDestination= '../upload/'.$fileNewname;
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



if(empty($sname)||empty($category)||empty($manufacturer)||empty($pdate)||empty($pcost)||empty($pdescribe)||empty($price)||empty($width)||empty($height)){
    echo ("<script> alert('Please fill in the field'); </script>");
    echo ("<script> window.location.replace('../cstock.php');</script>");

        exit();
}
else {
    $sql = "SELECT stk_name FROM stock WHERE stk_name=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo ("<script> alert('SQL error 1'); </script>");
        exit();
    } 
 
    else {
        $sql = "INSERT INTO stock(stk_img,stk_name,cat_id,cat_name,man_id,man_name,stk_productiondate,stk_cost,stk_price,stk_width,stk_height,stk_description,stk_quantity) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("<script> alert('SQL error 2'); </script>");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssisisssssssi", $fileDestination, $sname,$id2, $category, $id,$manufacturer,$pdate,$pcost,$price,$width,$height,$pdescribe,$quantity);
            mysqli_stmt_execute($stmt);
            echo ("<script> alert('Stock added sucessfully'); </script>");
            echo ("<script> window.location.replace('../cstock.php');</script>");
            exit();
            }
        }
    }
    



} 

if (isset($_POST['cmanufacturer'])) {
    echo ("<script> window.location.replace('../cmanufacturer.php');</script>");

}
if (isset($_POST['ccategory'])) {
    echo ("<script> window.location.replace('../ccategory.php');</script>");


}


?>