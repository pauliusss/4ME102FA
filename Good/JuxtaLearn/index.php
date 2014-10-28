<?php
session_start();

$body = "";
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

		$body .= "<table><tr><td>";
		$body .= "<img width=\"50\" height=\"50\" src=\"$src\" alt=\"user image\"/>";
		$body .= "</td><td>";
		
		$body .=  "Hello, " . $_SESSION['info']['name'] . "!<br/>";
		$body .=  "You are acting as: $role. ";
		$body .= "<a href=\"..\">Logout</a>";
		$body .= "</td></tr></table>";
	}
}
else
{
	$body .= "<p>Oops, we don't recognize you... You need to <a href=\"..\">log in.</a></p>";
}
$body .=  "<hr/>";
if ($_GET["SearchFor"] == "")
{
	$queryText = "";
}
else
{
	$queryText = htmlspecialchars($_GET["SearchFor"]);
	$queryIn = htmlspecialchars($_GET["SearchIn"]);
}

$body .= "<h3>FILTER IMAGES</h3>";
$body .= "<hr/>";



$body .= "<form id=\"search\" name=\"search\" action=\"\" method=\"get\">";
$body .= "Enter search string: <input type=\"text\" id=\"SearchFor\" name=\"SearchFor\"";
if ($queryText != "") $body .= " value=\"$queryText\"";
$body .= "/><br/>";
$body .= "Search for: <select id=\"SearchIn\" name=\"SearchIn\">";
$body .= "<option value=\"Description\"";
if ($_GET["SearchIn"] == "Description") $body .= " selected=\"selected\"";
$body .= ">Description</option>";
$body .= "<option value=\"Topic\"";
if ($_GET["SearchIn"] == "Topic") $body .= " selected=\"selected\"";
$body .= ">Topic</option>";
$body .= "<option value=\"Title\"";
if ($_GET["SearchIn"] == "Title") $body .= " selected=\"selected\"";
$body .= ">Title</option>";
$body .= "<option value=\"Subject\"";
if ($_GET["SearchIn"] == "Subject") $body .= " selected=\"selected\"";
$body .= ">Subject</option>";

$body .= "</select>";
$body .= "<input type=\"submit\" value=\"Filter\"/>";
$body .= "<input type=\"button\" value=\"Clear filter\"  onclick=\"clearFilter();\"/>";
$body .= "</form>";

//$body .= "<hr/>";

/*
$body .= "<form id=\"show\" name=\"show\">";
$body .= "<input type=\"checkbox\" name=\"images\" value=\"img\" checked=\"checked\" onclick=\"swap($('#divImages'));swap($('#divImagesList'));\">Show images<br/>";
$body .= "<input type=\"checkbox\" name=\"videos\" value=\"vid\" checked=\"checked\" onclick=\"swap($('#divVideos'));swap($('#divVideosList'));\">Show videos<br/>";
$body .= "<input type=\"checkbox\" name=\"users\" value=\"usr\" checked=\"checked\" onclick=\"swap($('#divUsers'));\">Show users<br/>";
$body .= "</form>";*/

$body .= "<input type=\"checkbox\" name=\"images\" value=\"img\" onclick=\"swapParent();\">Raw view - show only last version of every image<br/>";

$body .= "<hr/>";

require_once("lib/httpful/httpful.phar");
require_once("JuxtaClient.php");

$juxtclient = new JuxtaPHP();

$images = $copyOfImages = $juxtclient->getImages();


$body .= "<div id=\"accordion\">";

  if ($role == "Administrator")
  {
  $body .= "<div class=\"group\">
    <h3>USERS</h3>
	<div>This part is not implemented (for design purposes only)...</div>
  </div>";
  }


  $body .= "<div class=\"group\">
    <h3>IMAGES</h3>
    <div>";

$countImg = 0;
$countVisible = 0;

