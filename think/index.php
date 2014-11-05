<?php
	$title = "minimal anders | Think Different";
	$description = "minimal. anders. minimal anders. Anders denken ist legitim!";
	$current_nav = "think";
	include_once('../include/header.php'); 
?>
		<div id="think_wrapper">			
				
				<div id="think_welcome" class="static panel">
					<h2>Think</h2>
					<h3 class="h_access">Content</h3>	
					<p>Sharing is caring :-) This is why I want to contribute my part to the open source community by publishing code snippets, algorithms and solutions that I found, wrote, rewrote, liked... Please feel free to copy the code and comment it if you have suggestions.
					</p>
				</div>
						
				<div id="think_themes" class="static panel">
					<span class="h2_fake">Topics:</span>
					<ul>
						<li><a href="theme_1">Detect language</a></li>
						<li><a href="theme_2">Detect OS</a></li>
						<li><a href="theme_3">Detect browser</a></li>
						<li><a href="theme_4">ucwords</a></li>
						<li><a href="theme_5">console.log</a></li>
						<li><a href="theme_6">Web-Workers</a></li>
						<li><a href="theme_7">Social APIs</a></li>
						<li><a href="theme_8">RedisIO</a></li>
					</ul>
				</div>
				
				<div id="theme_1" class="static panel think_content">
					<h4>detectLanguage()</h4>
					<p>JavaScript function to detect browser language.</p>
<pre class="code">
<code>
function detectLanguage() {
	
	var lang = "";
	if (window.navigator.language !== undefined) {
		lang = window.navigator.language.split("-")[0];
	} else if (window.navigator.browserLanguage !== undefined){
		lang = window.navigator.browserLanguage.split("-")[0];
	}
	return lang;
}</code>
</pre>
				</div>
				
				<div id="theme_2" class="static panel think_content">
					<h4>detectOperatingSystem()</h4>
					<p>Detect the right operating system via JavaScript. Thanks to <a class="link" href="http://webdevwonders.com/">WebDevWonders</a> :-)</p>
<pre class="code">
<code>
function detectOperatingSystem() {

    if (navigator.userAgent.search(/Windows NT 6.1/) !== -1) {
        return "Windows 7";
    } else if (navigator.userAgent.search(/Windows NT 6.0/) !== -1) {
        return "Windows Vista";
    } else if (navigator.userAgent.search(/Windows NT 5.1/) !== -1) {
        return "Windows XP" + this.getServicePack();
    } else if (navigator.userAgent.search(/Windows NT 5.0/) !== -1) {
        return "Windows 2000";
    } else if (navigator.userAgent.search(/Win98/) !== -1) {
        return "Windows 98";
    } else if (navigator.userAgent.search(/Mac OS X 10.6/) !== -1) {
        return "Mac OS X Snow Leopard";
    } else if (navigator.userAgent.search(/Mac OS X 10.5/) !== -1) {
        return "Mac OS X Leopard";
    } else if (navigator.userAgent.search(/Mac OS X 10.4/) !== -1) {
        return "Mac OS X Tiger";
    } else if (navigator.userAgent.search(/Mac OS X 10.3/) !== -1) {
        return "Mac OS X Panther";
    } else if (navigator.userAgent.search(/Linux/) !== -1) {
        return "Linux";
    } else if (navigator.userAgent.search(/iPad|iPhone|iPod/) !== -1){
        return "iOS";
    } else if (navigator.userAgent.search(/android/) !== -1){
        return "Android";
    } else {
        return "";
    }
}</code>
</pre>
				</div>
				
				<div id="theme_3" class="static panel think_content">
					<h4>detectBrowser()</h4>
					<p>Detect the right browser with JavaScript.</p>
