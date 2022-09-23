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

<div class="adminNav">
    <div class="admin_title">
        <h1>Page d'administration</h1>
    </div>

    <div class="nav1">
        <nav>
            <ul>
                <li><a href="index.php?action=admin#commentValidation">Validation de commentaires</a></li>
                <li><a href="index.php?action=admin#gestionArticle">Gestion des articles</a></li>
                <li><a href="index.php?action=admin#permissions">Permissions utilisateurs</a></li>
            </ul>
        </nav>
    </div>
</div>

<hr class="adminBar">

<div class="section_title" id="commentValidation">
    <h2>Validation de commentaires</h2>
</div>

<?php
    foreach($pendingComments as $pendingComment) {
?>

<div class="comments_validation">
    <div class="validation_system">
        <div class ="comment_author">
            <?php echo htmlspecialchars('Auteur : '.$pendingComment['author'].' - Article : '.$pendingComment['title']); ?>
        </div>
        
        <div class ="comment_content">
            <?php echo htmlspecialchars($pendingComment['content']); ?>
        </div>
    </div>

    <div class="validation_button">
        <div class ="comment_button">
            <a href="index.php?action=validatecomment&id=<?= $pendingComment['id'] ?>" class="btn btn-success mb-2 active" role="button">Valider</a>
        </div>

        <div class ="comment_button">
            <a href="index.php?action=refusedcomment&id=<?= $pendingComment['id'] ?>" class="btn btn-danger mb-2 active" role="button">Refuser</a>
        </div>
    </div>
</div>

<?php
    }
?>

<div class="return_button" id="moderated_comment">
    <button type="button" onclick="window.location='index.php?action=moderatedcomment'" class="btn btn-info mb-2">Accéder à la liste des commentaires modérés</button>
</div>

<hr class="adminBar">

<div class="section_title" id="gestionArticle">
    <h2>Gestions des articles</h2>
</div>

<?php 
    if(isset($_SESSION['success2'])) { 
?>
        <div class="alert alert-success" role="alert">
            <?php 
                $message = $_SESSION['success2'];
                unset($_SESSION['success2']);
                echo $message;
            ?>
        </div>
<?php 
    }elseif(isset($_SESSION['error2'])){
?>
        <div class="alert alert-danger" role="alert">
            <?php
                $message = $_SESSION['error2'];
                unset($_SESSION['error2']);
                echo $message;
            ?>
        </div>
<?php
}
?>

<div class="return_button">
    <button type="button" onclick="window.location='index.php?action=postcreation'" class="btn btn-success mb-2">Créer un article</button>
</div>

<div class="post_administration">
    <?php 
        foreach ($posts as $post) {
    ?>

    <div class="work_creation" id="admin_creation">
        <div class="title_bloc">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        </div>
        <div class="post_bloc">
            <div class="pic_bloc">
                <a href="index.php?action=post&id=<?= urlencode($post['id']) ?>">
                    <div class="posts_picture">
                        <img id="pic_base" src="<?php echo htmlspecialchars($post['picture']); ?>">
                        <img id="pic_hover" src="images/loupe_post_hover.png">
                    </div>
                </a>
            </div>
            <div class="info_bloc">
                <div class="author_bloc">
                    <h4><?php 
                    if($post['modificationDate'] === null) {
                        echo htmlspecialchars($post['author'].' - Date de création : '.$post['creationDate']);
                    }else{
                        echo htmlspecialchars($post['author'].' - Dernière modification : '.$post['modificationDate']);
                    }?>
                    </h4>
                </div>

                <hr>

                <div class="chapo_bloc">
                    <h4><?php echo htmlspecialchars($post['chapo']); ?></h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="post_admin_page">
        <div class="return_button">
            <button type="button" onclick="window.location='index.php?action=postmodify&id=<?= urlencode($post['id']) ?>'" class="btn btn-warning mb-2">Modifier</button>
        </div>

        <div class="return_button">
            <button type="button" onclick="window.location='index.php?action=postdelete&id=<?= urlencode($post['id']) ?>'" class="btn btn-danger mb-2">Supprimer</button>
        </div>
    </div>

    <?php
    }
    ?>		

</div>
		
<hr class="adminBar">

<div class="section_title" id="permissions">
    <h2>Permissions utilisateurs</h2>
</div>


<form class="user_search_form" action="index.php?usersearch" method="post">
    <div class="user_administration">
        <div class="form_case">
            <label for="pseudo">Rechercher un utilisateur</label>
        </div>
        <div class= "search_bloc">
            <input required type="text" name="pseudo" id="pseudo" placeholder="Rentrez le pseudo d'un utilisateur">
			<button type="submit" class="btn btn-primary" id="search_button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg> 
            </button>
		</div>
    </div>
</form>






<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>