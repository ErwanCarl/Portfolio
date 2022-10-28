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

<?php
	}
?>		

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
