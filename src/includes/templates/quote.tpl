<section id = "quote{$quote->id}" class = "quote">
	{if $isVotingEnabled}
	<div class = "voteContainer">
		<a class = "voteButton" onclick = "voteUp({$quote->id})" class = "up">&#9650;</a>
		<span class = "voteCount">{$quote->voteCount}</span>
		<a class = "voteButton" onclick = "voteDown({$quote->id})" class = "up">&#9660;</a>
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
