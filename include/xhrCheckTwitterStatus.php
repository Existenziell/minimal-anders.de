<?php
	error_reporting(E_ALL);
	ini_set("display_errors", "on");
	
	session_start();
	
	// If no authentication info is stored in session -> show connect button
	if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
		$status = -1;
	}
	else {
		$status = 1;
	}
	echo $status;
?>