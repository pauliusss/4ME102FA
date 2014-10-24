<?php
session_start();

class Save {

	public function __construct() {
		$source = @file_get_contents($_GET['image']);
		$target = "./img/mona.jpg";

		if (isset($_GET['image'])) {
			file_put_contents($target, $source);
		}
		//header('location: http://paulius.nl/4ME102FA/JuxtaLearn/index.php');
	}
}

$instance = new Save();

?>
<html>
	
	<head>
		
		<script>

			window.parent.location.reload();

		</script>

	</head>

</html>