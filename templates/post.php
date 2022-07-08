<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Erwan Carlini">
		<meta name="description" content="">
		<meta name="copyright" content="Erwan Carlini">
		<meta name="keywords" content="">
		<title>Erwan Carlini - Portfolio</title>
		<link rel="icon" type="" href="">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="responsive.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
	</head>

	<body>

	    <?php include('header.php'); ?>

        <div class="return">
            <a href="">Retour aux blog posts</a>
        </div>

<!---------------- post part ------------------>

        <div class="post">
            <div class="postTitle">
                <h2>
                    <?php echo htmlspecialchars($post['title']); ?>
                </h2>
            </div>

            <div class="postChapo">
                <h3>
                    <?php echo htmlspecialchars($post['chapo']); ?>
                </h3>
                
            </div>

            <div class="postPic">
                <a href=""></a>
            </div>

            <div class="postContent">
                <h4>
                    <?php echo htmlspecialchars($post['content']); ?>
                </h4>
            </div>

            <div class="postAuthor">
                <h4>
                    <?php echo htmlspecialchars($post['author']); ?> - 
                    <?php echo htmlspecialchars($post['creation_date']); ?>
                </h4>
            </div>

        </div>

<!---------------- comments part ------------------>

        <div class="comments">

            <div class="addComment">
                <form method=post action="index.php?action=addComment&id=<?= $post['id'] ?>">
                    <h2>Ajoutez un commentaire</h2>

                    <div class="form_case">
                        <label for="author">Pseudo</label>
                        <input required type="text" name="author" id="author">
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

            <div class="commentsList">
                <?php
                foreach($comments as $comment){
                ?>
                <div class="commentAuthor">
                    <h2>
                        <?php echo htmlspecialchars($comment['author']); ?> -
                        <?php echo htmlspecialchars($comment['creation_date']); ?>
                    </h2>
                </div>

                <div class="commentContent">
                    <h4>
                        <?php echo htmlspecialchars($comment['content']); ?>
                    </h4>
                </div>


                <?php
                }
                ?>
            </div>
        </div>

        <div class="return">
            <a href="">Retour aux blog posts</a>
        </div>

    </body>
</html>