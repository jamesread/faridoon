<section id = "quote{$quote->id}" class = "quote">
	{if $isVotingEnabled}
	<div class = "voteContainer">
		<button class = "voteButton" onclick = "voteUp({$quote->id});">&#9650;</button>
		<span class = "voteCount">{$quote->voteCount}</span>
		<button class = "voteButton" onclick = "voteDown({$quote->id});">&#9660;</button>
	</div>
	{/if}

	<div class = "quoteContainer">
		<div class = "quoteHeader">
			<strong><a href = "show.php?action=show&amp;id={$quote->id}">#{$quote->id}</a></strong>


			{if isAdmin()}
			<ul class = "adminLinks">
				{if !$quote->approved}
				<li>
					<a href = "approvals.php?approveId={$quote->id}">
						<svg class = "svg-icon">
							<use xlink:href = "#svg-approve" />
						</svg>
					</a>
				</li>
				{/if}

				<li>
					<a href = "edit.php?id={$quote->id}" title = "Edit quote">
						<svg class = "svg-icon">
							<use xlink:href = "#svg-edit" />
						</svg>
					</a>
				</li>
				<li>
					<a href = "delete.php?id={$quote->id}" title = "Delete quote">
						<svg class = "svg-icon">
							<use xlink:href = "#svg-delete" />
						</svg>
					</a>
				</li>
			</ul>
			{/if}
		</div>

		<div class = "quoteBody">
			<p>
			{foreach $quote->lines as $line}
				<span class = "line">
				{if isset($line.username)}
					<span class = "username usernameColor{$line.usernameColor}">{$line.username}</span>:
				{/if}
				{$line.content}
				</span>
			{/foreach}
			</p>
		</div>
	</div>
</section>
