<?php
    // Upload post
    if(isset($_POST["submit"])){
        $title = htmlspecialchars($_POST["title"]);
        $content = htmlspecialchars($_POST["text"]);
        $UID = $_POST["UID"];
        $stmt=$dbconn->prepare("INSERT INTO `posts` (`title`,`content`,`UID`) VALUES (?,?,?)");
        $stmt->bind_param('ssi', $title, $content, $UID);
        $stmt->execute();
        $stmt->close();
        if(isset($_GET["page"])){
            header('Location: '.$_SERVER[PHP_SELF].'?page=profile');
        }else{
            header('Location: '.$_SERVER[PHP_SELF]);
        }
    }

    echo '<div class="post_upload">';
    echo '<form class="postform" name="postform" method="POST" enctype="multipart/form-data" action="">';
    echo '<div class="legend upload-btn"><p>Upload</p></div>';
    echo '<div class="postform-container">';
    echo '<p>Title</p>';
    echo '<textarea required name="title" maxlength="130" cols="100" rows="1" placeholder="Title"></textarea>';
    echo '<p>Text</p>';
    echo '<textarea name="text" maxlength="2048" cols="100" rows="6" placeholder="Text (Optional)"></textarea>';
    echo '<input type="submit" name="submit" value="Continue">';
    echo '<input type="hidden" name="UID" value="'.$_SESSION["UID"].'">';
    echo '</div>';
    echo '</form>';
    echo '</div>';
?>