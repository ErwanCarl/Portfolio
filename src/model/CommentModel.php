<?php 

/* To have a strict use of variable types */
declare(strict_types=1);

require_once('src/model/Model.php');
require_once('src/entity/Comment.php');

class CommentModel extends Model
{

/* get all comments from a post thanks to its id */

    public function getComments (int $id) : array
    {
        $statement = $this->connection->prepare("SELECT `author`,`content`,`creation_date` FROM `comment` WHERE (`post_id` = ? AND validateComment = 1) ORDER BY `creation_date` DESC");
        $statement->execute([$id]);
        return $statement->fetchAll();
    }



/* register a new comment in db */

    public function createComment(int $postId, Comment $comment) : bool 
    {
        $statement = $this->connection->prepare("INSERT INTO comment(post_id, author, content, user_id) VALUES(:post_id, :author, :content, :user_id)");

        $line = $statement->execute([
            'post_id' => $postId,
            'author'=> $comment->getAuthor(),
            'content' => $comment->getContent(),
            'user_id'=>$_SESSION['userInformations']['id']
        ]);

        return ($line);
    } 

    public function getPendingComments() : array
    {
        $statement = $this->connection->query("
            SELECT * 
            FROM post 
            JOIN comment on comment.post_id = post.id
            WHERE validateComment = 0
            ORDER BY comment.creation_date"
        );
        
        return $statement->fetchAll();
    }

    public function commentValidation(int $id) : bool 
    {
        $statement = $this->connection->prepare("UPDATE comment SET `validateComment` = 1 WHERE id = ?");
        return $statement->execute([$id]);
    }

    public function commentModeration(int $id) : bool 
    {
        $statement = $this->connection->prepare("UPDATE comment SET `validateComment` = 2 WHERE id = ?");
        return $statement->execute([$id]);
    }

    public function moderatedListing() : array 
    {
        $statement = $this->connection->query("
            SELECT * 
            FROM post 
            JOIN comment on comment.post_id = post.id
            WHERE validateComment = 2
            ORDER BY comment.creation_date DESC"
        );
        return $statement->fetchAll();
    }
} 
