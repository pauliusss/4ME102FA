<?php
session_start();

	// this is the form where the user can edit the annotation of the image
	$body .= "<div id=\"dialog-form\" title=\"Image annotation\">
  <p class=\"validateTips\">All form fields are required.</p>
 
  <form>
    <fieldset>
      <label for=\"imgTitle\">Title</label>
      <input type=\"text\" name=\"imgTitle\" id=\"imgTitle\" value=\"\" class=\"text ui-widget-content ui-corner-all\"><br/>
      <label for=\"imgTopic\">Topic</label>
      <input type=\"text\" name=\"imgTopic\" id=\"imgTopic\" value=\"\" class=\"text ui-widget-content ui-corner-all\"><br/>
	  <label for=\"imgSubject\">Subject</label>
      <input type=\"text\" name=\"imgSubject\" id=\"imgSubject\" value=\"\" class=\"text ui-widget-content ui-corner-all\"><br/>
      <label for=\"imgDescription\">Description</label>
      <input type=\"text\" name=\"imgDescription\" id=\"imgDescription\" value=\"\" class=\"text ui-widget-content ui-corner-all\"><br/>";

		$body .= "<label for=\"imgUrl\">Image URL</label>
      <input type=\"text\" name=\"imgUrl\" id=\"imgUrl\" value=\"\" class=\"text ui-widget-content ui-corner-all\" disabled>";
	  
	  $body .= "<input type=\"hidden\" name=\"imgId\" id=\"imgId\" value=\"543bcdc964001f9d45000026\" class=\"text ui-widget-content ui-corner-all\">
	  <input type=\"hidden\" name=\"action\" id=\"action\" value=\"edit\" class=\"text ui-widget-content ui-corner-all\">
	  <input type=\"hidden\" name=\"role\" id=\"role\" value=\"Teacher\" class=\"text ui-widget-content ui-corner-all\">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type=\"submit\" tabindex=\"-1\" style=\"position:absolute; top:-1000px\">
    </fieldset>
  </form>
</div>";
 
 
/*<div id="users-contain" class="ui-widget">
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
</div>*/
//$body .= "<button id=\"annotate-image\">Annotate</button>";
?>