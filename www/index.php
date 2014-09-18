<?php
	// Load db
	$MusicData = json_decode(utf8_encode(file_get_contents('db.json')), true); // Load db in as associative array
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lauluvihik - Online sheet music in pdf and MusicXML format</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
	<style>
		body {
			font-family: 'Open Sans';
		}
		div.subtitle {
			color: #333333;
			font-size: small;
			font-style: italic;
		}

		h1 {
			color: #000099;
			text-align: center;
		}

		table {
			border: 0px;
			border-spacing: 1px;
			padding: 0px;
			width: 100%;
		}

		td {
			vertical-align: top;
		}

		td.links {
			text-align: center;
		}

		th {
			background-color: #666666;
			color: #CCCCCC;
			padding: 3px;
		}
	</style>
</head>
<body>
	<div style="margin-left: auto; margin-right: auto; width: 800px;">
	<h1>Teretulemast Online Lauluvihikule!</h1>
	<p>Siit leiate xml ja pdf muusikat</p>
	<table id="tblSongs">
		<thead><tr><th>Tiitel</th><th>Kategooria</th><th>Lingid</th></tr></thead>
		<tbody>
<?
		foreach ($MusicData["songs"]  as $song) {
			$category = '';
			foreach ($song['categories'] as $c) {
				if ($category != '')
					$category .= ', ';
				$category .= $MusicData["categories"][$c]['description_et'];

			}

			print '<tr><td>'.$song['title'].(($song['subtitle']) ? '<div class="subtitle">'.$song['subtitle'].'</div>' : '').'</td><td>'.$category.'</td><td class="links"><a href="pdf/'.$song["id"].'.pdf" download="'.$song['filename'].'.pdf" target="_blank">pdf</a>&nbsp;|&nbsp;<a href="musicxml/'.$song['id'].'.xml" download="'.$song['filename'].'.xml" target="_blank">xml</a></td></tr>';

		}

?>
		</tbody>
	</table>
</div>
</body>
</html>