<?php
	// Language...
	include_once('lang/check.php');
	$lang = getLanguage('single');
	$language_code = getLanguage('double');
	$language_name = getLanguage('full');	
	include_once('lang/'.$lang.'.php');	
?>
<!DOCTYPE html>

<html lang="<?=$lang;?>">
	
	<head>
		<meta charset=utf-8 />
		<title><?php echo $title ?></title>
		<meta name="description" content="<?php echo $description ?>" />
		<meta name="author" content="Christof Bauer" />
		<meta name="robots" content="index, follow, noodp" />
		<meta name="google-site-verification" content="3osUPVocJoCa_wxUhvw7GB5BWc_ZVowH01ZEVrEPneA" />
		<link rel="icon" href="../data/img/favicon.ico" type="image/gif" sizes="32x32" />
		<link rel="author" href="../humans.txt" />
		<script src="../js/jquery.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/minimal.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="../css/minimal.css" type="text/css" />
	</head>

	<body>	
		<!-- Start of content wrapper -->
		<div id="wrapper">
		
			<header id="header">
				<div id="header_banner">
					<a href="http://www.minimal-anders.de/">
						<h1>minimal anders</h1>
					</a>
				</div>
				<h2 class="h_access">Navigation</h2>
				<ul id="navigation">
					<li><a id="think_opener" <?php if($current_nav == "think") echo 'class="current_nav"';?> href="/think/"><h3 class="h_nav">Think</h3></a></li>
					<li><a id="play_opener" <?php if($current_nav == "play") echo 'class="current_nav"';?> href="/play/"><h3 class="h_nav">Play</h3></a></li>
					<li><a id="move_opener" <?php if($current_nav == "move") echo 'class="current_nav"';?> href="/move/"><h3 class="h_nav">Move</h3></a></li>
		   		</ul>
				<span id="header_info"></span>
			</header>