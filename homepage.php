<?php
	session_start();
	include "cheader.php";
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
		echo ("<script> alert('Pleas log in first!!!'); </script>");
		echo ("<script> window.location.replace('login.php');</script>");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="css/style-cus-index" rel="stylesheet" type="text/css" />
<title>Home | Home Furniture</title>
</head>

<body>

	<div class="home-content">
		<div class="slideshow-container">
			<div class="slide-content fade">
			  <img src="img/f3.jpg" style="width:100%" />
			</div>
			
			<div class="slide-content fade">
			  <img src="img/f2.jpg" style="width:100%" />
			</div>
			
			<div class="slide-content fade">
			  <img src="img/f2.png" style="width:100%" />
			</div>
			
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
		
			<div>
			  <span class="dot" onclick="currentSlide(1)"></span> 
			  <span class="dot" onclick="currentSlide(2)"></span> 
			  <span class="dot" onclick="currentSlide(3)"></span> 
			</div>
		</div>
	</div>
	
	<script>
		var slideIndex = 1;
		var timer = null;
		showSlides(slideIndex);
		
		function plusSlides(n) {
		  clearTimeout(timer);
		  showSlides(slideIndex += n);
		}
				
		function currentSlide(n) {
		  clearTimeout(timer);
		  showSlides(slideIndex = n);
		}
		
		function showSlides(n) {
		  var i;
		  var slides = document.getElementsByClassName("slide-content");
		  var dots = document.getElementsByClassName("dot");
		  if (n==undefined){n = ++slideIndex}
		  if (n > slides.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
		      slides[i].style.display = "none";
		  }
		  for (i = 0; i < dots.length; i++) {
		      dots[i].className = dots[i].className.replace(" activeSlide", "");
		  }
		  slides[slideIndex-1].style.display = "block";
		  dots[slideIndex-1].className += " activeSlide";
		  timer = setTimeout(showSlides, 8000);
		} 
	</script>
	
	<center>
		<div id="abt-us-container">
			<div class="abt-content">
				<p class="abt-title">About Us</p>
				<p>
					Since 2009, <span class="cpy-name">home furniture</span> has become one of the most well-known home furnishing brands in the world.
					<br />
					We are committed to fulfill customer's satisfication and ead every staff to stay motivated in their respective job area. 
				</p>
			</div>
			
			<div class="abt-grid-container clear">
				<div class="abt-grid box-1">
					<div class="abt-grid-txt">
						modular design
					</div>
				</div>
				<div class="abt-grid box-2">
					<div class="abt-grid-txt">
						good functionality
					</div>
				</div>
				<div class="abt-grid box-3">
					<div class="abt-grid-txt">
						sustainable
					</div>
				</div>
				<div class="abt-grid box-4">
					<div class="abt-grid-txt">
						high quality
					</div>
				</div>
				<div class="abt-grid box-5">
					<div class="abt-grid-txt">
						affordable
					</div>
				</div>
				<div class="abt-grid  box-6 visibility">
					<div class="abt-grid-txt">
						excellent services
					</div>
				</div>
				<div class="abt-grid box-7">
					<div class="abt-grid-txt">
						our business ideas
					</div>
				</div>			
			</div>
		</div>
		
		<div id="home-ess-container">
			<div class="img-box">
				<div class="img-box-color">
					<div class="ess-text">
					    <p class="ess-title">home furniture essentials</p>
					    <div class="ess-link">
					    <a href="#"><i class="fa fa-truck"></i><br />Delivery</a>
					    </div>
					    <div class="ess-link">
					    <a href="#"><i class="fa fa-question-circle"></i><br />FAQ</a>
					    </div>
				  	</div>
				</div>	
			</div>
		</div>
	
	</center>
	
</body>

</html>