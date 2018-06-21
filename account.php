<?php
session_start();
require 'backend/dbconn.php';
$q = ""; // Define query

// error messages
$r_error = false;
$i_error = false;
$c_error = false;
$p_error = false;

if(isset($_GET["page"])){
    switch($_GET["page"]){
        case "profile":     // Shows logged in users profile
            
            break;
        case "login":       // Shows log in form
            break;
        case "register":    // Shows register form

            break;
        case "logout":      // Let's user log out
            session_destroy();
            header("location: index.php");
            break;
        
    }
}
if(isset($_POST["submit"])){
    if($_GET["page"] == "login"){
        $i_error = false;
        $username = htmlspecialchars($_POST["username"]);
        $password = $_POST["password"];
        $password_hashed = password_hash($password,PASSWORD_DEFAULT);
        $SQL = "SELECT `username`, `password` FROM `users` WHERE `username` = ?";
        if($stmt = $conn->prepare($SQL)){
            $stmt->bind_param("s", $username);
            $stmt->bind_result($username, $password_hashed);
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $stmt->fetch();
                    if(password_verify($password, $password_hashed)){
                        session_start();
                        $_SESSION['username'] = $_POST['username'];
                        header("location: index.php");
                    }else{
                        // password
                        $i_error = true;
                    }
                }else{
                    // username
                    $i_error = true;
                }
            }
        }
        $stmt->close();
    }else if($_GET["page"] == "register"){
        // Username
        $username = trim($_POST["username"], " \t.");
        // Email
        $email = $_POST["email"];
        // Password
        $password = $_POST["password"];
        $c_password = $_POST["confirmpassword"];
        // Avatar
        $img_location = "img/avatars/";
        $img_location = $img_location . basename($_FILES["avatar"]["name"]);
        $img_type = pathinfo($img_location,PATHINFO_EXTENSION);

        if($password !== $c_password){
            $c_error = true;
        }elseif(strlen(trim($_POST['password'])) < 6){
            $p_error = true;
        }else{
            $password_hashed = password_hash($password,PASSWORD_DEFAULT);
            $ucheck=$conn->prepare("SELECT `username`, `password` FROM `users` WHERE `username` = ?");
            $ucheck->bind_param('s', $username);
            if($ucheck->execute()){
                $ucheck->store_result();
                if($ucheck->num_rows >= 1){
                    $ucheck->fetch();
                    $r_error = true;
                }else{
                    $stmt=$conn->prepare("INSERT INTO `users` (`username`,`email`,`password`) VALUES (?,?,?)");
                    $stmt->bind_param('sss', $username, $email, $password_hashed);
                    $stmt->execute();
                    $stmt->close();
                    header("location: ".$_SERVER['PHP_SELF']."?ucreated");
                }

            }
        }
    }
}
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
                        <p class="<?php if($_GET["page"] == "profile"){echo "page-active";} ?>">Profile</p>  
                    </a>
                    <a href="account.php?page=login">
                        <p class="<?php if($_GET["page"] == "login"){echo "page-active";} ?>">Log in</p>
                    </a>
                    <a href="account.php?page=register">
                        <p class="<?php if($_GET["page"] == "register"){echo "page-active";} ?>">Register</p>
                    </a>
                    <a href="account.php?page=logout">
                        <p class="<?php if($_GET["page"] == "logout"){echo "page-active";} ?>">Log out</p>
                    </a>
                </div>
            </nav> <!-- End base -->
            <main>
                <?php
                    if($_GET["page"] == "login" OR $_GET["page"] == "register"){
                        echo '<form class="accountform" name="accountform" method="POST" enctype="multipart/form-data" action="">';
                        echo '<div class="legend">';
                        if(($_GET["page"]) == "register"){
                            echo '<p>Register.</p>';
                        }else if(($_GET["page"]) == "login"){
                            echo '<p>Log in.</p>';
                        }
                        echo '</div>';
                        echo '<p>Username</p>';
                        echo '<input required type="text" name="username" placeholder="" value="">';
                        echo '<div class="msg" id="msg">&nbsp;</div>';
                        echo '<div class="title"><p>Password<p></div>';
                        echo '<input id="password" required type="password" name="password" placeholder="" onkeyup="validate()">';
                        if($_GET["page"] == "register"){
                            echo '<div class="title"><p>Repeat</p></div>';
                            echo '<input id="confirmpassword" required type="password" name="confirmpassword" placeholder="" onkeyup="validate()">';
                        }
                        echo '<input type="submit" name="submit" value=">>>">';
                        if($_GET["page"] == "register"){
                            echo '<div class="link"><p>Already have an account? ';
                            echo '<a href="'.$_SERVER['PHP_SELF'].'?page=login">Log in.</a>';
                            echo '</p></div>';
                        }else{
                            echo '<div class="link"><p>Don\'t have an account? ';
                            echo '<a href="'.$_SERVER['PHP_SELF'].'?page=register">Register now.</a>';
                            echo '</p></div>';
                        }
                        echo '</form>';
                    }
                ?>
            </main>
            <footer> <!-- Start base -->
                <div class="title">&copy;Bradley Oosterveen / 2018</div>
            </footer> <!-- End Base -->
        </div>
    </body>
    <script src="js/scripts.js">
    </script>
</html>