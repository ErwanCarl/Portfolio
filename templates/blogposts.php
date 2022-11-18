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

<div class="blogposts_title" id="return">
	<h1>Listes des articles</h1>
	<hr class="passionBar">
</div>

<?php 
	foreach ($posts as $post) {
?>

<div class="work_creation">
	<div class="title_bloc">
		<h2><?php echo htmlspecialchars($post->getTitle()); ?></h2>
	</div>
	<div class="post_bloc">
		<div class="pic_bloc">
			<a href="/post/<?= urlencode($post->getId()) ?>/1">
				<div class="posts_picture">
					<img id="pic_base" src="<?php echo htmlspecialchars($post->getPicture()); ?>">
					<img id="pic_hover" src="images/loupe_post_hover.png">
				</div>
			</a>
		</div>
		<div class="info_bloc">
			<div class="author_bloc">
				<h4><?php 
				if($post->getModificationDate() === null) {
					echo htmlspecialchars($post->getAuthor().' - Date de création : '.$post->getCreationDate());
				}else{
					echo htmlspecialchars($post->getAuthor().' - Dernière modification : '.$post->getModificationDate());
				}?>
				</h4>
			</div>

			<hr>
			
			<div class="chapo_bloc">
				<h4><?php echo htmlspecialchars($post->getChapo()); ?></h4>
			</div>
		</div>
		
	</div>
</div>

<?php
	}
?>		

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
