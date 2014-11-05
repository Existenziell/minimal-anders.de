<?php
	
	//error_reporting(E_ALL);
	//ini_set("display_errors", "on");
	
	session_start();
	
	require_once('../include/twitter/twitteroauth.php');
	require_once('../include/twitter/config.php');
	
	$metric = $_GET['metric'];
	
	// If access tokens are not available, show connect button
	if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
		$content = -1;
	}
	// Else, get the data
	else {
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$content = $connection->get($metric, array());
		
		if(sizeof($content) == 0) {
			$content = 0;
		}
				
		// Some example calls -> http://dev.twitter.com/doc/get/statuses/
		//$content = $connection->get('account/verify_credentials');
		//$content = $connection->get('statuses/public_timeline', array());
		//$content = $connection->get('statuses/user_timeline', array());
		//$content = $connection->get('users/show', array('screen_name' => 'Existenziell'));
		//$content = $connection->post('statuses/update', array('status' => date(DATE_RFC822)));
		//$content = $connection->post('statuses/destroy', array('id' => 5437877770));
		//$content = $connection->post('friendships/create', array('id' => 9436992)));
		//$content = $connection->post('friendships/destroy', array('id' => 9436992)));
	}
	echo json_encode($content);
?>