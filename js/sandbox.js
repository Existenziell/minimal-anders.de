/* sandbox.js / minimal-anders.de
 * 
 * @authors Christof Bauer
 *
 */
//<![CDATA[

if(typeof sandbox === "undefined"){
    if(typeof this.sandbox === "undefined"){
        this.sandbox = {};
    }
    sandbox.global = this;
}

sandbox = {
	
	slow: 500,
	delay: 250,
	fast: 100,
	mapLoaded: false,
	map: false,
	
	// Write on the status panel from everywhere
	setOutput: function(context, header, content){			
		$("#" + context).find("div.writable_panel span").html(header);
		$("#" + context).find("div.writable_panel p").html(content);
		minimal.setContentHeight();
	},
	
	// Append text to the status panel
	appendToOutput: function(context, content){
		$("#" + context).find("div.writable_panel").append(content);
		minimal.setContentHeight();
	},
	
	/*
	* Inits
	*/
	
	// Show different sandbox areas for testing features
	initContextOpeners:function(){
		$(".context_opener").live("click", function(){
			var currentlyShown = $("#play_wrapper").find(".analysis_output:visible").attr("id");
			var elementToShow = $(this).attr("title").replace("html5_", "");
			sandbox.stopMultimedia(currentlyShown);
			$(".analysis_output").hide();
			$("#" + elementToShow).show().animate({
				opacity: 1}, 
				400, function(){
				minimal.setContentHeight();
			});
			if(elementToShow === "geolocation") {
				sandbox.initGeo();
			} else if (elementToShow === "video") {
				sandbox.initVideo();
			} else if (elementToShow === "localstorage") {
				sandbox.initDrag();
				sandbox.initLocalStorage();
			} else if (elementToShow === "webworkers") {
				sandbox.initWebworkers();
			}
			return false;
		});
	},  
	
	// stop audio / video when panel is closed
	stopMultimedia: function(currentlyShown){
		switch(currentlyShown){
			case "video":
				var video = document.querySelector("video");
				video.pause();
				break;
			case "audio":
				var audio = document.querySelector("audio");
				audio.pause();
				break;
			default:
				break;	
		}	
	},
	
	// Keyboard bindings 
	initVideo: function() {
		$("body").bind('keydown', function(e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			if(code === 27) {
				document.getElementsByTagName('video')[0].pause();
				$("#video").fadeOut(sandbox.fast);
			}
		});
	},
	
	// connect the webWorker to the PHP-Proxy, retrieve data, callback to client
	initWebworkers: function() {
		
		// catch also the Enter key when inside input box
		$("#webworkers_input").keyup(function(event){
		  if(event.keyCode == 13){
		    $("#webworkers_submit").click();
		  }
		});
		
		$("#webworkers_submit").live("click", function(){
			var query = $("#webworkers_input").val();
			var worker = new Worker("../js/worker.js");
			worker.postMessage(query);
			// Triggered by postMessage in the Web Worker
			worker.onmessage = function (evt) {
				// evt.data is the values from the Web Worker
				var json = jQuery.parseJSON(evt.data);
				if($(json.results).length < 1){
					sandbox.appendToOutput("webworkers", "<p>Leider ist ein Fehler aufgetreten...</p>");
					return;
				}
				$(".writable_panel").empty();
				sandbox.appendToOutput("webworkers", "<p>Resultate für " + query +":</p>");
				$(json.results).each(function(){
					var html = "<p><a href='http://twitter.com/#!/" + this.from_user + "' class='link'><img src='" + this.profile_image_url + "' alt='twitter_profile_image'></a><span class='small webworkers_date'>" + this.created_at + "</span><br /><span>" + this.text + "</span><br /></p>";
					sandbox.appendToOutput("webworkers", html);
				});
			};
			// If the Web Worker throws an error
			worker.onerror = function (evt) {
				sandbox.appendToOutput("webworkers", "<p>Leider ist ein Fehler aufgetreten...</p>");
				//log(evt.data);
			};
			return false;
		});
	},
	
	// Fullscreen toggle elements
	initFullscreen: function(){
		$(".fullscreen_opener").live("click", function(){
			var elementToShow = $(this).attr("title");			
			$(".overlay").show();
			$("#" + elementToShow).find(".close").show();
			$("#" + elementToShow).fadeIn(sandbox.fast);
			return false;
		});
		$(".close").live("click", function() {
			var elementToClose = $(this).attr("title");
			$(".overlay").hide();
			$("#" + elementToClose).find(".close").hide();
			$("#" + elementToClose).fadeOut(sandbox.fast);
			return false;
		});
	},
	
	/*
	*  Geolocation Stuff
	*/
	
	initGeo: function() {
		sandbox.appendToOutput("geolocation", "Initialisiere Geolocation API & Google Maps API <br />");
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=sandbox.loadMap";
		document.body.appendChild(script);
	},
	
	loadMap: function() {
		
		var directionsService = new google.maps.DirectionsService();
		var directionsDisplay = new google.maps.DirectionsRenderer();
		var options = {
			zoom: 12,
            //center: origin,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            navigationControl: true,
            mapTypeControl: true,
            scaleControl: true
		};
		
		if(navigator.geolocation) {
			sandbox.appendToOutput("geolocation", "<br />Geolocation-API wird initialisiert...<br />");
			navigator.geolocation.getCurrentPosition(geoSuccess, geoError, {
				enableHighAccuracy: true,
				timeout: 20000,
				maximumAge: 60000
			});
		}
	
		if(!sandbox.mapLoaded) {
			sandbox.map = new google.maps.Map(document.querySelector("#geolocation_content"), options);
			directionsDisplay.setMap(sandbox.map);	
			sandbox.mapLoaded = true;
		}

		function geoSuccess(position) {
			sandbox.appendToOutput("geolocation", "Geocoder Response: OK!<br /><br />");
			
			var origin = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			var destination = new google.maps.LatLng(46.7225, -2.3507); // Ile d'Yeu
			origin = origin.toString();
			destination = destination.toString();

			var request = {
			    origin: origin, 
			    destination: destination,
			    travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			var geocoder = new google.maps.Geocoder();			
			geocoder.geocode({address: origin}, function(results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
					sandbox.appendToOutput("geolocation", "Deine ungefähre Position wurde ermittelt: <br />" + results[0].formatted_address + "<br />");	
				}
			});
			geocoder.geocode({address: destination}, function(results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
					sandbox.appendToOutput("geolocation", "<br />Deine Reise führt dich nach: <br />" 
						+ results[0].address_components[2].long_name + ", " 
						+ results[0].address_components[3].long_name + ", " 
						+ results[0].address_components[5].long_name + "<br /><br />"
					);	
				}
			});
			directionsService.route(request, function(response, status) {
				sandbox.appendToOutput("geolocation", "Die Route wird berechnet...<br />");				
				if (status === google.maps.DirectionsStatus.OK) {
					sandbox.appendToOutput("geolocation", "Zeichne Karte...<br /><br />Done!");
					directionsDisplay.setDirections(response);
				}
			});
			//sandbox.map.setCenter(userLocation); // prevent the origin from being shown before route is ready
		}
		
		function geoError(error) {
			sandbox.appendToOutput("geolocation", "<p>Deine Position konnte nicht ermittelt werden!</p>");
			switch (error.code) {
				case error.PERMISSION_DENIED:
					sandbox.appendToOutput("geolocation", "<p>getCurrentPosition Error: PERMISSION_DENIED");
					break;
				case error.POSITION_UNAVAILABLE:
					sandbox.appendToOutput("geolocation", "<p>getCurrentPosition Error: POSITION_UNAVAILABLE");
					break;
				case error.TIMEOUT:
					sandbox.appendToOutput("geolocation", "<p>getCurrentPosition Error: TIMEOUT");
					break;
				default:
					break;
			}
			sandbox.map.setCenter(origin);
		}
	},
	
	/*
	* Manage the positioning of section-panels.
	*/

	initLocalStorage:function(){
		$('#setPositions').live('click', function() {
			var positions = localStorage.getItem("positions");
			if(positions){
				var pos = positions.split('|||');
				var out = "";
				$(pos).each(function(i){
					var data = pos[i].split(':');					
					$("#" + data[0]).css("left", parseInt(data[1], 0));		
					$("#" + data[0]).css("top", parseInt(data[2], 0));
					out += $(pos)[i] + "<br />";
				});
				sandbox.setOutput("localstorage", "Setting positions to:", out);
			}
			else {
				sandbox.setOutput("localstorage", "Setting positions to:", "no positions available");
			}
			return false;
			
		});
		$('#savePositions').live('click', function() {			
			var positions = $(".saveable")
				.map(function() {
					return $(this).attr("id") + ":" + Math.floor($(this).position().left) + ":" + Math.floor($(this).position().top);
				}).get().join('|||');				
			localStorage.setItem("positions", positions);
			var pos = positions.split('|||');
			var out = "";
			$(pos).each(function(i){
				out += $(pos)[i] + "<br />";
			});
			sandbox.setOutput("localstorage", "Positions saved:", out);
			return false;
		});
		$("#defaultPositions").live('click', function() {
			var x = $("#localstorage_content").position().left +2;
			var y = $("#localstorage_content").position().top +32;			
			$(".localstorage_rect").stop()
						.animate({top:y, left:x} , 500);			
			sandbox.setOutput("localstorage", "Positions reset to default.", "");
			return false;
		});
		$("#clearLocalStorage").live('click', function() {
			sandbox.setOutput("localstorage", "Clearing local storage...", "done!");
			localStorage.clear();
			return false;
		});
	},
	
	// Elements marked with class draggable are bound to jQueryUI-draggable-plugin
	initDrag: function() {
	
	var elements = $(".draggable");
		$(elements).draggable({
	        drag: function(event, ui) {
				//minimal.initCollisionDetection(event, ui);
	        },
	        stop: function() {
				//minimal.setContentHeight();
	        },
	        stack: ".draggable",
			opacity: 0.75,
			zIndex: 999,
			cursor: 'move',
			containment: "parent"
	    });
	},
	
	// Collision Detection
	initCollisionDetection:function(event, ui) {
		if($(".ui-draggable-dragging").collidesWith('.panel:visible').length > 0){
			var dragged = ui.helper;
            var dragged_data = dragged.data('draggable');
            var directionX = (dragged_data.originalPosition.left > dragged.position().left) ? 'left' : 'right';
            var directionY = (dragged_data.originalPosition.top > dragged.position().top) ? 'top' : 'bottom';
			//$(".ui-draggable-dragging").draggable( "option", "disabled", true );		
			$(".ui-draggable-dragging").removeClass(".ui-draggable-dragging").css("background-color","#aaa");
		}
		else {
			$(".ui-draggable-dragging").css("background-color","");
		}
	},
	
	/*
    * HTML5 Capabilities Testing
    */
  
	initSystemAnalysis: function() {
		$("#check_opener").live("click", function(){
			if(Modernizr) {
				sandbox.appendToOutput("output", Modernizr);
				// Detect and write user environment
				$("#user_browser").html(minimal.detectBrowser());	
				$("#user_os").html(minimal.detectOperatingSystem());
				$("#user_lang").html(minimal.detectLanguage());
				// Detect and write html5/CSS3-features				
				if(Modernizr._enableHTML5) { $("#html5_enable").addClass("ok").text(Modernizr._enableHTML5); }
				else { $("#html5_enable").text(Modernizr._enableHTML5).addClass("not_ok"); }
				if(Modernizr.borderimage) { $("#html5_borderimage").addClass("ok").text(Modernizr.borderimage); }
				else { $("#html5_borderimage").text(Modernizr.borderimage).addClass("not_ok"); }
				if(Modernizr.borderradius) { $("#html5_borderradius").addClass("ok").text(Modernizr.borderradius); }
				else { $("#html5_borderradius").text(Modernizr.borderradius).addClass("not_ok"); }
				if(Modernizr.boxshadow) { $("#html5_boxshadow").addClass("ok").text(Modernizr.boxshadow); }
				else { $("#html5_boxshadow").text(Modernizr.boxshadow).addClass("not_ok"); }
				if(Modernizr.textshadow) { $("#html5_textshadow").addClass("ok").text(Modernizr.textshadow); }
				else { $("#html5_textshadow").text(Modernizr.textshadow).addClass("not_ok"); }
				if(Modernizr.canvas) { $("#html5_canvas").addClass("ok").text(Modernizr.canvas); }
				else { $("#html5_canvas").text(Modernizr.canvas).addClass("not_ok"); }
				if(Modernizr.cssanimations) { $("#html5_cssanimations").addClass("ok").text(Modernizr.cssanimations); }
				else { $("#html5_cssanimations").text(Modernizr.cssanimations).addClass("not_ok"); }
				if(Modernizr.csstransitions) { $("#html5_csstransitions").addClass("ok").text(Modernizr.csstransitions); }
				else { $("#html5_csstransitions").text(Modernizr.csstransitions).addClass("not_ok"); }
				if(Modernizr.fontface) { $("#html5_fontface").addClass("ok").text(Modernizr.fontface); }
				else { $("#html5_fontface").text(Modernizr.fontface).addClass("not_ok"); }
				if(Modernizr.geolocation) { $("#html5_geolocation").addClass("ok").text(Modernizr.geolocation); }
				else { $("#html5_geolocation").text(Modernizr.geolocation).addClass("not_ok"); }
				if(Modernizr.audio) {
					var audio_elements = "";
					if(Modernizr.audio.m4a){ audio_elements += "m4a " ; }
					if(Modernizr.audio.mp3){ audio_elements += "mp3 " ; }
					if(Modernizr.audio.ogg){ audio_elements += "ogg " ; }
					if(Modernizr.audio.wav){ audio_elements += "wav " ; }
					$("#html5_audio").html(String(Modernizr.audio) + " - " + audio_elements).addClass("ok");
				}
				else { $("#html5_audio").html("false").addClass("not_ok"); }
				if(Modernizr.video) {
					var video_elements = "";
					if(Modernizr.video.h264){ video_elements += "h264 " ; }
					if(Modernizr.video.ogg){ video_elements += "ogg " ; }
					if(Modernizr.video.webm){ video_elements += "webm " ; }
					$("#html5_video").html(String(Modernizr.video) + " - " + video_elements).addClass("ok");
				}
				else { $("#html5_video").html("false").addClass("not_ok"); }
				if(Modernizr.localstorage) { $("#html5_localstorage").addClass("ok").text( Modernizr.localstorage); }
				else { $("#html5_localstorage").text(Modernizr.localstorage).addClass("not_ok"); }
				if(Modernizr.sessionstorage) { $("#html5_sessionstorage").addClass("ok").text( Modernizr.sessionstorage); }
				else { $("#html5_sessionstorage").text(Modernizr.sessionstorage).addClass("not_ok"); }
				if(Modernizr.webworkers) { $("#html5_webworkers").addClass("ok").text( Modernizr.webworkers); }
				else { $("#html5_webworkers").text(Modernizr.webworkers).addClass("not_ok"); }
				if(Modernizr.opacity) { $("#html5_opacity").addClass("ok").text( Modernizr.opacity); }
				else { $("#html5_opacity").text(Modernizr.opacity).addClass("not_ok"); }
				if(Modernizr.rgba) { $("#html5_rgba").addClass("ok").text( Modernizr.rgba); }
				else { $("#html5_rgba").text(Modernizr.rgba).addClass("not_ok"); }
				if(Modernizr.hsla) { $("#html5_hsla").addClass("ok").text( Modernizr.hsla); }
				else { $("#html5_hsla").text(Modernizr.hsla).addClass("not_ok"); }
				if(Modernizr.draganddrop) { $("#html5_draganddrop").addClass("ok").text( Modernizr.draganddrop); }
				else { $("#html5_draganddrop").text(Modernizr.draganddrop).addClass("not_ok"); }
				if(Modernizr.svg) { $("#html5_svg").addClass("ok").text( Modernizr.svg); }
				else { $("#html5_svg").text(Modernizr.svg).addClass("not_ok"); }
				
				// Set display
				$('.analysis_output').animate({opacity: 0}, 200, function() {
						$("#output").show().animate({opacity: 1}, 400);
						$("#analysis").show().animate({opacity: 1}, 400);
						minimal.setContentHeight();
				});
			}
			else {
				sandbox.setOutput("output", "Initialization Error", 'Modernizr not found!');
			}
			return false;
		});
	}    
};

//]]>