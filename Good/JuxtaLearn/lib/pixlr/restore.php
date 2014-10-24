<?php
session_start();

	class Restore {

		public function __construct() {
			$source = file_get_contents('./img/restore.jpg');
			$target = "./img/mona.jpg";

			file_put_contents($target, $source);
		}
	}

	$instance = new Restore();
	header('location: http://paulius.nl/4ME102FA/JuxtaLearn');

?>