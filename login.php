<?php
require 'backend/connection.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="all">
		<meta name="language" content="English">
		<meta name="author" content="bradley oosterveen">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="copyright" content="Bradley Oosterveen">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="theme-color" content="#ffffff">
	    <title></title>
	    <link href="css/styles.css" rel="stylesheet" type="text/css">
	    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	</head>
	<body>
        <!-- Begin navigation -->
		<nav class="">
			<div class="nav_logo">
				<a class="title" href="index.php">Lazarus</a>
			</div>
			<div class="nav_account">
				<div class="account_items">
					<a class="item title" href="login.php">Inloggen</a> / <a class="item title" href="register.php">Registreren</a>
				</div>
			</div>
        </nav>
        <!-- End navigation -->
        <!-- Begin main -->
        <form class="main container_form" name="loginform" method="POST" enctype="multipart/form-data" action="">
            <main class="main login">
                <div class="title">Username</div>
				<input type="text" name="username" placeholder="Username"><br>
				<div class="title">Password</div>
				<input type="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;"><br>
				<input type="submit" name="submit" value="Log in">
            </main>     
        </form>
        <!-- End main -->
        <!-- Start footer -->
		<footer class="">
			<div class="footer_container">
				<div class="foot_cont_left">
					<a class="l_item_one fitem" href="#">Over ons</a>
					<a class="l_item_two fitem" href="#">Contact</a>
					<a class="l_item_three fitem" href="#">Help</a>
					<a class="l_item_four fitem" href="#">Voorwaarden</a>
				</div>
				<div class="foot_cont_right">
					<a class="r_item_one fitem" href="#">Doneer</a>
					<a class="r_item_two fitem" href="#">Werk voor ons</a>
					<a class="r_item_three fitem" href="#">Regels</a>
					<a class="r_item_four fitem" href="#">Advertering</a>
				</div>
			</div>
		</footer>
		<!-- End footer -->
    </body>
</html>