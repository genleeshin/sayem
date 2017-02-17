<h1><?=$post?'Edit':'Create New'?></h1>
<?=view('validation-error')?>

<form action="/thread/<?=$post?'save':'create'?>" method="post">
	
	<?=csrf_token_field()?>

	<?php if($post): ?>

		<input type="hidden" name="id" value="<?=$post->id?>">

	<?php endif; ?>

	<?php if(!$post || is_null($post->parent_id)): ?>
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" name="title" value="<?=form_value('title', $post)?:''?>" placeholder="Enter your thread title">
		</div>

	<?php endif; ?>

	<div class="form-group">
		<label for="body">Message</label>
		<textarea name="body" id="body" cols="50" rows="10" required="required"><?=form_value('body', $post)?></textarea>
	</div>
	<button type="submit">Submit</button>
</form>