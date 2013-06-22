<?php

require_once 'includes/common.php';

echo <<<DT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

DT;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Faridoon</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/main.css" />
	<link rel = "stylesheet" type = "text/css" href = "resources/stylesheets/jquery.snippet.min.css" />

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type = "text/javascript"></script>
	<script src="resources/javascript/jquery.snippet.min.js" type = "text/javascript"></script>
</head>

<body>
	<div id = "header">
		<h1>Faridoon</h1>

		<ul class = "navigation">
			<li class = "right"><a href = "add.php">Add</a></li>
			<li><a href = "list.php?order=latest">Latest</a></li>
			<li><a href = "list.php?order=random">Random</a></li>
			<?php if (isAdmin()) { 

			$sql = 'SELECT count(q.id) countNew FROM quotes q WHERE q.approval = 0';
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$countNew = $stmt->fetch();
			$countNew = $countNew['countNew'];
			$countNew = intval($countNew);

			if ($countNew == 0) {
				echo '<li class = "right"><a href = "approvals.php">Approvals</a></li>';
			} else {
				echo '<li class = "right"><a href = "approvals.php">Approvals</a> (' . $countNew . ')</li>';
			}
		
			echo '<li class = "right"><a href = "logout.php">Logout</a></li>';
			} else { 
			echo '<li class = "right"><a href = "login.php">Login</a></li>';
			} ?>
		</ul>
	</div>
<?php if (strpos($_SERVER['PHP_SELF'], 'faridoon') !== FALSE) { ?>
	<p style = "padding: 1em; width: 90%; margin: auto; margin-bottom: 2em; background-color: beige; border-radius: 1em;">This site is also accessible from <a href = "http://tydus.net/quotes">http://www.tydus.net/quotes</a>.</p>
<?php } ?>
	<div id = "content">
<?php


?>
