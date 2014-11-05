<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "off");
	
	require_once('config.php');
	require_once('facebook.php');

	$facebook = new Facebook(array(
		'appId'  => FB_APP_ID,
		'secret' => FB_APP_SECRET,
		'cookie' => true
	));

	// If we get a $user id here, it means we know the user is logged 
	// into Facebook, but we don’t know if the access token is valid.
	$user = $facebook->getUser();
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
				
		//header('Location: http://localhost/social/');
		header('Location: ' . FB_SOCIAL_ROOT);
	} else {
		$loginUrl = $facebook->getLoginUrl(array('scope' => 
					   'user_status,
						user_about_me,
						user_location,
						user_website,
						user_likes,
						user_events,
						user_groups,
						user_photos,
						user_videos,
						user_online_presence,
						user_birthday,
						status_update,
						read_insights,
						read_stream,
						publish_stream,
						offline_access'			
		));
		header('Location: ' . $loginUrl);
	}

	/*
	$loginUrl = $facebook->getLoginUrl(array(  
	    'scope' => 'user_status,user_about_me,user_hometown,user_location,user_interests,user_website,user_likes,user_events,user_groups,user_photos,user_videos,user_photo_video_tags,
					user_activities,user_checkins,user_education_history,user_online_presence,user_relationships,user_relationship_details,user_religion_politics,user_birthday,
					user_work_history,email,user_notes,status_update,read_friendlists,read_insights,read_mailbox,read_requests,read_stream,publish_stream,create_event,rsvp_event,offline_access'			
	));
	*/

?>