foreach ($images->body as $image)
{
	$countImg ++;
	if (
		($queryText == "") ||
		(($queryIn == "Topic" && strpos(strtolower($image->topic), strtolower($queryText)) !== false) ||
		($queryIn == "Description" && strpos(strtolower($image->description), strtolower($queryText)) !== false) ||
		($queryIn == "Subject" && strpos(strtolower($image->subject), strtolower($queryText)) !== false) ||
		($queryIn == "Title" && strpos(strtolower($image->title), strtolower($queryText)) !== false))
	)
	{
		$countVisible ++;
		
		$isParent = false;
		foreach ($copyOfImages->body as $copyImage)
		{
			if ($image->_id == $copyImage->parentImageId)
			{
				$isParent = true;
			}
		}		
		
		if ($image->parentImageId != "")
		{
			$parentImage = $juxtclient->getImageById($image->parentImageId);
		}
		else
		{
			$parentImage = "";
		}
		
		if ($isParent)
		{
			$body .= "<span id=\"parent\">";
		}
		
		$body .=  "<table><tr>";
		$body .=  "<td><img height=\"300\" src=\"$image->url\" alt=\"$image->title\"/><br/></td>";
		$body .=  "<td style=\"valign:top;\"><table>";
		$body .=  "<tr><td>#$countImg</td></tr>";
		$body .=  "<tr><td>Description: $image->description</td></tr>";
		$body .=  "<tr><td>Topic: $image->topic</td></tr>";
		$body .=  "<tr><td>Title: $image->title</td></tr>";
		$body .=  "<tr><td>Subject: $image->subject</td></tr>";
		$body .=  "<tr><td>Created: $image->creationDate</td></tr>";
		$body .=  "<tr><td>Id: $image->_id</td></tr>";
		
		
		
		if ($parentImage != "")
		{
			$body .= "<tr><td>";
			$body .= "<div id=\"accordionHistory" . $countImg. "\">";
			$body .= "<div class=\"group\">
			<h3>Show history</h3>
			<div>";
			$cycleCount = 0;
			//while ($parentImage != "")
			//{
				$purl = $parentImage->body->url;
				$ptitle = $parentImage->body->title;
				$pdesc = $parentImage->body->description;
				$pcreated = $parentImage->body->creationDate;
				$ptopic = $parentImage->body->topic;
				$psubject = $parentImage->body->subject;
				
				$body .=  "<table><tr><td><img height=\"200\" src=\"$purl\" alt=\"$ptitle\"/><br/></td></tr>";
				$body .=  "<tr><td>Description: $pdesc</td></tr>";
				$body .=  "<tr><td>Topic: $ptopic</td></tr>";
				$body .=  "<tr><td>Title: $ptitle</td></tr>";
				$body .=  "<tr><td>Subject: $psubject</td></tr>";
				$body .=  "<tr><td>Created: $pcreated</td></tr></table><br/>";
				
				//Parent (". $parentImage->body->title . " / " . $parentImage->body->topic . " / " . $parentImage->body->description . ")
				
				//$body .=  "<tr><td><img height=\"50\" src=\"" . $parentImage->body->url . "\" alt=\"" . $parentImage->body->title . "\" /></td></tr></table>";
				//$body .= "<tr><td><a href=\"history.php?id=$image->_id\" onClick=\"alert('This is not implemented yet!')\">View history</a></td></tr>";
				if ($cycleCount < 5)
				{
					$parentImage = $juxtclient->getImageById($parentImage->body->parentImageId);
					$cycleCount ++;
				}
				else
				{
					$parentImage = "";
				}
				// if error then $parentImage = "";
			//}
			$body .= "</div></div>";
			
			$body .= "</div>";
			$body .= "</tr></td>";
			
		}
		/*else
		{
			$body .= "<tr><td>This image doesn't have any history.</td></tr>";
		}*/
		$var = "?title=$image->title&topic=$image->topic&id=$image->_id&subject=$image->subject&description=$image->description";
		$pixlrString = "{image:'$image->url', title:'$image->title', method:'GET', service:'editor', target:'http://www.paulius.nl/4ME102FA/JuxtaLearn/lib/pixlr/Save.php" . $var ."', exit:'http://www.paulius.nl/4ME102FA/JuxtaLearn/lib/pixlr/Save.php', redirect:'true', locktarget:'true'}";
		//image: _elmImage.src,
			//title: "pixlr editor",
			//method: "GET",
			//target: URL_SAVE_IMAGE,
			//exit: URL_SAVE_IMAGE,
			//redirect: "true",
			//locktarget: "true",
		
		if ($role == "Teacher" || $role == "Administrator" )
		{
			if (!$isParent)
			{
				$body .=  "<tr><td><a href=\"javascript:pixlr.overlay.show($pixlrString);\" onClick=\"\">";
				$body .= "Edit image</a></td></tr>";
				$body .= "<tr><td><a id=\"annotate-image" . $countImg . "\" href=\"#\" onClick=\"StoreCurrent('$image->_id', '$image->title', '$image->description', '$image->topic', '$image->subject'); FillImageAnnotationDialog('$image->_id', '$image->title', '$image->description', '$image->topic', '$image->subject', '$image->url', 'edit', '$role');\">Edit annotation</a></td></tr>";
				$body .= "<tr><td><a href=\"delete.php?id=$image->_id\">Delete</a></td></tr>";
			}
			else
			{
				$body .= "<tr><td>You cannot edit/delete/annotate this picture as it has child(ren).</td></tr>";
			}
		}
		$body .=  "</table></td>";
		$body .=  "</tr></table><br/>";
		
		if ($isParent)
		{
			$body .= "</span>";
		}
	}
}
if ($countVisible == 0)
{
	$body .= "Sorry, there are no images to show...";
}
 $body .= "</div>
  </div>
  
  <div class=\"group\">
    <h3>VIDEOS</h3>
	<div>";
	
	
	include ("./edit.php");
	
	
