<form action="/thread/reply" method="post" id="form-reply" class="<?=is_logged()?'':'disabled'?>">
	
	<input type="hidden" name="id" value="<?=$post->id?>">
	<div class="form-group">
		<textarea name="body" id="body" cols="50" rows="10"></textarea>
	</div>
	<button type="submit">Submit</button>
</form>