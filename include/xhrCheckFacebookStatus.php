<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "on");

	require 'facebook/facebook.php';

	// Create our Application instance.
	$facebook = new Facebook(array(
		'appId'  => '239066989437628',
		'secret' => '1e42bcc9eefab1699cc25c201c246bd6'
	));

	// If we get a $user id here, it means we know the user is logged 
	// into Facebook, but we don’t know if the access token is valid.
	$user = $facebook->getUser();
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
		$status = 1;
	} else {
		$status = -1;
	}
	
	echo $status;
?>