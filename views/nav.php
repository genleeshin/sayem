<nav>
	<ul class="nav">
		<li class="nav-logo">SmartPhone QA</li>
		<li>
			<form action="/search" method="post">

				<?=csrf_token_field()?>

				<input type="search" name="q" placeholder="Search..">

				<select name="type" id="type">
					<option value="title">Thread Title</option>
					<option value="post">Post</option>
					<option value="user">User</option>
				</select>

				<button type="submit">Search</button>

			</form>
		</li>
		<li>
			<?php if(is_logged()): ?>
				<a href="/thread/new">Create a Thread</a>

				<b>Hello, <?=session('user')->name?></b> (<a href="/logout">Logout</a>)


			<?php else: ?>
				<a href="/login">Login</a>
				<a href="/register">Register</a>
			<?php endif; ?>
		</li>
	</ul>
</nav>