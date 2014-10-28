<?php
session_start();

//$_GET['action'];
//$_GET['id'];
//$_GET['topic'];
//$_GET['title'];
//$_GET['description'];

require_once("lib/httpful/httpful.phar");
require_once("JuxtaClient.php");

$juxtclient = new JuxtaPHP();

		$image = array('parentImageId' => $_GET['id'],
							 'title' => $_GET['title'],
							 'description' => $_GET['description'],
							 'subject' => $_GET['subject'],
							 'topic' => $_GET['topic'],
							 'url' => $_GET['url']
		);
		
		//echo("<pre>");
		//print_r($juxtclient->createNewImage($image))
		$juxtclient->createNewImage($image);
		//echo("</pre>");



//header("location: http://www.paulius.nl/4ME102FA/JuxtaLearn/index.php");
?>

<html>
	
	<head>
		
		<script>

			window.parent.location.reload();

		</script>

	</head>

</html>