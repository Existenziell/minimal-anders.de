<?php

	// Get XML-Feed over http with cURL
	function getFeed($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 180);
		$feed = curl_exec($ch);
		curl_close($ch);
		return $feed;	
	}
	
	$url = "http://search.twitter.com/search.json?q=" . $_GET['q'];
	$feed = getFeed($url);

	echo $feed;
	
?>