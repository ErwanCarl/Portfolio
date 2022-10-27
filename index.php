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
require_once('src/controllers/AdminController.php');
require_once('src/controllers/LegalNoticeController.php');
require_once('src/controllers/MailController.php');

if(isset($_GET['action']) && $_GET['action'] !== '') {

    if($_GET['action'] === 'passions') {
        $controller = new PassionController();
        $controller->passionList();

    } elseif($_GET['action'] === 'contact') {
        $controller = new ContactController();
        $controller->contact();

    } elseif($_GET['action'] === 'legalnotice') {
        $controller = new LegalNoticeController();
        $controller->legalNotice();

    } elseif($_GET['action'] === 'accountcreation') {
        $controller = new AccountCreationController();
        $controller->accountCreation();

    } elseif($_GET['action'] === 'accountsubmit') {
        $controller = new AccountSubmitController();
        $controller->accountSubmit($_POST);

    } elseif($_GET['action'] === 'connection') {
        $controller = new ConnectionController();
        $controller->accountConnection($_POST);

    } elseif($_GET['action'] === 'sendpasswordmail') {
        $controller = new ConnectionController();
        $controller->lostPassword($_POST);

    } elseif($_GET['action'] === 'passwordlandingpage') {
        $controller = new ConnectionController();
        $controller->passwordLandingPage();

    } elseif($_GET['action'] === 'lostpassword') {
        $controller = new ConnectionController();
        $controller->passwordModifyCheck($_GET);

    } elseif($_GET['action'] === 'passwordmodify') {
        $controller = new ConnectionController();
        $controller->passwordModify($_POST);

    } elseif($_GET['action'] === 'closesession') {
        unset($_SESSION);
        session_destroy();
        $_SESSION['success'] = 'Vous vous êtes bien déconnecté.';
        $controller = new AccountCreationController();
        $controller->accountCreation();

    } elseif($_GET['action'] === 'post' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id'];
        
        $postController = new PostController();
        if(isset($_GET['page'])){
            $postController->post($id, (int)$_GET['page']);
        }else{
            $postController->post($id, 1);
        }

    } elseif($_GET['action'] === 'blogposts') {
        $postController = new PostController();
        $postController->posts();

    } elseif($_GET['action'] === 'addComment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $controller = new AddCommentController();
        $controller->addComment($id, $_POST);

    } elseif($_GET['action'] === 'admin') {
        $controller = new AdminController();
        $controller->administration();
    
    } elseif($_GET['action'] === 'sendcontactmail') {
        $controller = new MailController();
        $controller->contactMail($_POST);

    } elseif($_GET['action'] === 'inscriptionvalidation') {
        $accountKey = $_GET['token'];
        $controller = new AccountSubmitController();
        $controller->inscriptionValidation($accountKey);
        
    } elseif($_GET['action'] === 'usersearch') {
        $controller = new AdminController();
        $controller->usernameSearch($_POST);

    } elseif($_GET['action'] === 'changerole') {
        $_POST['username'] = $_SESSION['userChange']['username'];
        $controller = new AdminController();
        $controller->changeUserRole($_POST);

    } elseif($_GET['action'] === 'postdelete' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $controller = new PostController();
        $controller->postDelete($id);

    } elseif($_GET['action'] === 'postmodify' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $controller = new PostController();
        $controller->postEdition($id);

    } elseif($_GET['action'] === 'modifysubmit' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = $_GET['id'];
        $controller = new PostController();
        $controller->modifySubmit($id, $_POST, $_FILES);

    } elseif($_GET['action'] === 'postcreation') {
        $controller = new PostController();
        $controller->postCreation();

    } elseif($_GET['action'] === 'newpostsubmit') {
        $controller = new PostController();
        $controller->newPostSubmit($_POST, $_FILES);

    } elseif($_GET['action'] === 'validatecomment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id'];
        $controller = new AdminController();
        $controller->commentValidate($id);
    
    } elseif($_GET['action'] === 'restauredcomment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id'];
        $controller = new AdminController();
        $controller->commentRestaurate($id);

    } elseif($_GET['action'] === 'refusedcomment' && isset($_GET['id']) && $_GET['id'] > 0) {
        $id = (int) $_GET['id'];
        $controller = new AdminController();
        $controller->commentDelete($id);

    } elseif($_GET['action'] === 'moderatedcomment') {
        $controller = new AdminController();
        if(isset($_GET['page'])){
            $controller->moderatedComment((int)$_GET['page']);
        }else{
            $currentPage = 1;
            $controller->moderatedComment($currentPage);
        }
    }

} else {
    $controller = new HomepageController();
    $controller->homepage();
}

