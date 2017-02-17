<ul>
<?php foreach($threads as $thread): ?>
	
	<li><a href="/threads?id=<?=$thread->id?>"><?=$thread->title?></a></li>

<?php endforeach; ?>
</ul>