$videos = $juxtclient->getVideos();
$countVid = 0;
foreach ($videos->body as $video)
{
	$countVid++;
	$ytarray = explode("/", $video->youtubeUrl);
	$ytendstring = end($ytarray);
	$ytendarray = explode("?v=", $ytendstring);
	$ytendstring = end($ytendarray);
	$ytendarray = explode("&", $ytendstring);
	$ytcode = $ytendarray[0];

	$body .=  "<table><tr>";
	$body .=  "<td><iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe></td>";
	$body .=  "<td><table>";
	$body .=  "<tr><td>#$countVid</td></tr>";
	$body .=  "<tr><td>Description: $video->description</td></tr>";
	$body .=  "<tr><td>Topic: $video->topic</td></tr>";
	$body .=  "<tr><td>Subject: $video->subject</td></tr>";
	$body .=  "<tr><td>Title: $video->title</td></tr>";
	$body .=  "<tr><td>Created: $video->creationDate</td></tr>";
	if ($role == "Teacher" || $role == "Administrator")
	{
		$body .=  "<tr><td><a href=\"#\" onClick=\"alert('This part is not implemented (for design purposes only)...')\">Annotate video</a></td></tr>";
		$body .=  "<tr><td><a href=\"#\" onClick=\"alert('This part is not implemented (for design purposes only)...')\">Delete</a></td></tr>";
	}
	$body .=  "</table></td>";
	$body .=  "</tr></table><br/>";
}
if ($countVid == 0)
{
	$body .= "Sorry, there are no videos to show...";
}

  $body .= "</div></div>";
  
  
  if ($role == "Teacher")
  {
	  $body .= "<div class=\"group\">
					<h3>TARGET GROUPS</h3><div>This part is not implemented (for design purposes only)...</div>";

	  $body .= "</div>";
  }
  
$body .= "</div>";



