<?php
/**
 * Opauth example
 * 
 * This is an example on how to instantiate Opauth
 * For this example, Opauth config is loaded from a separate file: opauth.conf.php
 *  
 */

/**
 * Define paths
 */
define('CONF_FILE', dirname(__FILE__).'/'.'opauth.conf.php');
define('OPAUTH_LIB_DIR', dirname(__FILE__).'/lib/Opauth/');

/**
* Load config
*/
if (!file_exists(CONF_FILE)){
	trigger_error('Config file missing at '.CONF_FILE, E_USER_ERROR);
	exit();
}
require CONF_FILE;

/**
 * Instantiate Opauth with the loaded config
 */
require OPAUTH_LIB_DIR.'Opauth.php';
$Opauth = new Opauth( $config );


	$body = "<p>Please log in:</p>
	<ul>
		<li><a href=\"./facebook\">Student login (Facebook)</a></li>
		<li><a href=\"./google\">Teacher login (Google)</a></li>
		<li><a href=\"./twitter\">Administrator login (Twitter)</a></li>
	</ul>";
	
	include("./JuxtaLearn/html.php");
	
?>
