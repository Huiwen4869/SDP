<?php
include "header.php";
?>


<html>

<head>
    <title>Create Category</title>
    <link rel="stylesheet" href="css/asset.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|PT+Sans&display=swap" rel="stylesheet">
    <?php cssAndBootstrap(); ?> 

</head>

<body>
<?php navbar();?>
	<center>
	    <div class="container1">
	        <h1> Create Category </h1>
	
	        <form action="include/ccategory.inc.php" method="POST" style="display:hidden" >
	                
	            <div>
		            <label>
		                Category Name:
		            </label>
	            </div>
	            <div style="margin-bottom: 10px">
	                <input type="text" name="cname" id="" placeholder="Please enter Category">
	            </div>
	            <input type="submit" value="submit" />
	        </form>
	
    	</div>
    </center>


</body>

</html>