/*
$body .= "<table><colgroup><col span=\"1\" style=\"width: 50%;\"><col span=\"1\" style=\"width: 50%;\"></colgroup><tr><thead><th valign=\"top\"><span id=\"divImages\">IMAGES (<a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Add</a>)</span></th><th><span id=\"divVideos\">VIDEOS (<a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Add</a>)</span></th></thead></tr><tbody><tr><td style=\"vertical-align:top;\"><span id=\"divImagesList\">";

$countImg = 0;
$countVisible = 0;

foreach ($images->body as $image)
{
	$countImg ++;
	if (
		($queryText == "") ||
		(($queryIn == "Topic" && strpos(strtolower($image->topic), strtolower($queryText)) !== false) ||
		($queryIn == "Description" && strpos(strtolower($image->description), strtolower($queryText)) !== false) ||
		($queryIn == "Title" && strpos(strtolower($image->title), strtolower($queryText)) !== false))
	)
	{
		$countVisible ++;
		if ($image->parentImageId != "")
		{
			$parentImage = $images = $juxtclient->getImageById($image->parentImageId);
		}
		else
		{
			$parentImage = "";
		}
		$body .=  "<table><tr>";
		$body .=  "<td><img height=\"250\" src=\"$image->url\" alt=\"$image->title\"/><br/></td>";
		$body .=  "<td style=\"valign:top;\"><table>";
		$body .=  "<tr><td>#$countImg</td></tr>";
		$body .=  "<tr><td>Description: $image->description</td></tr>";
		$body .=  "<tr><td>Topic: $image->topic</td></tr>";
		$body .=  "<tr><td>Title: $image->title</td></tr>";
		$body .=  "<tr><td>Created: $image->creationDate</td></tr>";
		if ($parentImage != "")
		{
			$body .=  "<tr><td>Parent (". $parentImage->body->title . " / " . $parentImage->body->topic . " / " . $parentImage->body->description . ")</td></tr>";
			$body .=  "<tr><td><img height=\"50\" src=\"" . $parentImage->body->url . "\" alt=\"" . $parentImage->body->title . "\" /></td></tr>";
		} 
		$pixlrString = "{image:'$image->url', title:'$image->title', method:'GET', service:'editor', target:'http://www.paulius.nl/4ME102FA/JuxtaLearn/lib/pixlr/Save.php', exit:'http://www.paulius.nl/4ME102FA/JuxtaLearn/lib/pixlr/Save.php', redirect:'true', locktarget:'true'}";
		//image: _elmImage.src,
			//title: "pixlr editor",
			//method: "GET",
			//target: URL_SAVE_IMAGE,
			//exit: URL_SAVE_IMAGE,
			//redirect: "true",
			//locktarget: "true",
		$body .=  "<tr><td><a href=\"javascript:pixlr.overlay.show($pixlrString);\" onClick=\"\">";
		$body .= "Edit</a>";
		$body .= "<a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Delete</a></td></tr>";
		$body .=  "</table></td>";
		$body .=  "</tr></table>";
	}
}
if ($countVisible == 0)
{
	$body .= "Sorry, there are no images to show...";
}

$body .= "</span></td><td style=\"vertical-align:top;\"><span id=\"divVideosList2\">";
$videos = $juxtclient->getVideos();
$countVid = 0;
foreach ($videos->body as $video)
{
	$countVid++;
	$ytarray = explode("/", $video->youtubeUrl);
	$ytendstring = end($ytarray);
	$ytendarray = explode("?v=", $ytendstring);
	$ytendstring = end($ytendarray);
	$ytendarray = explode("&", $ytendstring);
	$ytcode = $ytendarray[0];

	$body .=  "<table><tr>";
	$body .=  "<td><iframe width=\"420\" height=\"315\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe></td>";
	$body .=  "<td><table>";
	$body .=  "<tr><td>#$countVid</td></tr>";
	$body .=  "<tr><td>Description: $video->description</td></tr>";
	$body .=  "<tr><td>Topic: $video->topic</td></tr>";
	$body .=  "<tr><td>Subject: $video->subject</td></tr>";
	$body .=  "<tr><td>Title: $video->title</td></tr>";
	$body .=  "<tr><td>Created: $video->creationDate</td></tr>";
	$body .=  "<tr><td><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Edit</a><a href=\"#\" onClick=\"alert('This is not implemented yet!')\">Delete</a></td></tr>";
	$body .=  "</table></td>";
	$body .=  "</tr></table>";
}
if ($countVid == 0)
{
	$body .= "Sorry, there are no videos to show...";
}

$body .= ("</span></td></tr></tbody></table>");

//print_r($juxtclient->getImages());
//print_r($juxtclient->getVideos());
//echo "</pre>";


$body .= "<div id=\"dialog-confirm\" title=\"Delete image?\"><p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>The image will be permanently deleted and cannot be recovered. Are you sure?</p></div>";
*/


//$body .= print_r($juxtclient->getImages(), true);

include("html.php");





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