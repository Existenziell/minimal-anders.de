<?php

	function getAppPath() {
		$ap = 'http';
		if(array_key_exists("HTTPS", $_SERVER)) {
			if ($_SERVER["HTTPS"] == "on") {
				$ap .= "s";
			}
		}
		$ap .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$ap .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$ap .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $ap;
	}

	function getParentPath() {
		$pp = 'http';
		if(array_key_exists("HTTPS", $_SERVER)) {
			if ($_SERVER["HTTPS"] == "on") {
				$pp .= "s";
			}
		}
		$pp .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pp .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pp .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return dirname($pp);
	}
	
	//define('APP_PATH', 'http://www.minimal-anders.de/');
	//define('APP_PATH', '/');

	//define('APP_PATH', dirname(__FILE__).'/');
	//define("APP_PATH", getAppPath());
	//define("PARENT_PATH", getParentPath())

?>