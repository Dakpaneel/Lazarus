<?php
session_start();
$session_id = session_id();
require 'backend/dbconn.php';
include 'backend/functions.php';

// Preparing posts
$q = "
SELECT `posts`.`ID`, `posts`.`title`, `posts`.`content`, `posts`.`date`, `users`.`username`, `users`.`UID`, `users`.`avatar` 
FROM `posts` 
INNER JOIN `users` 
ON `posts`.`UID` = `users`.`UID` 
ORDER BY `date` DESC
";
$q=$dbconn->prepare($q);
$q->execute();
$q = $q->get_result();
$row = $q->fetch_all(); 
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
	    <title><?php $x = isset($_SESSION['username']) ? 'Welcome '.$_SESSION['username'].'!' : 'Homepage'; echo $x; ?></title>
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
                    <?php
                        // Changes fontawesome to have a nice little checkmark next to it when logged in.
                        $x = isset($_SESSION['ID']) ? '<i class="fas fa-user-check fav-btn"></i>' : '<i class="fas fa-user fav-btn"></i>';
                        echo $x;
                    ?>
                </div>
                <div class="nav-dropdown">
                    <?php
                        if(isset($_SESSION['username'])){
                            echo '<a href="account.php?page=profile">';
                            echo '<p>'.$_SESSION['username'].'</p>';
                            echo '</a>';
                            echo '<a href="account.php?page=logout">';
                            echo '<p>Log out</p>';
                            echo '</a>';
                        }else{
                            echo '<a href="account.php?page=login">';
                            echo '<p>Log in</p>';
                            echo '</a>';
                            echo '<a href="account.php?page=register">';
                            echo '<p>Register</p>';
                            echo '</a>';
                        }
                    ?>
                </div>
            </nav> <!-- End base -->
            <main class="main-container">
                <?php
                    if(isset($_SESSION['username'])){
                        include 'backend/upload.php';
                    }else{
                        echo '<div class="post-container">';
                        echo '<p class="title">You are not logged in.</p>';
                        echo '</div>';
                    }
                ?>
                <div class="main-posts">
                    <?php
                    if($row){
                        foreach($row as $a0 => $b0){
                            get_article(
                                $b0[0],
                                $b0[1],
                                $b0[2],
                                $b0[3],
                                $b0[4],
                                $b0[6]
                            );
                        }
                    }else{
                        echo '<div class="post-container">';
                        echo '<p class="title">There are currently no posts available.</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </main>
            <footer> <!-- Start base -->
                <div class="title">&copy;Bradley Oosterveen | 2018</div>
            </footer> <!-- End Base -->
        </div>
    </body>
    <script src="js/scripts.js">
    </script>
</html>