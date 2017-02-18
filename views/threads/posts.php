<h1><?=$post->title?></h1>

<h4>Posted <?=time_elapsed_string($post->created_at)?> by <?=$post->user->name?></h4>

<p><?=$post->body?></p>

<?php if(is_logged() && $post->user->id == user()->id): ?>
	<p>
		<a href="/thread/edit?id=<?=$post->id?>">Edit</a> | 
		<a href="/thread/remove?id=<?=$post->id?>">Delete</a>
	</p>
<?php endif; ?>
<hr>


<ul>
<?php foreach($replies as $reply): ?>
	
	<li id="reply<?=$reply->id?>">

		<ul class="reply">
			<li>
				<h4><?=$reply->user->name?> <small><?=time_elapsed_string($reply->created_at)?></small></h4>
				
				<p><?=$reply->body?></p>

				<?php if(is_logged() && $reply->user->id == user()->id): ?>
					<p>
						<a href="/thread/edit?id=<?=$reply->id?>">Edit</a> | 
						<a href="/thread/remove?id=<?=$reply->id?>">Delete</a>
					</p>
				<?php endif; ?>

				<?php if((int)$reply->updated_at > 0): ?>
					<i>Last updated: <?=time_elapsed_string($reply->updated_at)?></i>
				<?php endif; ?>
			</li>

		</ul>

		
	</li>

<?php endforeach; ?>
</ul>

<?=view('validation-error')?>

<?=view('threads.reply-form', compact('post'))?>