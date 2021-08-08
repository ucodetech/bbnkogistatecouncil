<?php
session_start();
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'bbnState'

	),
	'remember' => array(
		'cookie_name' => 'statefpi',
		'cookie_expiry' => '604800'
	),
	'session' => array(
		'session_admin' => 'CommandERCaptianState',
		'session_officer' => 'OfficerState',
		'token_name' => 'token'
	)
);

//APP ROOT
define('APPROOT', dirname(dirname(__FILE__)));

//URL ROOT

define('URLROOT', 'http://localhost/bbnkogistatecouncil/');

//SITE NAME
define('SITENAME', 'BBN KOGI STATE COUNCIL');
define('APPVERSION', '1.1.0');
define('ADMIN', 'CONTROL ROOM');
define('NAVNAME', 'KOGI STATE COUNCIL');
define('DASHBOARD', 'Officers Panel');
define('MOTTO', 'SURE AND STEADFAST');


spl_autoload_register(function ($class) {
	require_once(APPROOT . '/classes/' . $class . '.php');
});


require_once(APPROOT . '/helpers/session_helper.php');
require_once(APPROOT . '/helpers/session.php');
