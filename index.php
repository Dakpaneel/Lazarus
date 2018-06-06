<?php
require 'backend/connection.php';
//require 'backend/preparepost.php';

// initial
$post_content = [];
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
$post_content[] = '<div class="post" tabindex="1">';
$post_content[] = '<div class="votes">';
$post_content[] = '<div class="upvote">';
$post_content[] = '<button><i class="far fa-arrow-alt-circle-up"></i></button>';
$post_content[] = '</div>';
$post_content[] = '<div class="downvote">';
$post_content[] = '<button><i class="far fa-arrow-alt-circle-down"></i></button>';
$post_content[] = '</div>';
$post_content[] = '</div>';
$post_content[] = '<img src="https://lucenthealth.com/wp-content/uploads/PROFILE-PHOTO-PLACEHOLDER.png" alt="u_avatar">';
$post_content[] = '<p class="post_title"><a href="#">Test post title.</a></p>';
$post_content[] = '<p class="post_date">Posted on: 01/01/2010</p>';
$post_content[] = '<br>';
$post_content[] = '<p class="post_user">Posted by: <a href="#">User</a></p>';
$post_content[] = '</div>';
=======

// database check
$sql_check = "SELECT ID FROM posts";
$stmt_check = mysqli_query($dbconn,$sql_check);
$check = mysqli_fetch_array($stmt_check, MYSQLI_ASSOC);
=======
>>>>>>> parent of 3e882c6... Revert "Partial update to posts and login"
=======
>>>>>>> parent of 3e882c6... Revert "Partial update to posts and login"

// sql prep
$sql_new = "SELECT content, title, date, uid FROM posts ORDER BY date DESC";
$sql_hot = "SELECT content, title, date, uid FROM posts";
$stmt_new = mysqli_query($dbconn,$sql_new);
$stmt_hot = mysqli_query($dbconn,$sql_hot);

// post prep
<<<<<<< HEAD
<<<<<<< HEAD
if(isset($check["ID"])){
	while($row = mysqli_fetch_row($stmt_new)){
		$post_content[] = '<div class="post" tabindex="1">';
		$post_content[] = '<div class="votes">';
		$post_content[] = '<div class="upvote">';
		$post_content[] = '<button><i class="far fa-arrow-alt-circle-up"></i></button>';
		$post_content[] = '</div>';
		$post_content[] = '<div class="downvote">';
		$post_content[] = '<button><i class="far fa-arrow-alt-circle-down"></i></button>';
		$post_content[] = '</div>';
		$post_content[] = '</div>';
		$post_content[] = '<img src="https://lucenthealth.com/wp-content/uploads/PROFILE-PHOTO-PLACEHOLDER.png" alt="u_avatar">';
		$post_content[] = '<p class="post_title">'. $row[1] . '</p>';
		$post_content[] = '<div class="post_date">Posted on:&nbsp;<p>' . $row[2] . '</p></div>';
		$post_content[] = '<br>';
		$post_content[] = '<p class="post_user">Posted by: <a href="#">' . $row[3] . '</a>';
		if($row[0]){
			$post_content[] = '<p class="readmore"> | Click to read more.</p>';
		}
		$post_content[] = '</p>';
		$post_content[] = '<div class="post_content">' . $row[0] . '</div>';
		$post_content[] = '</div>';
	}
} else {
	$post_content[] = '<div class="errorpost">OOPSIE WOOPSIE!! Uwu We made a fucky wucky!! A wittle fucko boingo! The code monkeys at our headquarters are working VEWY HAWD to fix this!</div>';
}
>>>>>>> parent of d198edb... Revert "Tiny update"
=======
=======
>>>>>>> parent of 3e882c6... Revert "Partial update to posts and login"
while($row = mysqli_fetch_row($stmt_new)){
    $post_content[] = '<div class="post" tabindex="1">';
    $post_content[] = '<div class="votes">';
    $post_content[] = '<div class="upvote">';
    $post_content[] = '<button><i class="far fa-arrow-alt-circle-up"></i></button>';
    $post_content[] = '</div>';
    $post_content[] = '<div class="downvote">';
    $post_content[] = '<button><i class="far fa-arrow-alt-circle-down"></i></button>';
    $post_content[] = '</div>';
    $post_content[] = '</div>';
    $post_content[] = '<img src="https://lucenthealth.com/wp-content/uploads/PROFILE-PHOTO-PLACEHOLDER.png" alt="u_avatar">';
	$post_content[] = '<p class="post_title">'. $row[1] . '</p>';
    $post_content[] = '<div class="post_date">Posted on:&nbsp;<p>' . $row[2] . '</p></div>';
    $post_content[] = '<br>';
	$post_content[] = '<p class="post_user">Posted by: <a href="#">' . $row[3] . '</a>';
	if($row[0]){
		$post_content[] = '<p class="readmore"> | Click to read more.</p>';
	}
	$post_content[] = '</p>';
	$post_content[] = '<div class="post_content">' . $row[0] . '</div>';
    $post_content[] = '</div>';
}
<<<<<<< HEAD
>>>>>>> parent of 3e882c6... Revert "Partial update to posts and login"
=======
>>>>>>> parent of 3e882c6... Revert "Partial update to posts and login"
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
		<main class="main container">
			<div class="main_nav">
				<p>Sort by:</p>
				<select name="sortpost">
					<option value="1">Hot</option>
					<option value="2" selected>New</option>
					<option value="3">Top</option>
				</select>
			</div>
			<div class="main_posts">
				<?php
				if (isset($post_content)){
					foreach ($post_content as $key => $content){
						echo $content;
					}
				} else {
					echo "That's weird, there is nothing to find here...";
				}
				?>
			</div>
		</main>
		<!-- End main -->
		<!-- Begin sidebar -->
		<div class="main sidebar searchpost">
			<div class="searchbar">
				<i class="fas fa-search"></i>
				<input type="search" placeholder="search...">
			</div>
			
		</div>
		<button class="sidebar new_link_post" type="button" value="Newlinkpost">
			<p>Submit new link.</p>
		</button>
		<button class="sidebar new_text_post" type="button" value="Newtextpost">
			<p>Submit new text post.</p>
		</button>
		<!-- End sidebar -->
		<!-- Start footer -->
		<footer class="">
			<div class="footer_container">
				<div class="foot_cont_left">
					<a class="l_item_one item" href="#">Over ons</a>
					<a class="l_item_two item" href="#">Contact</a>
					<a class="l_item_three item" href="#">Help</a>
					<a class="l_item_four item" href="#">Voorwaarden</a>
				</div>
				<div class="foot_cont_right">
					<a class="r_item_one item" href="#">Doneer</a>
					<a class="r_item_two item" href="#">Werk voor ons</a>
					<a class="r_item_three item" href="#">Regels</a>
					<a class="r_item_four item" href="#">Advertering</a>
				</div>
			</div>
		</footer>
		<!-- End footer -->
	</body>
</html>