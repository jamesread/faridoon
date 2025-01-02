<section class = "quoteContainer" id = "quote{$quote->id}">
	<div class = "voteContainer">
		<a class = "voteButton" onclick = "voteUp({$quote->id})" class = "up">&#9650;</a>
		<span class = "voteCount">{$quote->voteCount}</span>
		<a class = "voteButton" onclick = "voteDown({$quote->id})" class = "up">&#9660;</a>
	</div>

	<div class = "textContainer">
		<strong><a href = "show.php?action=show&amp;id={$quote->id}">#{$quote->id}</a></strong> - 
		<span class = "subtle">{$quote->created}</span>

		{if isAdmin()}
		[
		<ul class = "admin">
			<li><a href = "edit.php?id={$quote->id}">edit</a></li>
			<li><a href = "delete.php?id={$quote->id}">delete</a></li>
			{if !$quote->approved}
			<li><a href = "approvals.php?approveId={$quote->id}">approve</a></li>
			{/if}
		</ul>
		]
		{/if}

		<p class = "quote">
			{foreach $quote->getContentForHtml() as $line}
				<span class = "line">
				{if isset($line.username)}
					<span style = "color: {$line.usernameColor}">{$line.username}</span>:
				{/if}
				{$line.content}
				</span>
			{/foreach}
		</p>
	</div>
</section>