<pre class="code">
<code>
function detectBrowser(){

    var browser = "Unknown";
    var ua = navigator.userAgent;
    if (document.body.ontouchstart === undefined) {
        // Chrome
        if (window.execScript !== undefined && 
        		document.body.onmouseenter === undefined) {
            if (window.localStorage) {
                if (navigator.geolocation) {
                    browser = "Chrome &gt; 4";
                } else {
                    browser = "Chrome 4";
                }
            } else if (document.body.compareDocumentPosition()) {
                browser = "Chrome 3";
            } else {
                browser = "Chrome &lt; 3";
            }
            // Opera
        } else if (window.opera) {
            browser = "Opera";
            // Firefox
        } else if (window.globalStorage) {
            if (window.postMessage) {
                if (document.querySelector) {
                    if (document.body.isContentEditable !== undefined) {
                        browser = "Firefox 4";
                    } else if (document.body.classList) {
                        browser = "Firefox 3.6";
                    } else {
                        browser = "Firefox 3.5";
                    }
                } else {
                    browser = "Firefox 3.0";
                }
            } else {
                browser = "Firefox 2";
            }
            // Internet Explorer
        } else if (document.compatMode && document.all) {
            if (window.XMLHttpRequest) {
                if (document.characterSet) {
                    browser = "Internet Explorer 9";
                } else if (document.documentMode) {
                    browser = "Internet Explorer 8";
                } else {
                    browser = "Internet Explorer 7";
                }
            } else {
                browser = "Internet Explorer 6";
            }
            // Safari
        } else if (document.body.onmousewheel !== undefined) {
            if (window.sessionStorage) {
                if (navigator.geolocation) {
                    browser = "Safari 5";
                } else {
                    browser = "Safari 4";
                }
            } else {
                browser = "Safari &lt; 4";
            }
        }     
    }
    // iPod, iPhone, iPad
    else if(/iphone/i.test(ua) || /ipad/i.test(ua) || /ipod/i.test(ua)) {
        browser = "Mobile Safari";
    }
    // Android
    else if(/android/i.test(ua)) {
        browser = "Android Browser";
    }
    return browser;
}</code>
</pre>
				</div>
					
				<div id="theme_4" class="static panel think_content">
					<h4>ucwords()</h4>
					<p>Uppercase every first letter of a string - PHP's ucwords for JavaScript.</p>
<pre class="code">
<code>
function ucwords(str) {

    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}</code>
</pre>
				</div>
					
				<div id="theme_5" class="static panel think_content">
					<h4>log()</h4>
					<p>With this function included you can use log() instead of console.log(), which is hopefully a little gain of time.</p>
<pre class="code">
<code>
function log(message){
	console.log ? console.log(message) : alert(message);
}</code>
</pre>
				</div>
					
				<div id="theme_6" class="static panel think_content">
					<h4>HTML5 web workers</h4>
					
					<p>Web workers can lift heavy background (data) processing, while the client is asynchronously fine :-)<br />
					As you can try out here -&gt; <a href="http://www.minimal-anders.de/play/">Web workers on a Twitter example</a><br />
					The function connecting the client and the web-worker:</p>
<pre class="code">
<code>
function initWebworkers() {
	
	var query = "Obama";
	var worker = new Worker("../js/worker.js");
	worker.postMessage(query);
	
	// Triggered by postMessage in the Web Worker
	worker.onmessage = function (evt) {
		// in evt.data is the data from the Web Worker
		var json = jQuery.parseJSON(evt.data);
		if($(json.results).length &gt; 1){
			// do something with the data
		}
	};
	// If the Web Worker throws an error
	worker.onerror = function (evt) {
		console.log(evt.data);
	};
	return false;
}</code>
</pre>					
					<p>The web-worker itself, fetching the data from a PHP-Script.<br />
					As you can see, we've got no fancy JQuery or other stuff here, but only pure good old fashioned JavaScript :-)</p>
