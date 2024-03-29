<?php

/**
 * User has successfully authenticated with Twitter. 
 * Access tokens saved to session and DB.
 */

error_reporting(E_ALL);
ini_set("display_errors", "on");

session_start();

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}

/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
//$content = $connection->get('account/verify_credentials');

$content = $connection->get('statuses/user_timeline', array());


/* Some example calls */
//$content = $connection->get('users/show', array('screen_name' => 'Existenziell'));
//$content = $connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$content = $connection->post('statuses/destroy', array('id' => 5437877770));
//$content = $connection->post('friendships/create', array('id' => 9436992)));
//$content = $connection->post('friendships/destroy', array('id' => 9436992)));

/* Include HTML to display on the page */
include('html.inc');