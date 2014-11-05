<?php
	$title = "minimal anders | Playground";
	$description = "minimal. anders. minimal anders. Based entirely on HTML5, CSS3, JavaScript and a bit of PHP on the backend side. Come and play!";
	$current_nav = "play";
	include_once('../include/header.php'); 
?>
			<div id="play_wrapper">
				
				<div id="sandbox" class="panel">
					<h2>Play</h2>
					<h3 class="h_access">Content</h3>
					<div class="three_columns">
						<?=PLAY_INTRO?>
						<p><a href="" id="check_opener" class="button centered margin20"><?=PLAY_START_ANALYSIS_BTN?></a></p>
                                                <p><a href="../social/" class="button centered margin20"><?=PLAY_START_SOCIAL_BTN?></a></p>
						<?=PLAY_SOCIAL?>
						
					</div>
				</div>
				
				<div id="analysis" class="panel">
					<h4>System Analyse</h4>
					<p>Die folgenden HTML5/CSS3-Features wurden mit true/false gekennzeichnet (<a href="http://www.modernizr.com/" class="link">Modernizr</a>). 
					Einige der Features können angeklickt und ausprobiert werden.</p>
					<ul class="list">
						<li>border-image: <span id="html5_borderimage"></span></li>
						<li>border-radius: <span id="html5_borderradius"></span></li>
						<li>box-shadow: <span id="html5_boxshadow"></span></li>
						<li>text-shadow: <span id="html5_textshadow"></span></li>
						<li>Canvas: <span id="html5_canvas"></span></li>
						<li>CSS Animations: <span id="html5_cssanimations"></span></li>
						<li>CSS Transitions: <span id="html5_csstransitions"></span></li>
						<li>@font-face: <span id="html5_fontface"></span></li>
						<li>Geolocation API: <a class="context_opener" href="" title="html5_geolocation"><span id="html5_geolocation"></span></a></li>
						<li>HTML5 Audio: <a class="context_opener" href="" title="html5_audio"><span id="html5_audio"></span></a></li>
						<li>HTML5 Video: <a class="context_opener" href="" title="html5_video"><span id="html5_video"></span></a></li>
						<li>localStorage: <a class="context_opener" href="" title="html5_localstorage"><span id="html5_localstorage"></span></a></li>
						<li>sessionStorage: <span id="html5_sessionstorage"></span></li>
						<li>opacity: <span id="html5_opacity"></span></li>
						<li>rgba(): <span id="html5_rgba"></span></li>
						<li>hsla(): <span id="html5_hsla"></span></li>
						<li>Web Workers: <a class="context_opener" href="" title="html5_webworkers"><span id="html5_webworkers"></span></a></li>
						<li>Drag and Drop: <span id="html5_draganddrop"></span></li>
						<li>SVG: <span id="html5_svg"></span></li>
					</ul>
				</div>
				
				<!-- Start output section -->
				<div id="output" class="panel analysis_output">
					<h4>System Status</h4>
					<ul class="list">
						<li>Browser: <span id="user_browser"></span></li>
						<li>Betriebssystem: <span id="user_os"></span></li>
						<li>Sprache: <span id="user_lang"></span></li>
						<li>HTML5 enable: <span id="html5_enable"></span></li>
					</ul>
					<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
				</div>
				
				<div id="geolocation" class="panel analysis_output">
					<h4>Geolocation</h4>
					<p>Die folgende Demo nutzt das W3C Geolocation API, um deine momentane Position zu ermitteln. 
					Mit Hilfe der Google Maps API werden deine Position sowie eine Route an mein liebstes Reiseziel in ein Canvas-Element gezeichnet.</p>
	   				<div id="geolocation_content" class="shiny_bg"></div>
	   				<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
				</div>
							
				<div id="audio" class="panel analysis_output">
					<h4>Audio</h4>
					<p>Die Format-Schlacht ist voll entbrannt...<br /> Hier eine Übersicht der populärsten Codec-Container-Kombinationen und der dazu kompatiblen Browser:</p>
					<table class="context_table">
						<tr><th>Codec</th><th>Browser</th></tr>
						<tr><td>ogg Vorbis</td><td>Firefox, Chrome, Opera</td></tr>
			    		<tr><td>mp3</td><td>Safari, Chrome, IE9</td></tr>
			    		<tr><td>m4a/AAC</td><td>Safari, iOS, Opera</td></tr>
			   			<tr><td>wav</td><td>Firefox, Safari, Opera, IE9</td></tr>
					</table>
					<p>Eine kleine Verdeutlichung:</p>
      				<audio id="audio_content" class="shiny_bg" controls preload="none"> 
					  <source src="../data/audio/theme.mp3" />
					  <source src="../data/audio/theme.ogg" />
					  <source src="../data/audio/theme.m4a" />
					  <source src="../data/audio/theme.wav" />
					  <p>Leider kennt dein Browser das HTML5 Tag &lt;audio&gt; nicht.</p>	
					</audio>
					<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
				</div>
							
				<div id="video" class="panel analysis_output">
					<h4>Video</h4>
					<p>Wie für HTML-Audio auch, gibt es für Video viele konkurierende Codecs im Webbereich. 
					Hier eine Liste polulärer Kombinationen. Wer mehr zu dem Thema erfahren möchte, dem sei 
					<a href="http://diveintohtml5.org/video.html" class="link">dieser Artikel</a> ans Herz gelegt</p>
					<table class="context_table">
						<tr><th>Typ</th><th>Codec</th><th>Browser</th></tr>
			    		<tr><td>Ogg</td><td>Theora</td><td>Firefox, Chrome, Opera</td></tr>
						<tr><td>mp4</td><td>H.264</td><td>Safari, iOS, Android, IE9+</td></tr>
			   			<tr><td>WebM</td><td>VP8</td><td>Chrome, Opera, Firefox, IE9+</td></tr>
					</table>
					<p>Eine kleine Veranschaulichung:</p>
					<video id="video_content" class="shiny_bg" width="400" controls preload="none" poster="../data/img/poster.png">
					    <source src="../data/video/firefox.ogg" type="video/ogg" /> <!-- Ogg Theora: Firefox, Chrome, Opera -->
					    <source src="../data/video/backflip.mp4" type="video/mp4" /> <!-- H.264: Safari, iOS, Android, IE9+ -->
					    <source src="../data/video/backflip.webm" type="video/webm" /> <!-- WebM VP8: Chrome, Opera, Firefox, IE9+ -->
						<p>Leider kennt dein Browser das HTML5 Tag &lt;video&gt; nicht.</p> 				
	      			</video>
					<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
      			</div>
      			
      			<div id="localstorage" class="panel analysis_output">
					<h4>Local Storage</h4>
					<p>Diese kleine Demo zeigt, wie die Positionen der Panels auf dieser Seite 
					im localStorage gespeichert, und später wieder hergestellt werden können.
					</p>
					<ul class="localstorage_list">
						<li><a href="" id="savePositions">Save to local storage</a></li>
						<li><a href="" id="clearLocalStorage">Clear local storage</a></li>
					</ul>
					<ul class="localstorage_list">
						<li><a href="" id="setPositions">Set to saved positions</a></li>
						<li><a href="" id="defaultPositions">Reset to default</a></li>
					</ul>
					<br class="clear" />
					<div id="localstorage_content" class="shiny_bg">
						<div id="rect_1" class="localstorage_rect draggable saveable"></div>
						<div id="rect_2" class="localstorage_rect draggable saveable"></div>
						<div id="rect_3" class="localstorage_rect draggable saveable"></div>
						<div id="rect_4" class="localstorage_rect draggable saveable"></div>
						<div id="rect_5" class="localstorage_rect draggable saveable"></div>
						<div id="rect_6" class="localstorage_rect draggable saveable"></div>
						<div id="rect_7" class="localstorage_rect draggable saveable"></div>
						<div id="rect_8" class="localstorage_rect draggable saveable"></div>
						<div id="rect_9" class="localstorage_rect draggable saveable"></div>
					</div>
					<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
				</div>
				
				<div id="webworkers" class="panel analysis_output">
					<h4>WebWorkers</h4>
					<p>WebWorker erlauben das Auslagern rechenintensiver Aufgaben. Dabei werden "echte" Threads auf Betriebssystem-Ebene erzeugt, 
						die im Hintergrund arbeiten und mittels onmessage-event Nachrichten/Daten aynchron an den Client zurück pushen können.</p>
					<p>In diesem Beispiel fetche ich lediglich einen Twitter-Stream, was kaum Zeit beansprucht, trotzdem wollte ich die Wirkungsweise der WebWorker damit illustrieren.
						Der Worker setzt einen Ajax-Call an ein Proxy-Script ab (PHP), das die Daten fetcht und an den Worker zurückgibt. Eine Lösung mit JSONP wäre selbstverständlich noch schöner :-)</p>
					<div id="webworkers_content" class="shiny_bg">
						<input type="text" id="webworkers_input" />
						<a href="" id="webworkers_submit" class="button">Go WebWorkers</a>
					</div>
					<div class="writable_panel">
						<span class="h3_fake"></span>
						<p></p>
					</div>
				</div> <!-- End output section -->
				
				<div class="overlay"></div>
				
			</div>

			<script src="../js/sandbox.js"></script>			
			<script src="../js/modernizr.min.js"></script>
			<script src="../js/worker.js"></script>
			<!--script src="../js/collision.js"></script-->
			<script>
				sandbox.initSystemAnalysis();
				sandbox.initContextOpeners();	
 			</script>
			
<?php include_once('../include/footer.php'); ?>