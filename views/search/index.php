<h4>Search result for "<?=$q?>"</h4>
<p>
Sort by:
<select name="sort" id="sort">
	<?php foreach(App\Thread::sortOptions() as $key=>$val): ?>
		<option value="<?=$key?>"<?=$sort==$key?' selected':''?>><?=$val?></option>
	<?php endforeach; ?>
</select>
</p>

<ul>
<?php foreach($threads as $thread): ?>
	
	<li>
		<h2><a href="/threads?id=<?=$thread['id']?>"><?=isset($thread['parent_title'])?$thread['parent_title']:$thread['title']?></a></h2>
		<?=time_elapsed_string($thread['created_at'])?> By <b><?=$thread['username']?></b> (<?=$thread['replies'] . ' replies'?>)

		<?php if(is_logged() && $thread['user_id'] == user()->id): ?>
			
			<a href="/thread/edit?id=<?=$thread['id']?>">Edit</a> | 
			<a href="/thread/remove?id=<?=$thread['id']?>">Delete</a>

		<?php endif; ?>

		<p>
			<?=substr($thread['body'], 0, 100)?>
		</p>

	</li>

<?php endforeach; ?>
</ul>