<?php
session_start();

$role = "na";
if (isset($_SESSION['provider']))
{
	switch($_SESSION['provider'])
	{
		case "Twitter":
			$role = "Administrator";
			break;
		case "Facebook":
			$role = "Student";
			break;
		case "Google":
			$role = "Teacher";
			break;
		default:
			$role = "na";
			break;
	}
		
	if (!empty($_SESSION['info']['name']))
	{
		$src = $_SESSION['info']['image'];
		?>
		<table><tr><td>
		<?php
		
		echo ("<img width=\"50\" height=\"50\" src=\"$src\" alt=\"user image\"/>");
		?>
		</td><td>
		<?php
		
		echo ("Hello, " . $_SESSION['info']['name'] . "!<br/>");
		echo ("You are acting as: $role. ");
		echo ("<a href=\"..\">Logout</a>");
		?>
		</td></tr></table>
		<?php
	}
}
else
{
	echo ("<p>Oops, we don't recognize you... You need to <a href=\"..\">log in.</a></p>");
}
echo ("<hr/>");

require_once("lib/httpful/httpful.phar");
require_once("JuxtaClient.php");

$juxtclient = new JuxtaPHP();

$images = $juxtclient->getImages();
$videos = $juxtclient->getVideos();

echo "<table><colgroup><col span=\"1\" style=\"width: 50%;\"><col span=\"1\" style=\"width: 50%;\">
    </colgroup><tr><thead><th valign=\"top\">IMAGES (<a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Add</a>)</th><th>VIDEOS (<a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Add</a>)</th></thead></tr><tbody><tr><td style=\"vertical-align:top;\">";

$countImg = 0;
//echo "<pre>";
foreach ($images->body as $image) {
$countImg ++;
if ($image->parentImageId != "")
{
	$parentImage = $images = $juxtclient->getImageById($image->parentImageId);
}
else
{
	$parentImage = "";
}
  //$array[$key + 1] = $item + 2;
  //echo $image->description . "<br/>";
  echo "<table><tr>";
  echo "<td><img height=\"250\" src=\"$image->url\" alt=\"$image->title\"/><br/></td>";
  echo "<td style=\"valign:top;\"><table>";
  echo "<tr><td>#$countImg</td></tr>";
  echo "<tr><td>Description: $image->description</td></tr>";
  echo "<tr><td>Topic: $image->topic</td></tr>";
  echo "<tr><td>Title: $image->title</td></tr>";
  echo "<tr><td>Created: $image->creationDate</td></tr>";
  if ($parentImage != "")
  {echo "<tr><td>Parent (". $parentImage->body->title . " / " . $parentImage->body->topic . " / " . $parentImage->body->description . ")</td></tr>";
  echo "<tr><td><img height=\"50\" src=\"" . $parentImage->body->url . "\" alt=\"" . $parentImage->body->title . "\" /></td></tr>";
  } 
  //echo "<tr><td>ParentId: $image->parentImageId</td></tr>";
  echo "<tr><td><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Edit</a><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Delete</a></td></tr>";
  echo "</table></td>";
  echo "</tr></table>";
  //echo "Delete - not implemented yet<br/>";
}

echo ("</td><td style=\"vertical-align:top;\">");

$countVid = 0;
foreach ($videos->body as $video) {
$countVid++;
$ytarray=explode("/", $video->youtubeUrl);
$ytendstring=end($ytarray);
$ytendarray=explode("?v=", $ytendstring);
$ytendstring=end($ytendarray);
$ytendarray=explode("&", $ytendstring);
$ytcode=$ytendarray[0];

  echo "<table><tr>";
echo "<td><iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe></td>";
  echo "<td><table>";
  echo "<tr><td>#$countVid</td></tr>";
  echo "<tr><td>Description: $video->description</td></tr>";
  echo "<tr><td>Topic: $video->topic</td></tr>";
  echo "<tr><td>Subject: $video->subject</td></tr>";
  echo "<tr><td>Title: $video->title</td></tr>";
  echo "<tr><td>Created: $video->creationDate</td></tr>";
  echo "<tr><td><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Edit</a><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Delete</a></td></tr>";
  echo "</table></td>";
  echo "</tr></table>";
}

echo("</td></tr></tbody></table>");

//print_r($juxtclient->getImages());
//print_r($juxtclient->getVideos());
//echo "</pre>";










switch($role)
{
	case "Administrator":
		
		break;
	case "Student":
		
		break;
	case "Teacher":
		
		break;
	default:
		$role = "na";
		break;
}
?>