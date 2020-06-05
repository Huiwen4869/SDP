<?php
include "header.php";
?>


<html>

<head>
    <title>Create Manufacturer</title>
    <link rel="stylesheet" href="css/asset.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet">
    <?php cssAndBootstrap(); ?> 

</head>

<body>
<?php navbar();?>
	<center>
	    <div class="container1" style="left:150%">
	        <h1> Create Manufacturer </h1>
	
	        <form action="include/cmanufacturer.inc.php" method="post" >
	        
	            <div>
	            <label>
	                Manufacturer Name:
	           </label>
	            </div>
	            <div class="fld">
	                <input type="text" name="manuname" id="" placeholder="Please enter Name">
	            </div>
	            <div style="padding-top:20px">
	            <label>
	                Manufacturer Phone Number:
	            </label>
	            </div>
	            <div class="fld">
	                <input type="text" name="manuphone" id="" placeholder="Please enter phone number">
	            </div>
	
				<div style="padding-top:20px">
	            <label>
	                Manufacturer Email:
	            </label>
	            </div>
	            <div class="fld">
	                <input type="text" name="manuemail" id="" placeholder="Please enter email">
	            </div>
	            <input type="submit" value="submit" />
	        </form>
	
	    </div>
	</center>

</body>

</html>