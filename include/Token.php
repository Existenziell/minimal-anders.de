<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "on");
	
	require_once('redis/RedisIO.php');
	
	
	class Token {
			
		public function getToken($key) {
			$redisIO = new RedisIO();
			$token = $redisIO->getEntry($key);
			//$token = json_encode($redisIO->getEntry($key));
			/*
			$time = str_replace($user_id . "_", "", $key);
			$time = date("d.m.Y H:i", $time);
			//$data = array();
			$data[] = array("time" => $time, "name" => $entry);
			var_dump($data);
			*/
			echo "<br>Return: Key -> ".$key." / Token -> ".$token;			
			return $token;
		}
		
		public function setToken($key, $token) {
			$redisIO = new RedisIO();	
	    	$redisIO->setEntry($key, $token);
	    
			echo "<br>Saved: Key -> ".$key." / Token -> ".$token;
			return true;
		}
		
	}

?>