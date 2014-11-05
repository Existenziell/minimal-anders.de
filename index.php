<?php 
	
	$title = "minimal. anders. minimal anders.";
	$description = "minimal. anders. minimal anders. Eine Spielwiese zur Erkundung technischer und philosophischer Ideen.";
	$current_nav = "minimal";
	
	include_once('include/header.php');
?>
	<div id="home_wrapper">
	    
	    <div id="minimal" class="panel">
		    <h1>minimal anders ?</h1>
		    <h3 class="h_access">Content</h3>
		    <p><?php echo MINIMAL_INTRO; ?></p>
		</div>
		
		<div class="portal_container centered">
	 		<a href="think/" id="think_portal" class="panel portal_panel"><h4>Think</h4></a>
	 		<a href="play/" id="play_portal" class="panel portal_panel"><h4>Play</h4></a>
	 		<a href="move/" id="move_portal" class="panel portal_panel"><h4>Move</h4></a>
		</div>
			
		<br class="clear" />
    </div>
    
<?php include_once('include/footer.php'); ?>