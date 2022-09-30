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

<div class="mainpart">    			
	<div class="logoname">
		<img alt="Logo professionnel" src="images/logodev"/>
	</div>
	
	<div class="catchingwords">
		<div>
			<h1>Erwan Carlini, développeur d'applications PhP</h1>
			<hr id="catchBar">
		</div>
		<div>
			<h4><em>"Permettez vous le luxe d'engager le développeur qui répondra à vos exigeances et réalisez vos rêves professionels les plus majestueux avec le concepteur / développeur d'applications PhP qu'il vous faut, Erwan Carlini."</em></h4>
		</div>
		<div class="socialmedia">
			<h4>Réseaux sociaux :</h4>
			<a href="https://www.linkedin.com/in/erwan-carlini-711a1a134/"><img alt="Logo LinkedIn" src="images/linkedinlogo.png" /></a>
			<a href="https://github.com/ErwanCarl"><img alt="Logo GitHub" src="images/Githublogo.png"/></a>
		</div> 
	</div>			
</div>

<div class="cv">
	<div>
		<h4>Curriculum Vitae</h4>
	</div>
	<div>
		<a href="images/CV%20-%20062022.pdf"><img src="images/download_logo.png" /></a>
	</div>
</div>

<hr class="homeBar">

<div class="creation_title">
	<h2>Dernières créations</h2>
	<hr class="passionBar">
</div>

<div class="global_creation">
	<?php 
		foreach ($posts as $post) {
	?>

	<div class="creation">
		<div class="posts_title">
			<h4><?php echo htmlspecialchars($post['title']); ?></h4>
		</div>
		<div class="posts_link">
			<a href="index.php?action=post&id=<?= urlencode($post['id']) ?>">
				<div class="posts_picture">
					<img id="pic_base" src="<?php echo htmlspecialchars($post['picture']); ?>">
					<img id="pic_hover" src="images/loupe_post_hover.png">
				</div>
			</a>
		</div>
	</div>

	<?php
		}
	?>		
</div>

<hr class="homeBar">

<div class="form_contact">
	<form action="index.php" method="post">
		<h2>Contact</h2>

		<div class="form_case">
			<label for="name">Prénom / Nom</label>
			<input required type="text" name="name" id="name">
		</div>

		<div class="form_case">
			<label for="email">Email</label>
			<input required type="email" name="email" id="email">
		</div>

		<div class="form_case">
			<label for="message">Message</label>
			<textarea required name="message" id="message" rows="5" cols="50"></textarea>  
		</div>

		<div class="form_case2">						
			<input required type="checkbox" name="rgpd" id="rgpd"> 
			<label for="rgpd">Accord RGPD </label>
		</div>
	
		<div class="form_button">
			<button type="submit">Envoyer</button>
		</div>
	</form>
</div>

<?php $content=ob_get_clean(); ?>

<?php require('layout.php'); ?>
