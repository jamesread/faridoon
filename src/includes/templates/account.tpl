<section>
	{if $isLoggedIn}
	<h2>Welcome, {$username}!</h2>
	<p>There's not much for you to do here, apart from <a href = "logout.php">log out</a>.</p>
	{else}
	<h2>You are not logged in.</h2>
	<p>Please <a href = "login.php">log in</a> to view your account.</p>
	{/if}
</section>
