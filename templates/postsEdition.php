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

<div class="passionTitle">
	<h1>Édition d'un article</h1>
</div>

<?php if(isset($post) AND isset($_SESSION['Modify'])) { ?>
	<div class="form_post_creation">
		<form action="index.php?action=modifysubmit&id=<?=urlencode($post->getId())?>" method="post">
			<div class="form_case">
				<label for="author">Auteur</label>
				<input required type="text" name="author" id="author" readonly="readonly" value="<?php echo htmlspecialchars($post->getAuthor()); ?>">
			</div>

			<div class="form_case">
				<label for="title">Titre</label>
				<input required type="text" name="title" id="title" value="<?php echo htmlspecialchars($post->getTitle()); ?>">
			</div>

			<div class="form_case">
				<label for="chapo">Chapô</label>
				<textarea required name="chapo" id="chapo"rows="3" cols="5"><?php echo htmlspecialchars($post->getChapo()); ?></textarea>  
			</div>

			<div class="form_case">
				<label for="content">Contenu</label>
				<textarea required name="content" id="content" rows="5" cols="50"><?php echo htmlspecialchars($post->getContent()); ?></textarea>  
			</div>
	
			<div class="form_button">
				<button type="submit">Modifier l'article</button>
			</div>
		</form>
	</div>

<?php }else{ ?>
	<div class="form_post_creation">
		<form action="index.php?action=newpostsubmit" method="post">
			<div class="form_case">
				<label for="author">Auteur</label>
				<input required type="text" name="author" id="author">
			</div>
			<div class="form_case">
				<label for="title">Titre</label>
				<input required type="text" name="title" id="title">
			</div>

			<div class="form_case">
				<label for="chapo">Chapô</label>
				<textarea required name="chapo" id="chapo"rows="3" cols="5"></textarea>  
			</div>

			<div class="form_case">
				<label for="content">Contenu</label>
				<textarea name="content" id="content" rows="5" cols="50"></textarea>  
			</div>
		
			<div class="form_button">
				<button type="submit">Créer l'article</button>
			</div>
		</form>
	</div>
<?php } ?>

<script src="vendor/tinymce/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: '#content'
		});
</script>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>