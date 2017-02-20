<div class="container">
	<h4>Search result for "<?=$q?>"</h4>
	<div class="row">
		<div class="col-sm-7"></div>
		<div class="col-sm-1 text-right">		
			Sort by:
		</div>
		<div class="col-sm-4">
			<select name="sort" id="sort" class="form-control">
				<?php foreach(App\Thread::sortOptions() as $key=>$val): ?>
					<option value="<?=$key?>"<?=$sort==$key?' selected':''?>><?=$val?></option>
				<?php endforeach; ?>
			</select>
			</p>
		</div>
	</div>

	<ul class="list-group" id="threads">
	<?php foreach($threads as $thread): ?>
		
		<li class="list-thread">

			<figure class="ls-image">
				<img src="/images/generic-avatar.png" alt="" class="ls-avatar">				
			</figure>

			<h2><a href="/threads?id=<?=$thread['id']?>"><?=isset($thread['parent_title'])?$thread['parent_title']:$thread['title']?></a></h2>
			
			<span class="ls-info"><?=time_elapsed_string($thread['created_at'])?> By <b><?=$thread['username']?></b> (<?=$thread['replies'] . ' replies'?>)</span>

			<p class="excerpt">
				<?=html_entity_decode(substr($thread['body'], 0, 100))?>
			</p>

			<aside class="ls-replies"><?=$thread['replies'] . ' replies'?></aside>

			<?php if(is_logged() && $thread['user_id'] == user()->id): ?>
				<span class="ls-action">
					
					<a href="/thread/edit?id=<?=$thread['id']?>" class="ls-edit"><i class="fa fa-pencil"></i>Edit</a>
					<a href="/thread/remove?id=<?=$thread['id']?>" class="ls-remove"><i class="fa fa-times"></i>Delete</a>
				</span>
			<?php endif; ?>

		</li>

	<?php endforeach; ?>
	</ul>

</div>