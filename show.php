<?php
include "cheader.php";
?>


<html>

<head>
<title>Create Category</title>
<link rel="stylesheet" href="show.css">
<?php cssAndBootstrap(); ?> 

</head>

<body>
	<?php navbar();?>
	    
	    <div id="right-panel">
	    	
	    	<span onclick="openNav()">Category</span>
	 
	    	<div class="grid-container">
	    		<?php include "view.php";?>
	    	</div>
	    
	    </div>
	    
	    <!-- The overlay -->
		<div id="myNav" class="overlay">
		
			<!-- Button to close the overlay navigation -->
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			
			<!--Overlay content -->
	
			<div class="overlay-content">
				<a href="show.php">All</a>
				<a href="show.php?type=sofa">Sofa</a>
				<a href="show.php?type=bed">Bed</a>
				<a href="show.php?type=chair">Chair</a>
				<a href="show.php?type=table">Table</a>
			</div>
		   
		</div>
	
		<script>
			function openNav() {
			  document.getElementById("myNav").style.width = "100%";
			}
			
			function closeNav() {
			  document.getElementById("myNav").style.width = "0%";
			}	
		</script>
 
</body>

</html>