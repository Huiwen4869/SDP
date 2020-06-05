<?php
include "header.php";
session_start();
if (isset($_SESSION['loggedin1']) && $_SESSION['loggedin1'] == true) {

        
} else {
    echo ("<script> alert('Pleas log in first!!!'); </script>");
    echo ("<script> window.location.replace('elogin.php');</script>");}
?>
<html>

<head>
    <title>Create New Stock</title>
    <link rel="stylesheet" href="css/asset.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet">
    <?php cssAndBootstrap(); ?> 

</head>

<body>
<?php navbar();?>
    <div class="container1" style="left:150%">
        <h1> Create New Stock </h1>

        <form method="POST" action="include/cstock.inc.php" enctype="multipart/form-data" >


            <div class="title">
	            <label>
	                Stock Name:
	            </label>
            </div>
            <div class="fld">
                <input type="text" name="sname" id="" placeholder="Please enter Name">
            </div>
        	<div class="title">
	            <label>
	                Category:
	            </label>
            </div>
            <div class="fld">
            	<select name="category" name="category" style="background:rgb(44, 89, 135)" >
                    <option>Please Select</option>
                    <?php
		              include("include/conn.inc.php");
		
		             
		              $sql="SELECT cat_name FROM category ";
		              
		              $query_sql=mysqli_query($conn,$sql);
		
		              while($row=mysqli_fetch_assoc($query_sql)){
		                $category=$row['cat_name'];
		                
		                $_SESSION['catid'] = $row['cat_id'];
		                echo "<option value='$category'>$category </option>";
		              }
		
		              ?>
                </select>
                <input type="submit" value="New" name="ccategory" style="width:20%">
            </div>
            <div class="title">
	            <label>
	                Manufacturer:
	            </label>
            </div> 
            <div class="fld">
            <select name="manufacturer" name="manufacturer" style="background:rgb(44, 89, 135)">
                <option>Please Select</option>
                    <?php
              include("include/conn.inc.php");

             
              $sql="SELECT * FROM manufacturer ";
              
              $query_sql=mysqli_query($conn,$sql);

              while($row=mysqli_fetch_assoc($query_sql)){
                $manufacturer=$row['man_name'];
                $_SESSION['manid'] = $row['man_id'];
                echo "<option value='$manufacturer'>$manufacturer </option>";
              }

              ?>
              <input type="submit" value="New" name="cmanufacturer" style="width:20%">
            </select>
            </div>
           	<div class="title">
	            <label style="color: white;">
	                Purchase Date:
	            </label>
            </div>
            <div class="fld">
                <input type="date" name="pdate" id="" placeholder="Please enter purchase date">
            </div>
			<div class="title">
	            <label style="color: white;">
	                Purchase Cost:
	            </label>
            </div>
            <div class="fld">
                <input type="text" name="cost" id="" placeholder="Please enter purchase cost">
            </div>
			<div class="title">
	            <label style="color: white;">
	                Product Description:
	            </label>
            </div>
            <div class="fld">
                <input type="section" name="pdescribe" id="" placeholder="Please enter product description">
            </div>
            <div class="title">
	            <label>
	                Price:
	            </label>
            </div>
            <div class="fld">
                <input type="text" name="price" id="" placeholder="Please enter Price">
            </div>
            <div class="title">
	            <label>
	                Height:
	            </label>
            </div>
            <div class="fld">
                <input type="text" name="height" id="" placeholder="Please enter Height">
            </div>
			<div class="title">
	            <label>
	                Width:
	            </label>
            </div>
            <div class="fld">
                <input type="text" name="width" id="" placeholder="Please enter Width">
            </div>
			<div class="title">
            	<label> 
            		Upload Image
            	</label>
            </div>
            <br>
            
            <input type="file" name="file" id="file">  
            <input type="submit" name="create" value="Submit">
        </form>
	</div>
</body>

</html>