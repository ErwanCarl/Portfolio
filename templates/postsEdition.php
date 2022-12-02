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

<hr class="passionBar">

<?php if(isset($post) && isset($_SESSION['Modify'])) { ?>
	<div class="form_post_creation">
		<form action="/modifysubmit/<?= urlencode($post->getId())?>" method="post" enctype="multipart/form-data">
			<div class="form_case">
				<p>Auteur : <span><?php echo htmlspecialchars($post->getAuthor()); ?></p></span>
			</div>

			<div class="form_case">
				<label for="title">Titre</label>
				<input required type="text" name="title" maxlength="50" id="title" value="<?php echo htmlspecialchars($post->getTitle()); ?>">
			</div>

			<div class="form_case">
				<label for="chapo">Chapô</label>
				<textarea required name="chapo" id="chapo" maxlength="255" rows="3" cols="5"><?php echo htmlspecialchars($post->getChapo()); ?></textarea>  
			</div>

			<div class="form_case">
				<label for="content">Contenu</label>
				<textarea required name="content" id="content" rows="5" cols="50"><?php echo htmlspecialchars($post->getContent()); ?></textarea>  
			</div>

			<div class="form_case">
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<label for="picture">Image</label>
				<input type="file" id="image_input" name="picture" id="picture" placeholder="<?php echo htmlspecialchars($post->getPicture()); ?>" value="<?php echo htmlspecialchars($post->getPicture()); ?>" />
            </div>
	
			<div class="form_button">
				<button type="submit" >Modifier l'article</button>
			</div>
		</form>
	</div>

<?php }else{ ?>
	<div class="form_post_creation">
		<form action="/newpostsubmit" method="post" enctype="multipart/form-data">
			<div class="form_case">
				<p>Auteur : <span><?php echo htmlspecialchars($_SESSION['userInformations']['username']); ?></span></p>
			</div>
			<div class="form_case">
				<label for="title">Titre</label>
				<input required type="text" name="title" id="title" maxlength="50">
			</div>

			<div class="form_case">
				<label for="chapo">Chapô</label>
				<textarea required name="chapo" id="chapo" maxlength="255" rows="3" cols="5"></textarea>  
			</div>

			<div class="form_case">
				<label for="content">Contenu</label>
				<textarea name="content" id="content" rows="5" cols="50"></textarea>  
			</div>
		
			<div class="form_case">
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<label for="picture">Image (Obligatoire)</label>
				<input type="file" id="image_input" name="picture" id="picture"/>

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
