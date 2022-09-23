<?php ob_start();?>

<?php 
    if(isset($_SESSION['success'])) { 
?>
        <div class="alert alert-success" role="alert">
            <?php 
                $message = $_SESSION['success'];
                unset($_SESSION['success']);
                echo $message;
            ?>
        </div>
<?php 
    }elseif(isset($_SESSION['error'])){
?>
        <div class="alert alert-danger" role="alert">
            <?php
                $message = $_SESSION['error'];
                unset($_SESSION['error']);
                echo $message;
            ?>
        </div>
<?php
}
?>

<!---------------- post part ------------------>


<div class="post_title">
    <h1>
        <?php echo htmlspecialchars($post->getTitle()); ?>
    </h1>
</div>

<hr id="passionBar">

<div class="return_button">
    <button type="button" onclick="window.location='index.php?action=blogposts#return'" class="btn btn-info mb-2">Retour aux blog posts</button>
</div>

<div class="post">

    <div class="post_author">
        <h4><?php echo htmlspecialchars($post->getAuthor()); ?></h4>
        <h4><?php 
            if($post->getModificationDate() === null) {
                echo htmlspecialchars('Date de création : '.$post->getCreationDate());
            }else{
                echo htmlspecialchars('Dernière modification : '.$post->getModificationDate());
            }?>
        </h4>
    </div>

    <hr>

    <div class="post_chapo">
        <h4>
            <?php echo htmlspecialchars($post->getChapo()); ?>
        </h4> 
    </div>

    <div class="post_content">
        <h4>
            <?php echo ($post->getContent()); ?>
        </h4>
    </div>

    <div class="bloc_post_pic">
        <img id="post_pic" src="<?php echo htmlspecialchars($post->getPicture()); ?>">
    </div>

    <?php if(isset($_SESSION['Connection']) AND $_SESSION['userInformations']['role'] === 'admin') { ?>
        <div class="post_admin">
            <div class="return_button">
                <button type="button" onclick="window.location='index.php?action=postmodify&id=<?= urlencode($post->getId()) ?>'" class="btn btn-warning mb-2">Modifier</button>
            </div>

            <div class="return_button">
                <button type="button" onclick="window.location='index.php?action=postdelete&id=<?= urlencode($post->getId()) ?>'" class="btn btn-danger mb-2">Supprimer</button>
            </div>
        </div>
    <?php } ?>

</div>



<div class="return_button">
    <button type="button" onclick="window.location='index.php?action=post&id=<?= urlencode($post->getId()) ?>#comment_connect'" class="btn btn-success mb-2">Ajouter un commentaire</button>
</div>
<!---------------- comments part ------------------>

<div class="comment_bloc">
    <div class="comment_head">
        <h4>Commentaires</h4>
    </div>

    <?php if($comments != null) { ?>

    <div class="comments">

        <div class="comments_list">
            <?php
            foreach($comments as $comment){
            ?>
            <div class="comments_author">
                <h4>
                <em><?php echo htmlspecialchars($comment['creation_date']); ?></em> -
                    <?php echo htmlspecialchars($comment['author']); ?>
                    a écrit : 
                </h4>
            </div>

            <div class="comments_content">
                <h4>
                    <?php echo htmlspecialchars($comment['content']); ?>
                </h4>
            </div>
            
            <hr class="comment_bar">
            
            <?php
            }
            ?>
        </div>
    </div>

    <?php }else{ ?>
        <div class="comments_list" id="no_comment">
            <p>Il n'y a pas encore de commentaires sur cet article.</p>
        </div>
    <?php } ?>
</div>

<!-- Comment system if user connected -->

<?php if(isset($_SESSION['Connection'])) { ?>
    <div class="add_comment" id="comment_connect">
            <form method=post action="index.php?action=addComment&id=<?= $post->getId() ?>">
                <h2>Ajoutez un commentaire</h2>

                <div class="form_case">
                    <label for="author">Pseudo</label>
                    <input required type="text" name="author" id="author" value="<?php echo htmlspecialchars($_SESSION['userInformations']['username']); ?>" readonly="readonly">
                </div>

                <div class="form_case">
                    <label for="content">Message</label>
                    <textarea required name="content" id="content" rows="5" cols="50"></textarea>  
                </div>

                <div class="form_button">
                    <button type="submit">Envoyer</button>
                </div>
            </form>
        </div>

<?php }else{ ?>

    <div id="comment_connect" class="alert alert-danger" role="alert">
        <p>Vous devez être connecté pour laisser un commentaire.</p>
    </div>

<?php } ?>

    <div class="return_button">
        <button type="button" onclick="window.location='index.php?action=blogposts#return'" class="btn btn-info mb-2">Retour aux blog posts</button>
    </div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>