<!DOCTYPE html>

<html>
<head>
    <title>{$siteTitle}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/theme.css" />
    <link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/app.css" />

	<link rel = "shortcut icon" type = "image/png" href = "resources/svg/faridoon.png" />

    <script src="resources/javascript/main.js" type = "text/javascript"></script>

	<style type = "text/css">
	{$inlineCss}
	</style>
</head>

<body>
    <header>
		<img src = "resources/svg/faridoon.svg" title = "logo" class = "logo" />

		<h1>
			<a href = "index.php">{$siteTitle}</a>
		</h1>

        <nav>
            <ul class = "navigation">
                <li><a href = "list.php?order=latest">Latest</a></li>
                <li><a href = "list.php?order=random">Random</a></li>
				{if $isVotingEnabled}
                <li><a href = "list.php?order=rank">Highest voted</a></li>
				{/if}
            </ul>
            <ul class = "navigation">
                {if $isLoggedIn}
                    <li><a href = "account.php"><strong>{$username}</strong></a></li>

					{if $isAdmin}
						<li>
							<a href = "approvals.php">Approvals</a>
							({$countApprovals})
						</li>
					{/if}
                {else}
                    <li><a href = "login.php">Login</a></li>
                {/if}

                <li class = "right"><a href = "add.php">Add</a></li>
            </ul>
        </nav>
    </header>
    <main>
