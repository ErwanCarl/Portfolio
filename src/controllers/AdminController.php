<?php

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/entity/Comment.php');
require_once('src/model/CommentModel.php');

class AdminController 
{
    public function administration() : void
    {
        $commentModel = new CommentModel();
        $pendingComments = $commentModel->getPendingComments();
        $userModel = new UserModel();
        $pendingAccounts = $userModel->getPendingAccounts();

        require('templates/admin.php');
    }

}