<?php
session_start();

require_once("lib/httpful/httpful.phar");
require_once("JuxtaClient.php");

// file for deleting the image
$juxtclient = new JuxtaPHP();

$juxtclient->removeImageById($_GET['id']);

header("location: http://www.paulius.nl/4ME102FA/JuxtaLearn/index.php");
?>