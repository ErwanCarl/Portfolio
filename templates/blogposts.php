<?php

<div class="global_work"></div>
				<?php 
					foreach ($posts as $post) {
				?>
			
				<div class="work_creation">
					<h4>
						<?php echo htmlspecialchars($post['title']); ?>
					</h4>
					<h4>
						<?php echo htmlspecialchars($post['author']); ?>
						- <?php echo htmlspecialchars($post['creation_date']); ?>
					</h4>
					<h4>
						<?php echo htmlspecialchars($post['chapo']); ?>
					</h4>
					<a href="index.php?action=post&id=<?= urlencode($post['id']) ?>">Accéder au Blog Post</a>
				</div>

				<?php
					}
				?>		