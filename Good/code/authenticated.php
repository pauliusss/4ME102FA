<?php
$role = "na";
if (!empty($response['auth']['provider']))
{
	switch($response['auth']['provider'])
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
		
	if (!empty($response['auth']['info']['name']))
	{
		$src = $response['auth']['info']['image'];
		?>
		<table><tr><td>
		<?php
		
		echo ("<img width=\"50\" height=\"50\" src=\"$src\" alt=\"user image\"/>");
		?>
		</td><td>
		<?php
		
		echo ("Hello, " . $response['auth']['info']['name'] . "!<br/>");
		echo ("You are acting as: $role. ");
		echo ("<a href=\".\">Logout</a>");
		?>
		</td></tr></table>
		<?php
	}

}
?>