<?php
    function r_msg(){ // When user already exists.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>User already exists.</p>";
        echo "</div>";
        echo "</div>";
    }

    function i_msg_created(){ // When account is created.
        echo "<div class='code'>";
        echo "<div class='true'>";
        echo "<p>Account has been created.</p>";
        echo "</div>";
        echo "</div>";
    }

    function i_msg(){ // When user fills in wrong information.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>You have entered the wrong information.</p>";
        echo "</div>";
        echo "</div>";
    }

    function p_msg(){ // When password is less than 6.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Password has to contain atleast 6 charachters.</p>";
        echo "</div>";
        echo "</div>";
    }

    function c_msg(){ // When passwords don't match.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Passwords do not match.</p>";
        echo "</div>";
        echo "</div>";
    }

    function f_msg(){ // When user uses wrong file type
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Wrong filetype. Please use jpg, jpeg or png.</p>";
        echo "</div>";
        echo "</div>";
    }

    function s_msg(){ // When file is too big
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>The filesize has to be less than 2mb.</p>";
        echo "</div>";
        echo "</div>";
    }

    function get_article($ID, $title, $content, $date, $user, $avatar){
        echo '<div class="post_container">';
        echo '<div class="post_avatar"><p>'.$avatar.'</p></div>';
        echo '<div class="post_title"><p>'.$title.'</p></div>';
        echo '<div class="post_content"><p>'.$content.'</p></div>';
        echo '<div class="post_user"><p>'.$user.'</p></div>';
        echo '<div class="post_date"><p>'.$date.'</p></div>';
        echo '<input type="hidden" name="ID" value="'.$ID.'">';
        echo '</div>';
    }
?>