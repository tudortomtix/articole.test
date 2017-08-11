
	<div class="back">
		<i class="fa fa-chevron-left" aria-hidden="true"></i>
		<a href="javascript:history.go(-1)">Back</a>
	</div>

	<div class="article">
		<div class="title">
			<?php echo $vars['article']['title']; ?>
		</div>

		<div class="data">
			<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("F j, Y, g:i a", strtotime($vars['article']['date_insert'])); ?>
		</div>

		<div class="cover">
			<?php 
				if (isset($vars['article']['cover_photo'])) {
					echo '<img src="public/images/covers/'.$vars['article']['cover_photo'].'"';
				} 
			?>
		</div>

		<div class="body">
			<?php echo $vars['article']['body']; ?>
		</div>
	</div>
	<div class="related">
		<div class="leftrel">
			<?php 
				//var_dump($vars['related']); 
			?>
		</div>
		<div class="rightrel">
			
		</div>
	</div>
	<div class="comments">
		<?php require 'boxes/comments.php'; ?>
	</div>
</div>