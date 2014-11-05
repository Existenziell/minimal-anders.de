<?php
	$title = "minimal anders | Social Connects";
	$description = "minimal. anders. minimal anders. The Web is social, so am I :-)";
	$current_nav = "social";
	
	session_start();
	include_once('../include/header.php');
	
	//error_reporting(E_ALL);
	//ini_set("display_errors", "on");
	//include_once('../include/Token.php');
	//$token = new Token();
	//$token->setToken("facebook", "23hsklc93133v3133f313123m");
	//$token->getToken("facebook");
	
?>
		<div id="social_wrapper">
				
			<section id="social_welcome" class="static panel">
				<h1>Socialize...</h1>
				<p>A little demo howto connect to Twitter and Facebook API via JavaScript, 
				granting access using OAuth and fetching the data through xhr-calls from a PHP-Proxy 
				(Thanks to Facebook for their great <a href="http://developers.facebook.com/docs/sdks/" class="link">SDKs</a> and Abraham Williams for his <a href="https://github.com/abraham/twitteroauth/tree/master/twitteroauth" class="link">twitterOAuth-Plugin</a>). You can find the code <a href="../think#social_api">here</a></p>
			</section>	
			
			<section id="social_twitter" class="static panel">
				<h1>Twitter</h1>
				<ul id="twitter_nav">
					<li><a class="twitter" href="" title="statuses/home_timeline">Home timeline</a></li>
					<li><a class="twitter" href="" title="statuses/user_timeline">User timeline</a></li>
					<li><a class="twitter" href="" title="statuses/followers">Followers</a></li>
					<li><a class="twitter" href="" title="statuses/friends">Friends</a></li>
					<li><a class="twitter" href="" title="statuses/retweets_of_me">Retweets of me</a></li>
					<li>etc...</li>
				</ul>
				<a id="twitter_connect" href="../include/twitter/redirect.php"><img src="../data/img/connect_twitter.png" alt="Connect to Twitter" /></a>
			</section>
					
			<section id="social_facebook" class="static panel">
				<h1>Facebook</h1>
				<ul id="facebook_nav">
					<li><a class="facebook" href="" title="friends">Friends</a></li>
					<li><a class="facebook" href="" title="feed">Profile feed (Wall)</a></li>
					<li><a class="facebook" href="" title="likes">Likes</a></li>
					<li><a class="facebook" href="" title="events">Events</a></li>
					<li><a class="facebook" href="" title="groups">Groups</a></li>
					<li>etc...</li>
					<!--
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
					-->
				</ul>
				<a id="facebook_connect" href="../include/facebook/redirect.php"><img src="../data/img/connect_facebook.png" alt="Connect to Facebook" /></a>
			</section>
			
			<section id="social_output" class="static panel">
				<h1>Output</h1>
				<p id="output_header"></p>
				<ul class="shiny_bg"></ul>
				<img class="ajax_loader" src="../data/img/ajax-loader.gif" alt="ajax-loader" />
			</section>
			
		</div>
			
		<script src="../js/social.js"></script>
		<script>
			social.initSocialConnects();
		</script>
		
		
<?php include_once('../include/footer.php'); ?>