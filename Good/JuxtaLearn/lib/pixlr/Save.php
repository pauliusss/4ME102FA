<?php
session_start();

require_once("../../lib/httpful/httpful.phar");
require_once("../../JuxtaClient.php");

class Save {

	public function __construct() {
		$source = @file_get_contents($_GET['image']);
		
		$count = 1;
		$exists = true;

		while ($exists)
		{
			if (file_exists("./img/" . $count . ".jpg"))
			{
				$count ++;
			}
			else
			{
				$exists = false;
			}
		}
		
		$target = "./img/" . $count . ".jpg";

		if (isset($_GET['image'])) {
			file_put_contents($target, $source);
		}
		
		$juxtclient = new JuxtaPHP();
		$image = array('parentImageId' => $_GET['id'],
							 'title' => $_GET['title'],
							 'description' => $_GET['description'],
							 'subject' => $_GET['subject'],
							 'topic' => $_GET['topic'],
							 'url' => "http://www.paulius.nl/4ME102FA/lib/pixlr/img/" . $count .".jpg"
);
//$juxtclient->createNewImage($image);/**/

		$url = "http://www.paulius.nl/4ME102FA/JuxtaLearn/savenew.php?";
		
		$url = $url . "action=add";
		$url = $url . "&id=" . $_GET['id'];
		$url = $url . "&topic=" . $_GET['topic'];
		$url = $url . "&title=" . $_GET['title'];
		$url = $url . "&subject=" . $_GET['subject'];
		$url = $url . "&desc=" . $_GET['description']; //+ " (edited by: " + role.val() + ")";
		$url = $url . "&type=annotation";
		$url = $url . "&url=http://www.paulius.nl/4ME102FA/JuxtaLearn/lib/pixlr/img/" . $count . ".jpg";
	
		//echo($url);
		
		header('Location: '.$url);
	}
}

$instance = new Save();

?>
<html>
	
	<head>
		
		<script>

			//window.parent.location.reload();

		</script>

	</head>

</html>