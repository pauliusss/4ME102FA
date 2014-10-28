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

switch ($_GET['action'])
{
	case "add":
		$image = array('parentImageId' => "54098e21a177864a5600000a",
							 'title' => "New test image",
							 'description' => "New test image description",
							 'subject' => "Physics",
							 'topic' => "Physics",
							 'url' => $_GET['url']
		);
		$juxtclient->createNewImage($image);
		
		break;
	case "edit":
		$image = array(		 'title' => $_GET['title'],
							 'topic' => $_GET['topic'],
							 'subject' => $_GET['subject'],
							 'description' => $_GET['desc']);
							 //var_dump($image);
		$aaa = $juxtclient->updateImageById($_GET['id'], $image);
		//echo("<pre>");
		//var_dump($image);
		//echo("</pre>");
		
		//print_r($aaa->body->code);
		break;
	case "delete":
		
		break;
}
if ($_POST['action'] = "add")
{
/*$image = array('parentImageId' => "54098e21a177864a5600000a",
							 'title' => "New test image",
							 'description' => "New test image description",
							 'subject' => "Physics",
							 'topic' => "Physics",
							 'url' => "http://www.dam7.com/Images/Puppy/images/myspace-puppy-images-0005.jpg"
);*/
}
else
{
	
}


//print_r($juxtclient->createNewImage($image));



//header("location: http://www.paulius.nl/4ME102FA/JuxtaLearn/index.php");
?>

