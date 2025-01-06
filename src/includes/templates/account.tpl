<section>
	{if $isLoggedIn}
	<h2>Welcome, {$username}!</h2>
	<p>There's not much for you to do here, apart from <a href = "logout.php">log out</a>.</p>

	{if $isAdmin}
	<h2>Admin links</h2>
	<ul class = "block-links">
		<li>
			<a href = "approvals.php">
				<svg class = "svg-icon">
					<use xlink:href = "#svg-approve" />
				</svg>

				Approvals
			</a>
		</li>
		<li><a href = "users.php">Users</a></li>
	</ul>
	{/if}

	{else}
	<h2>You are not logged in.</h2>
	<p>Please <a href = "login.php">log in</a> to view your account.</p>
	{/if}
</section>
