<?php
session_start();
require 'backend/dbconn.php';
include 'backend/functions.php';
$q = "";

// error messages
$r_msg = false;
$i_msg = false;
$c_msg = false;
$p_msg = false;
$f_msg = false;
$s_msg = false;

// Logout
if($_GET["page"] == "logout"){
    session_destroy();
    header("location: index.php");
}

// Log in and register
if(isset($_POST["submit"])){
    if($_GET["page"] == "login"){
        // Log in
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
                        $_SESSION['username'] = $username;
                        $_SESSION["ID"] = $_COOKIE["PHPSESSID"];
                        header("location: ".$_SERVER['PHP_SELF']."?page=profile");
                    }else{
                        // If password is wrong.
                        $i_msg = true;
                    }
                }else{
                    // If username is wrong.
                    $i_msg = true;
                }
            }
        }
        $stmt->close();
    }else if($_GET["page"] == "register"){
        // Register
        $username = trim($_POST["username"], " \t.");
        $email = $_POST["email"];
        $password = $_POST["password"];
        $c_password = $_POST["confirmpassword"];
        $img_location = $dbconn->real_escape_string('u_img/'.$_FILES['avatar']['name']);
        //$img_location = $img_location . basename($_FILES["avatar"]["name"]);
        $img_type = pathinfo($img_location,PATHINFO_EXTENSION);
        $file_types = array( // All allowed file types. The empty string is for when the user does not upload an avatar.
            "jpg","JPG",
            "jpeg","JPEG",
            "png","PNG",
            ""
        );
        $img_standard = array_diff(scandir("u_img/standard"), array('..', '.'));
        if(empty($_FILES['avatar']['name'])){
            $img_location = "u_img/standard/".$img_standard[array_rand($img_standard)];
        }
        // Starts with a few checks
        if($password !== $c_password){
            // Passwords don't match.
            $c_msg = true;
        }elseif(strlen(trim($_POST['password'])) < 6){
            // Password is less than 6 charachters.
            $p_msg = true;
        }elseif(!in_array($img_type,$file_types)){
            // Filetype check. ($file_types array contains all accepted file types.)
            $f_msg = true;
        }elseif($_FILES["avatar"]["size"] > 200000){
            // Filesize check. (2mb in bytes.)
            $s_msg = true;
        }else{
            // From here a query checks if the username entered exists in the database.
            $ucheck=$dbconn->prepare("SELECT `username`, `password` FROM `users` WHERE `username` = ?");
            $ucheck->bind_param('s', $username);
            if($ucheck->execute()){
                $ucheck->store_result();
                if($ucheck->num_rows >= 1){
                    // If the username the user has entered already exists, a message will popup.
                    // The user now has to choose another username.
                    $ucheck->fetch();
                    $r_msg = true;
                }else{
                        $img_location = "u_img/standard/".$img_standard[array_rand($img_standard)];
                        copy($_FILES['avatar']['tmp_name'], $img_location);
                    $password_hashed = password_hash($password,PASSWORD_DEFAULT);
                    $stmt=$dbconn->prepare("INSERT INTO `users` (`username`,`email`,`password`,`avatar`) VALUES (?,?,?,?)");
                    $stmt->bind_param('ssss', $username, $email, $password_hashed, $img_location);
                    $stmt->execute();
                    $stmt->close();
                    header("location: ".$_SERVER['PHP_SELF']."?page=login&ucreated");
                }

            }
        }
    }
}

// Profile

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
                if($r_msg == true){ //
                    r_msg();
                }elseif(isset($_GET["ucreated"]) && !$i_msg == true){
                    i_msg_created();
                }elseif($i_msg == true){
                    i_msg();
                }elseif($p_msg == true){
                    p_msg();
                }elseif($c_msg == true){
                    c_msg();
                }elseif($f_msg == true){
                    f_msg();
                }elseif($s_msg == true){
                    s_msg();
                }
                
            ?>
            <header>
            <main>
                <?php
                    if($_GET["page"] == "login" OR $_GET["page"] == "register"){
                        // If statement seen above loads in all the regular HTML forms which are needed by both the login and register pages.
                        // The next few if statements are for loading specific HTML forms.
                        echo '<form class="accountform" name="accountform" method="POST" enctype="multipart/form-data" action="">';
                        echo '<div class="legend">';
                        if(($_GET["page"]) == "register"){
                            echo '<p>Register.</p>';
                        }else if(($_GET["page"]) == "login"){
                            echo '<p>Log in.</p>';
                        }
                        echo '</div>';
                        echo '<p>Username</p>';
                        echo '<input required type="text" name="username" placeholder="" value="';
                        if(isset($_POST["username"])){
                            echo $_POST["username"]; // So the user doesn't have to re-enter username.
                        }
                        echo '">';
                        if($_GET["page"] == "register"){
                            echo '<p>Email</p>';
                            echo '<input required type="email" name="email" placeholder="" value="';
                            if(isset($_POST["email"])){
                                echo $_POST["email"]; // So the user doesn't have to re-enter email.
                            }
                            echo '">';
                            echo '<div class="msg" id="msg">&nbsp;</div>';
                        }
                        echo '<div class="title"><p>Password<p></div>';
                        echo '<input id="password" required type="password" name="password" placeholder="" onkeyup="validate()">';
                        if($_GET["page"] == "register"){
                            echo '<div class="title"><p>Repeat password</p></div>';
                            echo '<input id="confirmpassword" required type="password" name="confirmpassword" placeholder="" onkeyup="validate()">';
                            echo '<div class="title"><p>Avatar</p></div>';
                            echo '<input id="avatar" type="file" name="avatar" accept="u_img/*">';
                        }
                        echo '<input type="submit" name="submit" value=">>>">';
                        // Redirect links
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
                    }elseif($_GET["page"] == "profile"){
                        // This if statements shows the profile of the currently logged in user.
                        $q = "
                        SELECT `username`, `email`, `date`, `avatar`
                        FROM  `users`
                        WHERE `username` = \"".$_SESSION['username']."\"";
                        $r = $dbconn->query($q);
                        while($data = $r->fetch_assoc()){
                            echo '<div class="profile_container">';
                            echo '<div class="profile_user">';
                            echo '<div class="profile_avatar">';
                            echo '<img class="avatar" src="'.$data["avatar"].'" alt="User Avatar">';
                            echo '</div>';
                            echo '<div class="profile_username"><p>'.$data["username"].'</p></div>';
                            echo '<hr>';
                            echo '<div class="profile_date"><p>Joined on: '.$data["date"].'</p></div>';
                            echo '</div>';
                            echo '<hr>';
                            echo '</div>';
                        }
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