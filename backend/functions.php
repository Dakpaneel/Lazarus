<?php
    function r_msg(){ // When user already exists.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Gebruiker bestaat al!</p>";
        echo "</div>";
        echo "</div>";
    }

    function i_msg_created(){ // When account is created.
        echo "<div class='code'>";
        echo "<div class='true'>";
        echo "<p>Uw account is aangemaakt!</p>";
        echo "</div>";
        echo "</div>";
    }

    function i_msg(){ // When user fills in wrong information.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>U heeft de verkeerde gegevens ingevuld.</p>";
        echo "</div>";
        echo "</div>";
    }

    function p_msg(){ // When password is less than 6.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Wachtwoord moet minimaal 6 tekens bevatten.</p>";
        echo "</div>";
        echo "</div>";
    }

    function c_msg(){ // When passwords don't match.
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Wachtwoorden komen niet overeen.</p>";
        echo "</div>";
        echo "</div>";
    }

    function f_msg(){ // When user uses wrong file type
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Onjuiste bestandstype. Kies uit jpg, jpeg of png.</p>";
        echo "</div>";
        echo "</div>";
    }

    function s_msg(){ // When file is too big
        echo "<div class='code'>";
        echo "<div class='false'>";
        echo "<p>Het bestand moet kleiner zijn dan 2mb.</p>";
        echo "</div>";
        echo "</div>";
    }
?>