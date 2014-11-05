/* minimal-anders.de JavaScript Library
 * 
 * @authors Christof Bauer
 *
 */
//<![CDATA[

if(typeof minimal === "undefined"){
    if(typeof this.minimal === "undefined"){
        this.minimal = {};
    }
    minimal.global = this;
}

$(document).ready(function(){	
	minimal.initOpeners(["#contact_opener", "#imprint_opener"]);
	//minimal.init();
	minimal.initNavigation();
	minimal.initHashNavigation();
	minimal.catchNavLinks(["#play_opener", "#think_opener", "#move_opener"]);
	minimal.catchOutgoingLinks();
	minimal.initOverlays();
	minimal.initThinkOpeners();
	minimal.initThinkNav();
	minimal.setContentHeight();
	//var lang = minimal.detectLanguage();
	//log(lang);
});

minimal = {
	
	slow: 500,
	delay: 250,
	fast: 100,
	contentHeight: 0,
	tempHiddenPanels: [],
	
	// Some init stuff...
	init: function() {	
		$("#footer").fadeIn(minimal.delay);
		$(".portal_panel a").hide();
		$(".portal_panel").live("mouseover", function() {
			$(this).find("a").fadeIn(minimal.slow).css("display", "block");
		});
	},
	
	//Fade in navigation and init color changement of links
	initNavigation: function(){
		$("#navigation").fadeIn(minimal.delay);		
		$("#navigation a")
			.hover(function(){
				//var element = $(this);
				//var color = getRandomColor();
				// change the text color of this element
				//element.css("color", color).fadeIn("fast");
				
			}, function(){
				
			}
		)
		.click(function(){
			$("#navigation a").removeClass("current_nav");
			$(this).addClass("current_nav");
		});
	},
	
	// Fade in Imprint and Contact
	initOpeners: function(selector){		
		for(var i=0; i<selector.length; i++) {
			$(selector[i]).live("click", function(){				
				if ($("#imprint:visible").length == 0 && $("#contact:visible").length == 0) {
					minimal.tempHiddenPanels = $(".panel:visible").not("#contact", "#imprint");	
				}
				var panel_to_open = $(this).attr("id").replace("_opener", "");
				if($("#" + panel_to_open).is(":visible")){
					minimal.highlightPanels();
					return false;
				}
				$(".context_panel, .panel").hide();
				$("#" + panel_to_open).fadeIn(minimal.delay, function(){
					minimal.setContentHeight();
				});
				return false;				
			});
		}
	},
	
	// Catch clicks on nav and shake, if already on that page
	catchNavLinks: function(selector){
		for(var i=0; i<selector.length; i++) {
			$(selector[i]).live("click", function(){		
				var current = $("div[id*='_wrapper']").attr("id").replace("_wrapper", "");
				var target = $(this).attr("id").replace("_opener", "");		
				var panels = $(".panel:visible");
				if ($("#contact:visible").length > 0 || $("#imprint:visible").length > 0) var constraint = true; 
				else var constraint = false; 
				if(target === current){									
					if(!constraint){
						minimal.highlightPanels();
						return false;
					}
					else {
						$(".panel:visible").hide();
						minimal.tempHiddenPanels.fadeIn(function(){
							minimal.setContentHeight();
						});
						return false;
					}
				}
			});
		}
	},
	
	// Catch outgoing links, open a new window, preserve page-validity by avoiding target attribute
	catchOutgoingLinks: function(){
		$(".link").live("click", function(){
			var href = $(this).attr("href");
			window.open(href);
			return false;
		});
	},
	
	// Show the content panels corrresponding to the URL hash
	initHashNavigation: function(){
		var hash = unescape(self.document.location.hash.substring(1));
		if(hash){
			switch(hash){
				case "detect_language_with_javascript":
					$(".think_content").hide();
					$("#theme_1").show();
					break;
				case "detect_os_with_javascript":
					$(".think_content").hide();
					$("#theme_2").show();
					break;
				case "detect_browser_with_javascript":
					$(".think_content").hide();
					$("#theme_3").show();
					break;
				case "ucwords_in_javascript":
					$(".think_content").hide();
					$("#theme_4").show();
					break;
				case "console_log":
					$(".think_content").hide();
					$("#theme_5").show();
					break;
				case "web_workers":
					$(".think_content").hide();
					$("#theme_6").show();
					break;										
				case "social_api":
					$(".think_content").hide();
					$("#theme_7").show();
					break;
				case "redis_io":
					$(".think_content").hide();
					$("#theme_8").show();
					break;
			}
		}
	},
	
	// Links marked with class="overlay" will trigger an overlay
	initOverlays: function(){
		$(".overlay_opener").live("click", function(){
			$(".overlay").fadeIn(minimal.fast, function(){
				$(".overlay_content").fadeIn(minimal.fast);
			});			
			return false;
		});
		$(".overlay_close").live("click", function(){
			$(".overlay").fadeOut(minimal.fast, function(){
				$(".overlay_content").fadeOut(minimal.fast);
			});			
			return false;
		});
	},
	
	// Set content height corresponding to the panels positions
	setContentHeight:function(){
		minimal.contentHeight = 0;
		var visible_panels = $(".panel:visible");
		if($(visible_panels).length === 0) {
			minimal.contentHeight = "auto";
		} else {
			visible_panels.each(function(i){	
				var ch = parseInt($(this).height() + $(this).offset().top, 0);
				if(minimal.contentHeight < ch ){
					minimal.contentHeight = ch;
				}
			});
		}
		var selector = $('div[id*="_wrapper"]');
		$(selector).css("height", minimal.contentHeight);
	},
	
	// Fade in the different theme-panels
	initThinkOpeners: function() {
		$("#think_themes a").live("click", function(){		
			$(".think_content").hide();
			var target = "#" + $(this).attr("href");
			$(target).fadeIn(minimal.fast , function(){
				minimal.setContentHeight();
			});
			return false;
		});
	},
	
	initThinkNav: function(){
		$("#think_themes").live("mouseenter", function(){
			$(this).css("z-index", "999");
		}).mouseleave(function(){
			$(this).css("z-index", "1");
		});
	},
		
	/*
    * System analysis
	*/
	
	// Detect the browser 
	detectBrowser: function(){
		var browser = "Unknown";
		var ua = navigator.userAgent;
		if (document.body.ontouchstart === undefined) {
			// Chrome
			if (window.execScript !== undefined && document.body.onmouseenter === undefined) {
				if (window.localStorage) {
					if (navigator.geolocation) {
						browser = "Chrome > 4";
					} else {
						browser = "Chrome 4";
					}
				} else if (document.body.compareDocumentPosition()) {
					browser = "Chrome 3";
				} else {
					browser = "Chrome < 3";
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
					browser = "Safari < 4";
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
	},
	
	// Detect the right OS
	detectOperatingSystem: function() {
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
    }, 
    
   // Detect language to set proper locale
	detectLanguage: function() {
		var lang = "";
		if (window.navigator.language !== undefined) {
			lang = window.navigator.language.split("-")[0];
		} else if (window.navigator.browserLanguage !== undefined){
			lang = window.navigator.browserLanguage.split("-")[0];
		}
		return lang;
	},
	
	// Shake panels up and down
	shakePanels: function() {
		$(".panel:visible")
			.stop()
			.animate({top: '-=5'} , 50)
			.animate({top: '+=10'} , 100)
			.animate({top: '-=20'}, 100)
			.animate({top: '+=20'}, 100)
			.animate({top: '-=10'} , 100)
			.animate({top: '+=5'} , 50);
	},
	
	// Make the panels blink
	highlightPanels: function() {
		$(".panel:visible")
			.stop()
			.animate({'background-color' : '#ffffff'} , 50)
			.animate({'background-color' : '#003366'} , 100)
			.animate({'background-color' : '#ffffff'}, 100)
			.animate({'background-color' : '#003366'}, 100)
			.animate({'background-color' : '#ffffff'} , 100);
	}
};

function log(message){
	console.log ? console.log(message) : alert(message);
}

// generate color, random values between 0 and 255,
function getRandomColor(){
	var r = Math.floor(Math.random()*256);
	var g = Math.floor(Math.random()*256);
	var b = Math.floor(Math.random()*256);
	return '#'+intToHex(r)+intToHex(g)+intToHex(b);
}

// to fix trailing zero problem
function intToHex(n){
	n = n.toString(16);
	if( n.length < 2) n = "0"+n;
	return n;
}

// This function uppercases the first letter of each word
function ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}


//]]>