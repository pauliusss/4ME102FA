<?php
/**
 * Opauth basic configuration file to quickly get you started
 * ==========================================================
 * To use: rename to opauth.conf.php and tweak as you like
 * If you require advanced configuration options, refer to opauth.conf.php.advanced
 */

$config = array(
/**
 * Path where Opauth is accessed.
 *  - Begins and ends with /
 *  - eg. if Opauth is reached via http://example.org/auth/, path is '/auth/'
 *  - if Opauth is reached via http://auth.example.org/, path is '/'
 */
	'path' => '/4ME102FA/',

/**
 * Callback URL: redirected to after authentication, successful or otherwise
 */
	'callback_url' => 'http://www.paulius.nl/4ME102FA/callback.php',
	
/**
 * A random string used for signing of $auth response.
 * 
 * NOTE: PLEASE CHANGE THIS INTO SOME OTHER RANDOM STRING
 */
	'security_salt' => 'LDFmiilYf8Fyw5W10rghW1KsVrieQCnpBzzpTBWA5vJidQKDx8pMJbmw28R1C4m',
	
	'debug' => 'true',
		
/**
 * Strategy
 * Refer to individual strategy's documentation on configuration requirements.
 * 
 * eg.
 * 'Strategy' => array(
 * 
 *   'Facebook' => array(
 *      'app_id' => 'APP ID',
 *      'app_secret' => 'APP_SECRET'
 *    ),
 * 
 * )
 *
 */
	'Strategy' => array(
		// Define strategies and their respective configs here
		
		'Facebook' => array(
			'app_id' => '779089128813653',
			'app_secret' => '09ae2696566793181a44c904074d32bb'
		),
		
		'Google' => array(
			'client_id' => '302642334453-feoq81otef6v35kr3e4fes6jq8tlol1r.apps.googleusercontent.com',
			'client_secret' => '8c8JDGfO6ucuCbIzXChQD-51'
		),
		
		'Twitter' => array(
			'key' => 'PwmrGz1zLIpy53mMhrKDqgSp8',
			'secret' => 'Gl46xGkym9IcFufuXFjQmpaQjGZEKheBIHjg3vrImIqzPWsMyi'
		),
				
	),
);