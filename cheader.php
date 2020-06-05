<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="css/style-cheader.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<div class='container'>
		<a href="homepage.php"><img class='logo-img' src='img/logo.png' width='255px' height='95%' ALT='align box' ALIGN=CENTER /></a>
		
		<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
		<div class="topnav">
			<ul>
				
				<li>
					<a href="view.php"><i class="fa fa-shopping-bag nav-icon" style="font-size:26px;margin-top:1px;margin-right:-15px"></i></a>
				</li>
				<li>
					<a href="cfeedback.php"><i class="fa fa-comments nav-icon" style="margin-right:-20px"></i></a>
				</li>
				<li>
					<a href="cart.php?uid=<?php echo $_SESSION['userid']; ?>"><i class="fa fa-shopping-cart nav-icon"></i></a>
				</li>
					<li class="sub-menu">
						<i class="fa fa-user nav-icon"></i>
						<ul>
							<li class="">
								<div class="nav-submenu-avatar-container">
									<img src="<?php echo $_SESSION['userimg']; ?>" alt="avatar" />
								</div>
								<p class="avatar-name"><?php echo $_SESSION['user']; ?></p>
								<div class="submenu-avatar-function">
									<a href="profile.php?uid=<?php echo $_SESSION['userid']; ?>">My Profile</a>
									<a href="bought.php">My Purchases</a>
									<a href="include/logout.inc.php">Logout</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		<?php endif; ?>
		
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('ul li').click(function(){
					$(this).siblings().removeClass('active');
					$(this).toggleClass('active');
				})
			})
		</script>
	</div>
	
</body>

</html>
