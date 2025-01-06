<section>
	<h2>Users</h2>
	<p>Here is a list of all users:</p>
	<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Usergroup</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
{foreach from = $users item = $user}
	<tr>
		<td>{$user.id}</td>
		<td>{$user.username}</td>
		<td>{$user.groupTitle}</td>
		<td>
			{if $user.id == $currentUid}
				Cannot edit yourself
			{else}
				{if $user.group != 1}
				<a href = "?promote={$user.id}">Promote to admin</a></td>
				{else}
				<a href = "?demote={$user.id}">Demote to user</a></td>
				{/if}
			{/if}
		</td>
	</tr>
{/foreach}
	</tbody>
	</table>
</section>
