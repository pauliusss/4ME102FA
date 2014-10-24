<?php
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>LNU 4ME102 Final Assignment</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script type="text/javascript" src="http://paulius.nl/4ME102FA/JuxtaLearn/lib/js/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="http://paulius.nl/4ME102FA/JuxtaLearn/lib/js/functions.js"></script>
		<script type="text/javascript" src="http://paulius.nl/4ME102FA/JuxtaLearn/lib/js/analytics.js"></script>
		<script type="text/javascript" src="http://apps.pixlr.com/lib/pixlr.js"></script>
		<script type="text/javascript" src="http://paulius.nl/4ME102FA/JuxtaLearn/lib/js/pixlr-impl.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	</head>
	<body>
		<div style="margin-left:50px">
			<?php 
			include("bodyheader.php");
			echo $bodyheader;
			echo $body;
			?>
		</div>
		
		<div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>
 
 
<div id="users-contain" class="ui-widget">
  <h1>Existing Users:</h1>
  <table id="users" class="ui-widget ui-widget-content">
    <thead>
      <tr class="ui-widget-header ">
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>john.doe@example.com</td>
        <td>johndoe1</td>
      </tr>
    </tbody>
  </table>
</div>
<button id="create-user">Create new user</button>
	</body>
</html>