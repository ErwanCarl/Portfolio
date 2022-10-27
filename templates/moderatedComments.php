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

<div class="admin_title" id="moderated_title">
	<h1>Listes des commentaires modérés</h1>
</div>

<hr class="passionBar">

<div class="return_button">
	<button type="button" onclick="window.location='index.php?action=admin#commentValidation'" class="btn btn-info mb-2">Retour à la modération</button>
</div>

<?php if($moderatedComments != null) { ?>
	<?php
		foreach($moderatedComments as $moderatedComment) {
	?>

	<div class="comments_validation" id="moderation_bloc">
		<div class="validation_system">
			<div class ="comment_author">
				<?php echo htmlspecialchars('Auteur : '.$moderatedComment['author'].' - Article : '.$moderatedComment['title']); ?>
			</div>
			
			<div class ="comment_content">
				<?php echo htmlspecialchars($moderatedComment['content']); ?>
			</div>
		</div>

		<div class="validation_button" id="moderation_bloc2">
			<div class ="comment_button" id="moderation_button">
				<a href="index.php?action=restauredcomment&id=<?= $moderatedComment['id'] ?>" class="btn btn-info mb-2 active" role="button">Restaurer</a>
			</div>
			<div class="restauration_details">
				<p>Utiliser cette fonction pour restaurer le commentaire et l'afficher sur l'article.</p>
			</div>

		</div>
	</div>

	<?php
		}
	?>

<div class="pagination_bloc">
    <?php for($i=1;$i<=$pageNumber;$i++) { 
		if($i === $currentPage) { ?>
			<div class="actual_pagination">
				<?php echo($i); ?>
			</div>
		<?php }else{ ?>
			<div class="pagination">
				<a href='index.php?action=moderatedcomment&page=<?= $i ?>'><?php echo($i); ?></a>
			</div>
		<?php } ?>
            
	<?php } ?>
</div>

<?php }else{ ?>
	<div class="no_restauration_list">
		<p>Il n'y a pas de commentaires refusés à restaurer actuellement.</p>
	</div>
<?php } ?>

<hr id="moderatedBar">

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
