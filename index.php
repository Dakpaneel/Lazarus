<?php
$post_content = [];
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
		<meta name="theme-color" content="#eeeeee">
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
				<a class="title" href="#">Lazarus</a>
			</div>
			<div class="nav_account">
				<div class="account_items">
					<a class="item title" href="#">Inloggen</a> / <a class="item title" href="#">Registreren</a>
				</div>
			</div>
		</nav>
		<!-- End navigation -->
		<!-- Begin main -->
		<main class="main container">
			<div class="main_nav">
				<p>Sort by:</p>
				<select>
					<option>Hot</option>
					<option>New</option>
					<option>Top</option>
				</select>
			</div>
			<div class="main_posts">
				<?php
				for ($x = 0; $x <= 10; $x++) { 
					if (isset($post_content)){
						foreach ($post_content as $key => $content){
							echo $content;
						}
					}
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