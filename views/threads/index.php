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
		<h2><a href="/threads?id=<?=$thread->id?>"><?=$thread->title?></a></h2>
		<?=time_elapsed_string($thread->created_at)?> By <b><?=$thread->user->name?></b> (<?=$thread->replies . ' replies'?>)

		<?php if(is_logged() && $thread->user_id == user()->id): ?>
			
			<a href="/thread/edit?id=<?=$thread->id?>">Edit</a> | 
			<a href="/thread/remove?id=<?=$thread->id?>">Delete</a>

		<?php endif; ?>

		<p>
			<?=$thread->excerpt()?>
		</p>

	</li>

<?php endforeach; ?>
</ul>