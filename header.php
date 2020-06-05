<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
</head>

<body>

	<?php

	function cssAndBootstrap()
	{
		echo "    <link rel='stylesheet' href='header.css'>
	<link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' integrity='sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN' crossorigin='anonymous'>";
	}

	function navbar()
	{
		echo "<div class='area'></div>
	<nav id='main-menu' class='main-menu' onmouseover='toggleSidebar()' onmouseout='toggleSidebar()'>
		<ul>
			<li style='margin-top: 0px'>
			    <a href='emp-dashboard.php'>
			        <i class='fa fa-home fa-2x'></i>
			        <span class='nav-text'>
			            Dashboard
			        </span>
			    </a>
			
			</li>
			<li class='has-subnav'>
			    <a href='stock.php'>
			        <i class='fa fa-laptop fa-2x'></i>
			        <span class='nav-text'>
			        	Stock List
			        </span>
			        
			        	<i class='fa fa-caret-down'></i>
			        
			     </a>
					<ul>
						<li><a href='stock.php'><span class='nav-text'>>> Stock</span></a></li>
						
			        	
			        </ul>
			        
			</li>
			<li class='has-subnav'>
			    <a href='#'>
			        <i class='fa fa-list fa-2x'></i>
			        <span class='nav-text'>
			            Update and Delete
			        </span>
			        <i class='fa fa-caret-down'></i>
			     </a>
			        <ul>
						<li><a href='category.php'><span class='nav-text'>>> Category</span></a></li>
						<li><a href='manufacturer.php'><span class='nav-text'>>> Manufacturer</span></a></li>
			        </ul>
			    
			
			</li>

			<li class='has-subnav'>
			    <a href='#'>
			        <i class='fa fa-folder-open fa-2x'></i>
			        <span class='nav-text'>
			            Create New
			        </span>
			        <i class='fa fa-caret-down'></i>
			     </a>
					<ul>
						<li><a href='addstock.php'><span class='nav-text'>>> ADD Existing Stock </span></a></li>
						<li><a href='ccategory.php'><span class='nav-text'>>> Category</span></a></li>
						<li><a href='eregister.php'><span class='nav-text'>>> Employees</span></a></li>
						<li><a href='cmanufacturer.php'><span class='nav-text'>>> Manufacturer</span></a></li>
						<li><a href='cstock.php'><span class='nav-text'>>> Stock</span></a></li>

			        </ul>
			</li>



			<li>
				<a href='orderlist.php'>
			        <i class='fa fa-bar-chart-o fa-2x'></i>
			        <span class='nav-text'>
			            Order List
			        </span>
			    </a>
			</li>




			<li class='has-subnav'>
			<a href='#'>
			<i class='fa fa-info fa-2x'></i>
				<span class='nav-text'>
					Report
				</span>
				<i class='fa fa-caret-down'></i>
			 </a>
				<ul>
					<li><a href='ractivity.php'><span class='nav-text'>>> Activity </span></a></li>
					<li><a href='rcategory.php'><span class='nav-text'>>> Category </span></a></li>
					<li><a href='rcustomer.php'><span class='nav-text'>>> Customer </span></a></li>
					<li><a href='remployee.php'><span class='nav-text'>>> Employee </span></a></li>
					<li><a href='rfeed.php'><span class='nav-text'>>> Feedback </span></a></li>
					<li><a href='rmanufacturer.php'><span class='nav-text'>>> Manufacturer </span></a></li>
					<li><a href='rorders.php'><span class='nav-text'>>> Order </span></a></li>
					<li><a href='rstock.php'><span class='nav-text'>>> Stock </span></a></li>
		
				</ul>
		</li>





		<li style='margin-top: 0px'>
			    <a href='eprofile.php'>
			        <i class='fa fa-user-circle-o' style='font-size:35px'></i>
			        <span class='nav-text'>
			            Profile
			        </span>
			    </a>
			
			</li>




			
			<ul class='logout'>
			<li>
			    <a href='include/logout.inc.php'>
			        <i class='fa fa-power-off fa-2x'></i>
			        <span class='nav-text'>
			            Logout
			        </span>
			    </a>
			</li>
		</ul>
	</nav>
	
	<div class='container'>
		<img class='logo-img' src='img\logo.png' width='255px' height='95%' ALT='align box' ALIGN=CENTER />

	</div>
	
	<div id='right-panel'>
	
	<script>
		var mini = true;

		function toggleSidebar() {
		  if (mini) {
		    console.log('opening sidebar');
		    document.getElementById('main-menu').style.width = '250px';
		    document.getElementById('right-panel').style.marginLeft = '250px';
		    this.mini = false;
		  } else {
		    console.log('closing sidebar');
		    document.getElementById('main-menu').style.width = '60px';
		    document.getElementById('right-panel').style.marginLeft = '60px';
		    this.mini = true;
		  }
		 }	  
	</script>";
	}
	?>


</body>

</html>