<?php
namespace DiakritikAPI;

require_once 'diakritikApi.class.php';


$testValues = [
	0,
	1,
	12345,
	'slovo',
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	'A quick brown fox jumps over the lazy dog.',
	'Necht jiz hrisne saxofony dablu rozezvuci sin udesnymi tony waltzu, tanga a quickstepu.',
	'Krdel stastnych datlov uci pri usti Vahu mlkveho kona obhryzat koru a zrat cerstve maso.',
	'KRDEL STASTNYCH DATLOV UCI PRI USTI VAHU MLKVEHO KONA OBHRYZAT KORU A ZRAT CERSTVE MASO.',
	'Kupili sme si novy byt.',
	'Byt, ci nebyt.',
	'
<!doctype html>
<html lang="sk">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>...</title>
	<style>...</style>
</head>
<body>...</body>
</html>',
];

$diakritik = new DiakritikAPI();

function printTest($input) {
	global $diakritik;
	$output     = $diakritik->doplnDiakritiku($input);
	$typeInput  = gettype($input);
	$typeOutput = gettype($output);
	$input      = trim(htmlspecialchars($input));
	$output     = trim(htmlspecialchars($output));
	echo "<tr><td><em>$typeInput:</em> " . print_r($input, true) . "</td><td><em>$typeOutput:</em> " . print_r($output, true) . "</td></tr>";
}
?>

<!doctype html>
<html lang="sk">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="robots" content="nofollow">
	<title>DiakritikAPI tests</title>
	<style>
		em {
			color: seagreen;
		}
		td {
			white-space: pre;
		}
	</style>
</head>
<body>
	<table border="1" cellpadding="3" cellspacing="0">
		<thead>
			<tr>
				<th>Input</th>
				<th>Output</th>
			</tr>
		</thead>
		<tbody>
			<? foreach ($testValues as $value) { ?>
			<? printTest($value); ?>
			<? } ?>
		</tbody>
	</table>
</body>
