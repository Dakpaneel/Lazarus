<?php
require 'backend/dbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
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
        <link href="css/base.css" rel="stylesheet" type="text/css">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <nav> <!-- Start base -->
                <div class="nav-home">
                    <a href="index.php">
                        <i class="fas fa-home fav-btn"></i>
                    </a>
                </div>
                <div class="nav-user dropdown-btn">
                    <i class="fas fa-user fav-btn"></i>
                </div>
                <div class="nav-dropdown">
                    <a href="account.php?page=profile">
                        <p>Profile</p>  
                    </a>
                    <a href="account.php?page=login">
                        <p>Log in</p>
                    </a>
                    <a href="account.php?page=register">
                        <p>Register</p>
                    </a>
                    <a href="account.php?page=logout">
                        <p>Log out</p>
                    </a>
                </div>
            </nav> <!-- End base -->
            <main class="grid-container">

            </main>
            <footer> <!-- Start base -->
                <div class="title">&copy;Bradley Oosterveen / 2018</div>
            </footer> <!-- End Base -->
        </div>
    </body>
    <script src="js/scripts.js">
    </script>
</html>