<pre class="code">
<code>
// Triggered by postMessage from client
onmessage = function (evt) {
	
	var url = "../include/proxy.php?q=" + evt.data;

	ajax = new XMLHttpRequest();
	ajax.open ('GET', url, true);
	ajax.send(null);
	
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			// when ready, push data back to client
			postMessage(ajax.responseText);
		}
		
	}
};</code>
</pre>
					<p>The PHP-Proxy fetching the data through cURL and returning it to the web-worker:</p>
<pre class="code">
<code>
&lt;?php

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
	
?&gt;</code>
</pre>
				</div>
				
				<div id="theme_7" class="static panel think_content">
					<h4>Fetching social data from Twitter or Facebook</h4>
					<p>Triggered by this JavaScript function, retrieving data trough xhr-calls.</p>
<pre class="code">
<code>
function socialDataCollector(selector) {
	
	// The metric parameter defines which type of feed will be fetched.
	// It could be passed in from a click on a list element etc...
	var metric = "statuses/user_timeline";
	var url = "include/xhrGetSocialData.php?metric=" + metric;
	
	$.ajax({
		url: url,
		success: function(data){						
			var feed = $.parseJSON(data);
			displaySocialData ...
		}
	});
	return false;
}</code>
</pre>

					<p>The PHP-script fetching the social feed. (Twitter)</p>
<pre class="code">
<code>
&lt;?php

	session_start();
	
	// Include the Twitter OAuth library
	require_once('include/twitteroauth.php');
	
	// The metric parameter defines which feed will be fetched
	$metric = $_GET['metric'];
	
	// If access tokens are not available, show connect button
	if (empty($_SESSION['access_token']) || 
			empty($_SESSION['access_token']['oauth_token']) || 
			empty($_SESSION['access_token']['oauth_token_secret'])) {
		$content = -1;
	}
	// Else, get the data
	else {
		$access_token = $_SESSION['access_token'];
		$connection = new TwitterOAuth(
			CONSUMER_KEY, 
			CONSUMER_SECRET, 
			$access_token['oauth_token'], 
			$access_token['oauth_token_secret']);
		$data = $connection->get($metric, array());
		
		if(sizeof($data) == 0) {
			$data = 0;
		}
		
		// Echo out the JSON, so the xhr-call from the client can return the data
		echo json_encode($data);
	
		// Some example calls -> http://dev.twitter.com/doc/get/statuses/
		//$content = $connection->get('account/verify_credentials');
		//$content = $connection->get('statuses/public_timeline', array());
		//$content = $connection->get('statuses/user_timeline', array());
		//$content = $connection->get('users/show', array('screen_name' => 'xyz'));
		//$content = $connection->post('statuses/update', array('status' => date));
		//$content = $connection->post('friendships/create', array('id' => 12345)));
	}
?&gt;</code>
</pre>

			<p>The PHP-script fetching the social feed. (Facebook)</p>
<pre class="code">
<code>
&lt;?php
	
	// Include the Facebook API library
	require_once('include/facebook.php');
	
	// Again, the metric parameter defines which feed will be fetched
	$metric = $_GET['metric'];
	
	// Create our Application instance.
	$facebook = new Facebook(array( 'appId'  => APP_ID, 'secret' => APP_SECRET ));

	// If we get a $user id here, we know that the user is logged into Facebook.
	$user = $facebook->getUser();
	if ($user) {
		$url = '/me/' . $metric;
		$data = $facebook->api($url);
	} else {
		$data = 0;
	}
	
	// Echo out the JSON, so the xhr-call from the client can return the data
	echo json_encode($data);
	
	
	/* Some example calls...
	Friends: https://graph.facebook.com/me/friends?access_token=...
	News feed: https://graph.facebook.com/me/home?access_token=...
	Profile feed (Wall): https://graph.facebook.com/me/feed?access_token=...
	Likes: https://graph.facebook.com/me/likes?access_token=...
	Movies: https://graph.facebook.com/me/movies?access_token=...
	Music: https://graph.facebook.com/me/music?access_token=...
	Books: https://graph.facebook.com/me/books?access_token=...
	Notes: https://graph.facebook.com/me/notes?access_token=...
	Permissions: https://graph.facebook.com/me/permissions?access_token=...
	Photo Tags: https://graph.facebook.com/me/photos?access_token=...
	Photo Albums: https://graph.facebook.com/me/albums?access_token=...
	Video Tags: https://graph.facebook.com/me/videos?access_token=...
	Video Uploads: https://graph.facebook.com/me/videos/uploaded?access_token=...
	Events: https://graph.facebook.com/me/events?access_token=...
	Groups: https://graph.facebook.com/me/groups?access_token=...
	Checkins: https://graph.facebook.com/me/checkins?access_token=...
	*/
	
