<?php

require_once('src/model/comments.php');
require_once('src/model/post.php');

function post(string $id) {
    $post = getPost($id);
    $comments = getComments($id);

    require('templates/post.php');
}