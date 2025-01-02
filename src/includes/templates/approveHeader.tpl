<section>
	{if $count == 0}
	<h2>Nothing to approve</h2>
    <p>Perhaps you would like a crumpet instead?</p>
	{else}
	<h2>Approval queue</h2>
    <p>There are {$count} quote(s) to approve.</p>
	{/if}
</section>