?&gt;</code>
</pre>
				</div>
				
				<div id="theme_8" class="static panel think_content">
					<h4>RedisIO</h4>
					<p><a href="http://redis.io/" class="link">Redis</a> stores key:value pairs directly in your RAM, the memory of the used server.<br />
					This makes it consiberably fast and <a href="http://redis.io/commands" class="link">easy to use</a> and setup :-)<br />
					The RedisConnect class provides some simple getter and setter to store and fetch all kinds of data:</p>
<pre class="code">
<code>
&lt;?php

	// include the RedisIO class, which provides the actual storage functions.
	require_once('redis/RedisIO.php');
	
	class RedisConnect {
		
		// fetch data by passing in an unique key
		public function getData($key) {
			
			if ($redisIO = new RedisIO()) {
				$data = $redisIO->getEntry($key);
				$data = json_encode($redisIO->getEntry($key));
				
				return $data;
			} else {
				return false;
			}
		}
		
		// store data by identifying it with an unique key
		public function setData($key, $data) {
			
			if ($redisIO = new RedisIO() {	    
				$redisIO->setEntry($key, $data)
				return true;
			} else {
				return false;
			}
		}
	}
?&gt;</code>
</pre>

					<p>Configure the redis connection and include the <a href="https://github.com/nrk/predis/" class="link">PRedis library</a>:</p>
<pre class="code">
<code>
&lt;?php

	// Predis is a flexible PHP client library for the Redis key-value store.
	require_once('PRedis.php');
	
	$configurations = array(
	    'host'     => '127.0.0.1',
	    'port'     => 6379,
	    'database' => 'dbname'
	    //'requirepass' => 'dbpass'
	);

?&gt;</code>
</pre>

					<p>The RedisIOClass, which provides the actual interface to the storage functionality:</p>
<pre class="code">
<code>
&lt;?php

class RedisIO {

    private $_redis;

    public function __construct() {
    	
      // inlcude the config, we just created
      include('RedisConf.php');

      // create the actual Redis client :-)
      $this->_redis = Predis_Client::create($configurations);
    }
	
    // Getter & Setter
    public function getEntry($key) {
        return $this->_redis->get($key);
    }
    
    public function setEntry($key, $data) {
        $this->_redis->set($key, $data);
    }
    
    public function deleteEntry($key) {
        $this->_redis->delete($key);
    }

    // Lists
    public function addListItem($key, $data){
        $this->_redis->lpush($key, $data);
    }

    public function removeListItem($key, $data){
        $this->_redis->lrem($key, 0, $data);
    }

    public function getList($key) {
        return $this->_redis->lrange($key, 0, -1);
    }

    public function getListCount($key) {
        return $this->_redis->llen($key);
    }
   	
    // Expires & Keys   
    public function setExpireTime($key, $timeout) {
        $this->_redis->expire($key, $timeout);
    }
	
    public function getKeys($pattern) {
        return $this->_redis->keys($pattern);
    }

    public function checkIfKeyExists($key) {
    	return $this->_redis->exists($key);
    }

    public function flushDatabase() {
        $this->_redis->flushDatabase();
    }   
}

?></code>
</pre>
				</div>

			</div><!-- End of think-wrapper -->
			
<?php include_once('../include/footer.php'); ?>