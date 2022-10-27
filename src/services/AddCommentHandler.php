<?php

/* To have a strict use of variable types */
declare(strict_types=1);

namespace App\services;

use App\entity\Comment;

class AddCommentHandler {

    public function formDataCheck(?string $content, string $author, array $formData, int $id) : ?Comment 
    {
        if(!empty($author) && !empty($formData['content'])) {
            $formData['author'] = $author;
            $content = $formData['content'];
            $comment = new Comment($formData);
            return $comment;
        } else {
            $_SESSION['error'] = 'Les données du formulaire sont invalides, veuillez contacter l\'administrateur.';
            header('Location: index.php?action=post&id='.$id);
        }
    }

    public function addCommentCheck(int $id, bool $addCommentSuccessfull) : void 
    {
        if($addCommentSuccessfull) {
            $_SESSION['success'] = 'Votre commentaire a bien été ajouté et est en cours de modération.';
            header('Location: index.php?action=post&id='.$id);
        }else{
            $_SESSION['error'] = 'Impossible d\'ajouter le commentaire.';
            header('Location: index.php?action=post&id='.$id);
        }
    }
}
