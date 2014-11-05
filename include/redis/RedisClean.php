<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Redis Cleanup</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="NOINDEX,NOFOLLOW" />
    </head>

    <body>

<?php

    error_reporting(E_ALL);
    ini_set("display_errors", "on");

    require_once 'RedisIO.php';
    $redisIO = new RedisIO("master");

    $pattern = "*2011-01-22*";
    $keys = $redisIO->getKeys($pattern);

	echo "<pre>";
	var_dump($keys);
		
   // foreach($keys as $key => $value) {
        //$redisIO->deleteRedisEntry($value);
   // }

?>

    </body>
</html>