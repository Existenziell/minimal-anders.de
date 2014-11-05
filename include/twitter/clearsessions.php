<?php

/**
 * Session handling for social connects.
 * Clears PHP sessions and redirects to the index page.
 */
 
/* Load and clear sessions */
session_start();
session_destroy();

require_once('config.php');
 
/* Redirect to page with the connect to Twitter option. */
//header('Location: http://localhost/social/');
header('Location: ' . SOCIAL_ROOT);
