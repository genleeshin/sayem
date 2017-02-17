<?=view('validation-error');?>

<form action="/register" method="post">
	<?=csrf_token_field()?>
	<div class="form-group">
		<label for="name">You Name</label>
		<input type="text" name="name" id="name" placeholder="Enter your full name">
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" id="email" placeholder="Enter your email">
	</div>

	<div class="form-group">
		<label for="passworld">Password</label>
		<input type="password" name="password" id="password" placeholder="Your secret password">
	</div>

	<div class="form-group">
		<label for="confirm_password">Re-enter</label>
		<input type="password" name="confirm_password" id="confirm_password" placeholder="Enter your password again">
	</div>

	<button type="submit">Register</button>

</form>