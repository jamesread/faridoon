<section>
	{if $isLoggedIn}
	<h2>Welcome, {$username}!</h2>
	<p>Hopefully you are having a marvelous day.</p>

	<ul class = "block-links">
		{if $isAdmin}
			<li>
				<a href = "approvals.php">
					<svg class = "svg-icon">
						<use xlink:href = "#svg-approve" />
					</svg>

					Approvals
				</a>
			</li>
			<li><a href = "users.php">Users</a></li>
		{/if}
		{if $isAddEnabled}
		<li><a href = "add.php">Add quote</a></li>
		{/if}
		<li><a href = "logout.php">Log out</a></li>
	</ul>

	{else}
	<h2>You are not logged in.</h2>
	<p>Please <a href = "login.php">log in</a> to view your account.</p>
	{/if}
</section>
