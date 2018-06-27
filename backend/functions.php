<?php
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
        echo '<div class="post-container">';
        echo '<div class="post-avatar"><p><img class="avatar" src="'.$avatar.'"></p></div>';
        echo '<div class="post-title"><p>'.$title.'</p></div>';
        echo '<div class="post-content"><p>'.$content.'</p></div>';
        echo '<div class="post-user"><p>Posted by '.$user;
        if(isset($_SESSION["username"]) && $_SESSION["username"] == $user){
            echo ' (You)';
        }
        echo '</p></div>';
        echo '<div class="post-date"><p>Posted on: '.$date.'</p></div>';
        echo '<input type="hidden" name="ID" value="'.$ID.'">';
        echo '</div>';
    }
?>