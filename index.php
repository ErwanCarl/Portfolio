<?php

session_start();

require_once('src/controllers/HomepageController.php');
require_once('src/controllers/PostController.php');
require_once('src/controllers/PassionController.php');
require_once('src/controllers/ContactController.php');
require_once('src/controllers/AddCommentController.php');
require_once('src/controllers/AccountCreationController.php');
require_once('src/controllers/AccountSubmitController.php');
require_once('src/controllers/ConnectionController.php');

if(isset($_GET['action']) && $_GET['action'] !== '') {

    if($_GET['action'] === 'passions') {
        $controller = new PassionController();
        $controller->passionList();

    } elseif($_GET['action'] === 'contact') {
        $controller = new ContactController();
        $controller->contact();

    } elseif($_GET['action'] === 'accountcreation') {
        $controller = new AccountCreationController();
        $controller->accountCreation();

    } elseif($_GET['action'] === 'accountsubmit') {
        $controller = new AccountSubmitController();
        $controller->accountSubmit($_POST);

    } elseif($_GET['action'] === 'connection') {
        $controller = new ConnectionController();
        $controller->accountConnection($_POST);

    } elseif($_GET['action'] === 'closesession') {
        unset($_SESSION['Connection']);
        $controller = new AccountCreationController();
        $controller->accountCreation();

    } elseif($_GET['action'] === 'post' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $postController = new PostController($id);
        $postController->post($id);

    } elseif($_GET['action'] === 'addComment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $controller = new AddCommentController();
        $controller->addComment($id, $_POST);
    } 

} else {
    $controller = new HomepageController();
    $controller->homepage();
}

