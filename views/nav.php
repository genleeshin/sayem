<nav>
	<ul class="nav">
		<li class="nav-logo">SmartPhone QA</li>
		<li>
			<form action="/search" method="post">
				<?=csrf_token_field()?>
				<input type="search" name="q" placeholder="Search..">
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