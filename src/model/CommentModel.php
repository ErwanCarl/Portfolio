<?php 

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/Model.php');
require_once('src/entity/Comment.php');

class CommentModel extends Model
{

/* get all comments from a post thanks to its id */
// Ajouter where validate_account = 1 quand page admin ready 
    public function getComments (int $id) : Comment
    {
        $statement = $this->connection->prepare("SELECT `author`,`content`,`creation_date` FROM `comment` WHERE `post_id` = ? ORDER BY `creation_date` DESC");
        $statement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'src/entity/Comment');
        var_dump($statement);
        die;
        $statement->execute([$id]);
        return $statement->fetchAll();
    }


/* register a new comment in db */

    public function createComment(int $postId, Comment $comment) : bool 
    {
        $statement = $this->connection->prepare("INSERT INTO comment(post_id, author, content, user_id) VALUES(:post_id, :author, :content, 1)");

/* pas oublier de remplacer le 1 dans la requête par la variable du id user après avoir créer les comptes user + $_SESSION */
        $line = $statement->execute([
            'post_id' => $postId,
            'author'=> $comment->getAuthor(),
            'content' => $comment->getContent()
        ]);

        return ($line);
    } 

//     public function getPendingComments() : Comment
//     {
//         $statement = $this->connection->prepare("SELECT * FROM comment WHERE validate_comment = 0");
//         // A compléter
//         $statement->fetchAll();
//         return 
//     }
} 
