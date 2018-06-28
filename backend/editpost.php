<?php
    if(isset($_POST["edit"])){
        $title = $_POST["title"];
        $content = $_POST["text"];
        $ID = $_POST["ID"];
        $q = '
        UPDATE posts
        SET
        `title`="'.$title.'",
        `content`="'.$content.'"
        WHERE `ID`='.intval($ID);
        $stmt=$dbconn->prepare($q);
        $stmt->execute();
        $stmt->close();
    }else if(isset($_POST["delete"])){
        $ID = $_POST["ID"];
        $q = '
        DELETE FROM posts WHERE ID = '.intval($ID);
        $stmt=$dbconn->prepare($q);
        $stmt->execute();
        $stmt->close();
    }
?>