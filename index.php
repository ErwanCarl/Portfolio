<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/passions.php');
require_once('src/controllers/contact.php');
require_once('src/controllers/addComment.php');


if(isset($_GET['action']) && $_GET['action'] !== '') {

    if($_GET['action'] === 'passions') {
        passions();

    } elseif($_GET['action'] === 'contact') {
        contact();

    } elseif($_GET['action'] === 'post' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        post($id);

    }elseif($_GET['action'] === 'addComment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        addComment($id, $_POST);
    }

} else {
    homepage();
}

