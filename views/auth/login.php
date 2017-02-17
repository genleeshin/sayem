<?=view('validation-error');?>

<form action="/login" method="post">
	<?=csrf_token_field()?>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" placeholder="Enter your email">
	</div>

	<div class="form-group">
		<label for="passworld">Password</label>
		<input type="password" name="password" id="password" placeholder="Your secret password">
	</div>

	<button type="submit">Login</button>

</form>