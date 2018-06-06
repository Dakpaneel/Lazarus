<?php
include("backend/connection.php");
// initial
$post_content = [];

// sql prep
$sql = "SELECT content, date, uid FROM posts";
$stmt = mysqli_query($pdo,$sql);

// post prep
while($row = mysqli_fetch_assoc($stmt)){
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
    $post_content[] = '<p class="post_title"><a href="#">'. $row[0] . '</a></p>';
    $post_content[] = '<p class="post_date">Posted on: 01/01/2010</p>';
    $post_content[] = '<br>';
    $post_content[] = '<p class="post_user">Posted by: <a href="#">User</a></p>';
    $post_content[] = '</div>';
}
?>