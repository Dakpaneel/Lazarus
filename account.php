<?php
session_start();
require 'backend/dbconn.php';
$q = ""; // Define query

// error messages
$r_error = false;
$i_error = false;
$c_error = false;
$p_error = false;

if($_GET["page"] == "logout"){
    session_destroy();
    header("location: index.php");
}
if(isset($_POST["submit"])){
    if($_GET["page"] == "login"){// Log in
        $i_error = false;
        $username = htmlspecialchars($_POST["username"]);
        $password = $_POST["password"];
        $password_hashed = password_hash($password,PASSWORD_DEFAULT);
        $SQL = "SELECT `username`, `password` FROM `users` WHERE `username` = ?";
        if($stmt = $dbconn->prepare($SQL)){
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
    }else if($_GET["page"] == "register"){// Register
        // Username
        $username = trim($_POST["username"], " \t.");
        // Email
        $email = $_POST["email"];
        // Password
        $password = $_POST["password"];
        $c_password = $_POST["confirmpassword"];
        // Avatar
        //$img_location = "img/avatars/";
        //$img_location = $img_location . basename($_FILES["avatar"]["name"]);
        //$img_type = pathinfo($img_location,PATHINFO_EXTENSION);

        if($password !== $c_password){
            $c_error = true;
        }elseif(strlen(trim($_POST['password'])) < 6){
            $p_error = true;
        }else{
            $password_hashed = password_hash($password,PASSWORD_DEFAULT);
            $ucheck=$dbconn->prepare("SELECT `username`, `password` FROM `users` WHERE `username` = ?");
            $ucheck->bind_param('s', $username);
            if($ucheck->execute()){
                $ucheck->store_result();
                if($ucheck->num_rows >= 1){
                    $ucheck->fetch();
                    $r_error = true;
                }else{
                    $stmt=$dbconn->prepare("INSERT INTO `users` (`username`,`email`,`password`) VALUES (?,?,?)");
                    $stmt->bind_param('sss', $username, $email, $password_hashed);
                    $stmt->execute();
                    $stmt->close();
                    header("location: ".$_SERVER['PHP_SELF']."?page=login");
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
	    <title>
        <?php
        switch($_GET["page"]){
            case "profile":     // Shows logged in users profile
                echo $_SESSION["username"];
                break;
            case "login":       // Shows log in form
                echo 'Log in';
                break;
            case "register":    // Shows register form
                echo 'Register';
                break;
            
            }
        ?>
        </title>
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
                        if(isset($_SESSION['username'])){
                            echo '<i class="fas fa-user-check fav-btn"></i>';
                        }else{
                            echo '<i class="fas fa-user fav-btn"></i>';
                        }
                    ?>
                </div>
                <div class="nav-dropdown">
                    <?php
                        if(isset($_SESSION['username'])){
                            // Profile link
                            echo '<a href="account.php?page=profile">';
                            echo '<p class="';
                            if($_GET["page"] == "profile"){
                                echo "page-active";
                            }
                            echo '">'.$_SESSION['username'].'</p>';
                            echo '</a>';
                            // Logout link
                            echo '<a href="account.php?page=logout">';
                            echo '<p class="';
                            if($_GET["page"] == "logout"){
                                echo "page-active";
                            }
                            echo '">Log out</p>';
                            echo '</a>';
                        }else{
                            // Login link
                            echo '<a href="account.php?page=login">';
                            echo '<p class="';
                            if($_GET["page"] == "login"){
                                echo "page-active";
                            }
                            echo '">Log in</p>';
                            echo '</a>';
                            // Register link
                            echo '<a href="account.php?page=register">';
                            echo '<p class="';
                            if($_GET["page"] == "register"){
                                echo "page-active";
                            }
                            echo '">Register</p>';
                            echo '</a>';
                        }
                    ?>
                </div>
            </nav> <!-- End base -->
            <header class="feedback">
            <?php
                if($r_error == true){
                    echo "<div class='code'>";
                    echo "<div class='false'>";
                    echo "<p>Gebruiker bestaat al!</p>";
                    echo "</div>";
                    echo "</div>";
                }elseif(isset($_GET["ucreated"]) && !$i_error == true){
                    echo "<div class='code'>";
                    echo "<div class='true'>";
                    echo "<p>Uw account is aangemaakt!</p>";
                    echo "</div>";
                    echo "</div>";
                }elseif($i_error == true){
                    echo "<div class='code'>";
                    echo "<div class='false'>";
                    echo "<p>U heeft de verkeerde gegevens ingevuld.</p>";
                    echo "</div>";
                    echo "</div>";
                }elseif($p_error == true){
                    echo "<div class='code'>";
                    echo "<div class='false'>";
                    echo "<p>Wachtwoord moet minimaal 6 tekens bevatten.</p>";
                    echo "</div>";
                    echo "</div>";
                }elseif($c_error == true){
                    echo "<div class='code'>";
                    echo "<div class='false'>";
                    echo "<p>Wachtwoorden komen niet overeen.</p>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
            <header>
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
                        if($_GET["page"] == "register"){
                            echo '<p>Email</p>';
                            echo '<input required type="email" name="email" placeholder="" value="">';
                            echo '<div class="msg" id="msg">&nbsp;</div>';
                        }
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