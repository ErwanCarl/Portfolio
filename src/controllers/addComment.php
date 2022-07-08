<?php

require_once('src/model/comments.php');
require_once('src/model/post.php');

function addComment(string $id, array $formInput){
    $author = $formInput['author'];
    $content = $formInput['content'];

    $addCommentSuccessfull = createComment($id, $author, $content);

    if($addCommentSuccessfull) {
        header('Location: index.php?action=post&id='.$id);
    }else{
        die("Impossible d'ajouter le commentaire");
    }
}