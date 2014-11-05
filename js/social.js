/* social.js / minimal-anders.de
 * 
 * @authors Christof Bauer
 *
 */
//<![CDATA[

if(typeof social === "undefined"){
    if(typeof this.social === "undefined"){
        this.social = {};
    }
    social.global = this;
}

social = {
	
	initSocialConnects: function(){
		social.checkSocialStatus();
		social.initSocialDataCollector(["#twitter_nav a", "#facebook_nav a"]);	
	},
	
	checkSocialStatus: function(){
		$.ajax({
			url: "../include/xhrCheckTwitterStatus.php",
			success: function(data){			
				if(data === "-1"){
					$("#twitter_nav").hide();
					$("#twitter_connect").show();
				} else if(data === "1"){
					$("#twitter_nav").show();
					$("#twitter_connect").hide();
				}
				minimal.setContentHeight();
			}
		});
		$.ajax({
			url: "../include/xhrCheckFacebookStatus.php",
			success: function(data){
				if(data === "-1"){
					$("#facebook_nav").hide();
					$("#facebook_connect").show();
				} else if(data === "1"){
					$("#facebook_nav").show();
					$("#facebook_connect").hide();
				}
				minimal.setContentHeight();
			}
		});
	},
	
	
	// Append listeners to data lists in order to retrieve social data
	initSocialDataCollector: function(selector){
		for(var i=0; i<selector.length; i++) {
			$(selector[i]).live("click", function(){
				var provider = $(this).attr("class");
				var metric = $(this).attr("title");
				var url = "../include/xhrGet" + ucwords(provider) + "Data.php?metric=" + metric;
				$("#social_output ul").hide();
				$("#output_header").hide();
				$(".ajax_loader").show();
				$.ajax({
					url: url,
					success: function(data){						
						$("#social_output ul").show();
						$("#output_header").show();
						$(".ajax_loader").hide();			
						if(data === "-1"){
							$("#social_output ul").empty().html("Sorry, no data available!");
						} else if(data === "0") {
							$("#social_output ul").empty().html("Empty, nothing to fetch!");
						} else {
							var feed = $.parseJSON(data);							
							switch(provider){
								case "twitter":
									social.displayTwitterData(metric, feed);
									break;
								case "facebook":
									social.displayFacebookData(metric, feed);
									break;
								default:
									minimal.setContentHeight();
							}
						}
					}
				});
				return false;
			});	
		}
	},
	
	// display data from xhrGetTwitterData.php in #output 
	displayTwitterData: function(metric, feed) {
		var html = "";		
		switch(metric){
			case "statuses/home_timeline":
				$(feed).each(function(){
					html += "<li>"+this.text+"</li>";
				});
				break;
			case "statuses/user_timeline":
				$(feed).each(function(){
					html += "<li>"+this.text+"</li>";
				});
				break;		
			case "statuses/followers":
				$(feed).each(function(){
					html += "<li><a class='link' href='http://twitter.com/#!/"+this.screen_name+"'>"+this.name+"</a></li>";
				});
				break;
			case "statuses/friends":
				$(feed).each(function(){
					html += "<li><a class='link' href='http://twitter.com/#!/"+this.screen_name+"'>"+this.name+"</a></li>";
				});
				break;			
			case "statuses/retweets_of_me":
				$(feed).each(function(){
					html += "<li>"+this.text+"</li>";
				});
				break;
		}
		$("#output_header").empty().html("Number of fetched entries: " + feed.length);
		$("#social_output ul").empty().html(html);
		minimal.setContentHeight();
	},
	
	// display data from xhrGetFacebookData.php in #facebook_output
	displayFacebookData: function(metric, feed){		
		var html = "";		
		switch(metric){
			case "friends":
				$(feed.data).each(function(){
					html += "<li><a class='link' href='http://www.facebook.com/profile.php?id="+this.id+"'>"+this.name+"</a></li>";
				});
				break;
			case "feed":
				$(feed.data).each(function(){
					html += "<li>"+this.message+"</li>";
				});
				break;		
			case "likes":
				$(feed.data).each(function(){
					html += "<li>"+this.name+"</li>";
				});
				break;
			case "events":
				$(feed.data).each(function(){
					html += "<li><a class='link' href='http://www.facebook.com/event.php?eid="+this.id+"'>"+this.name+"</a></li>";
				});
				break;			
			case "groups":
				$(feed.data).each(function(){
					html += "<li><a class='link' href='http://www.facebook.com/home.php?sk=group_"+this.id+"&ap=1'>"+this.name+"</a></li>";					
				});
				break;
		}
		$("#output_header").empty().html("Number of fetched entries: " + feed.data.length);
		$("#social_output ul").empty().html(html);
		minimal.setContentHeight();
	}
		
};

//]]>