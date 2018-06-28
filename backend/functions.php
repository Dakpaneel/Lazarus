<?php
    require 'backend/editpost.php';
    // When user already exists.
    function r_msg(){
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>User already exists.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When account is created.
    function i_msg_created(){ // When account is created.
        echo "<div class='code'>";
        echo "<div class='true'>";
        echo "<p>Account has been created.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When user fills in wrong information.
    function i_msg(){ // When user fills in wrong information.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>You have entered the wrong information.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When password is less than 6.
    function p_msg(){ // When password is less than 6.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Password has to contain atleast 6 charachters.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When passwords don't match.
    function c_msg(){ 
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Passwords do not match.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When user uses wrong file type
    function f_msg(){
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Wrong filetype. Please use jpg, jpeg or png.</p>";
        echo "</div>";
        echo "</div>";
    }

    // When file is too big 
    function s_msg(){
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>The filesize has to be less than 2mb.</p>";
        echo "</div>";
        echo "</div>";
    }

    // Structure of the posts
    function get_article($ID, $title, $content, $date, $user, $avatar){
        if(isset($_SESSION["username"]) && $_SESSION["username"] == $user){
            
        }
        echo '<div class="post-container">';
        echo '<div class="post-avatar"><p><img class="avatar ';
        if(isset($_SESSION["username"]) && $_SESSION["username"] == $user){
            echo 'you';
        }
        echo '" src="'.$avatar.'"></p></div>';
        echo '<div class="post-title title"><p>'.$title.'</p></div>';
        if($content !== ""){
            echo '<div class="post-content"><p>'.$content.'</p></div>'; 
        }
        if(isset($_SESSION["username"]) && $_SESSION["username"] == $user){
            echo '<div class="post-edit">';
            echo '<a class="post-edit-btn p">Edit</a>';
            echo '<form class="editform" name="editform" method="POST" enctype="multipart/form-data" action="">';
            echo '<p>Title</p>';
            echo '<textarea required name="title" maxlength="130" cols="auto" rows="auto" placeholder="Title">'.$title.'</textarea>';
            echo '<p>Text</p>';
            echo '<textarea name="text" maxlength="2048" cols="auto" rows="10" placeholder="Text (Optional)">'.$content.'</textarea>';
            echo '<input type="submit" name="edit" value="Edit">';
            echo '<input type="submit" name="delete" value="Delete">';
            echo '<input type="hidden" name="ID" value="'.$ID.'">';
            echo '</form>';
            echo '</div>';
        }
        echo '<div class="post-user"><p>Posted by '.$user;
        if(isset($_SESSION["username"]) && $_SESSION["username"] == $user){
            echo ' (You)';
        }
        echo '</p></div>';
        echo '<div class="post-date"><p>Posted on '.$date.'</p></div>';
        echo '</div>';
    }
?>