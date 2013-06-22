<?php

$usernameColors = array();
$colors = array(
	'#CC0066', '#3399FF', 'green', 'orange'
);

function getCol($username) {
	global $usernameColors;
	global $colors;

	if (isset($usernameColors[$username])) {
		return $usernameColors[$username];
	} else {
		$col = current($colors); next($colors);
		$usernameColors[$username] = $col;
	}

	return $col;
}

function explodeQuote($quoteContent) {
	$linesFixed = array();

	foreach (explode("\n", $quoteContent) as $line) {
		$lineX = array(
			'content' => $line,
			'username' => null,
			'bgColor' => null,
		);

		$linesFixed[] = $lineX;
	}

	return $linesFixed;
}

function findUsernames(array $quoteContent) {
	global $colors;
	global $usernameColors;

	reset($colors);
	$usernameColors = array();

	foreach ($quoteContent as &$line) {
		$regex = '#^[\(\)\:\d ]*<?([\w ]+)[:>] (.*)#i';

		preg_match($regex, $line['content'], $matches);

		switch (count($matches)) {
			case 3: 
				$msg = str_replace('<br />', null, $matches[2]);
				$msg = trim($msg);

				if (empty($msg)) {
					break;
				}

				$line['username'] = $matches[1];
				$line['usernameColor'] = getCol($line['username']);
				$line['content'] = htmlentities($matches[2]);

				break;
			default: 
				break;
		}

	}

	return $quoteContent;
}


/*
 * Flattening a multi-dimensional array into a
 * single-dimensional one. The resulting keys are a
 * string-separated list of the original keys:
 *
 * a[x][y][z] becomes a[implode(sep, array(x,y,z))]
 */

function array_flatten($array) {
  $result = array();
  $stack = array();
  array_push($stack, array("", $array));

  while (count($stack) > 0) {
    list($prefix, $array) = array_pop($stack);

    foreach ($array as $key => $value) {
      $new_key = $prefix . strval($key);

      if (is_array($value))
        array_push($stack, array($new_key . '.', $value));
      else
        $result[$new_key] = $value;
    }
  }

  return $result;
}

function filter($name, $type = FILTER_DEFAULT) {
	$v = filter_input(INPUT_GET, $name, $type);

	if (empty($v)) {
		$v = filter_input(INPUT_POST, $name, $type);
	}

	return $v;
}

function isAdmin() {
	if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
		return true;
	} else {
		return false;
	}
}

?>
