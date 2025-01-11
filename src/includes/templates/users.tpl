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
				<a href = "user-edit.php?uid={$user.id}">Edit</a>
			{/if}
		</td>
	</tr>
{/foreach}
	</tbody>
	</table>
</section>

<section>
	<h2>Usergroups</h2>

	<p>Note: People who a not logged in (ie: Guests) have zero permissions.</p>
	<a href = "usergroup-create.php">Create a new usergroup</a>
</section>

	{foreach from = $usergroups item = $usergroup}
<section>
		<div class = "section-header">
			<h2>Usergroup: {$usergroup.title}</h2>
			<ul class = "section-links">
				{if $usergroup.id > 2}
				<li>
					<a href = "users.php?deleteGroup={$usergroup.id}" title = "Delete this usergroup">
						<svg class = "svg-icon" viewBox = "0 0 24 24" alt = "Delete this usergroup">
							<use xlink:href = "#svg-delete" alt = "Delete this usergroup" />
						</svg>
					</a>
				</li>
				{/if}
			</ul>
		</div>

		<p>Group ID: {$usergroup.id}</p>

		<div class = "section-header">
			<p>Permissions:</p>

			{if $usergroup.id != 1}
			<ul class = "section-links">
				<li>
					<a href = "usergroup-grant.php?gid={$usergroup.id}" title = "Grant Permission">
						<svg class = "svg-icon" viewBox = "0 0 24 24" alt = "Grant permissions">
							<use xlink:href = "#svg-add" alt = "Grant permissions" />
						</svg>
					</a>
				</li>
			</ul>
			{/if}
		</div>

		{if empty($usergroup.permissions)}
			<p>No extra permissions</p>
		{else}
		    <table>
				<thead>
					<tr>
						<th>Key</th>
						<th>Description</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
				{foreach from = $usergroup.permissions item = $permission}
					<tr>
					<td>{$permission.key}</td>
					<td>{$permission.description}</td>
					<td>
						{if $usergroup.id != 1}
						<a href = "users.php?revokePermission={$permission.pid}&gid={$usergroup.id}" title = "Revoke permission">
							<svg class = "svg-icon" viewBox = "0 0 24 24" alt = "Revoke permission">
								<use xlink:href = "#svg-delete" alt = "Revoke permission" />
							</svg>
						</a>
						{else}
							Admins cannot have permissions revoked
						{/if}
					</tr>
				{/foreach}
				</tbody>
			</table>
		{/if}
</section>
	{/foreach}
