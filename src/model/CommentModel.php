<?php 

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/Model.php');

class CommentModel extends Model
{

/* get all comments from a post thanks to its id */

    public function getComments (string $id) : array
    {
        $statement = $this->connection->prepare("SELECT `author`,`content`,`creation_date` FROM `comment` WHERE `post_id` = ? ORDER BY `creation_date` DESC");
        $statement->execute([$id]);
        return $statement->fetchAll();
    }


/* register a new comment in db */

    public function createComment(string $postId, Comment $comment) : bool 
    {
        $statement = $this->connection->prepare("INSERT INTO comment(post_id, author, content, user_id) VALUES(:post_id, :author, :content, 1)");

/* pas oublier de remplacer le 1 dans la requête par la variable du id user après avoir créer les comptes user */
        $line = $statement->execute([
            'post_id' => $postId,
            'author'=> $comment->getAuthor(),
            'content' => $comment->getContent()
        ]);

        return ($line);
    } 

}

