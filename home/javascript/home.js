// JavaScript Document

$(document).ready(function(){
		
		$numOfFeeds=10;
		$counter=0;
		createNewsThumbnails();
		createNewsShowDiv();
		
		loadEvent();
		loadArticle();
		
		$('#rssFeed').rssfeed('http://www.tovima.gr/feed/culture/', {
    		limit: $numOfFeeds
  			});
		
       /* $('#container').masonry({
        
         itemSelector : 'item',
         columnWidth : 50,
         gutterWidth: 5,
		 isAnimated: true
        }).masonry('reload');*/

		$('#upArrow').click(function(){
			
			var container=$('#newsWindow');
			container.stop().animate({scrollTop: container.scrollTop() + container.offset().top-350}, 1000);
			});
			
		$('#downArrow').click(function(){
			
			var container=$('#newsWindow');
			container.stop().animate({scrollTop: container.scrollTop() + container.offset().top+250}, 2000);
			});
		
		$('#newsShow').click(function(){
			 $("#newsShow").hide();
			 $("#close").hide();
			 $("#newsContainer").fadeIn(700);
			});
		
		$('.news').click(function(){
			 $description='<span class="title">'+$(this).children(".title").html()+'</span>';
			 $description+='<p class="description">'+$(this).children(".description").html()+'</p>';
			 $("#newsShow").empty().append($description);
			 $("#newsContainer").hide();
			 $("#newsShow").fadeIn(700);
			 //$("#close").show();
			});
		
		
		setInterval(function(){
			  
			 $(".rssBody ul").children('.rssRow').eq($counter).hide();		 
			 $counter=($counter+1)%$numOfFeeds;
			 $(".rssBody ul").children('.rssRow').eq($counter).fadeIn(1500);
			 
			 
		},30000);


});

function createNewsThumbnails()
{
	$("#newsContainer div").each(function(i) {
		$description=$(this).children(".description").html();
	
	$description = $description.substring(0,140);
		
		
        $(this).append('<p class="thumbnail">'+$description+'[...]</p>');
    });
	
	
}
function createNewsShowDiv()
{
	$('#newsWindow').append('<div id="newsShow">Εδώ και 45 χρόνια, αυτό το μικρό σπίτι έχει καταφέρει να αντέξει κόντρα σε όλες τις κακουχίες και τις φυσικές θεομηνίες που έχει αντιμετωπίσει. Φαντάζει παράδοξο, αλλά η συγκεκριμένη κατοικία στέκει αγέρωχη στη μέση του ποταμού Drina της Σερβίας, κοντά στην πόλη Bajina Basta. Πλέον, είναι εύλογα ένα από τα τουριστικά αξιοθέατα της περιοχής.</div>');
}
function loadEvent()
{
		$('.event').each(function(i){
			
			var target = $(this);
			var images = [];
			var image;
			var timer;
			var c;
		    
			$('img',target).each(function(j) {
				var img=$(this);
				
				images.push(img);
            });
		
			c=1;
			timer=4000 + Math.floor(Math.random() * 7000);
			
			$('.eventImageSlider',target).append(images[0]);
			$('.eventImageSlider img',target).fadeIn(800);
			
			setInterval(function() {
				 
			  image=images[c];
			  $('.eventImageSlider',target).empty().append(image);
			  $('.eventImageSlider img',target).fadeIn(800);
			  c++;
			  if(c==images.length)
				c=0;
			}, timer);
    
        });
}
function loadArticle()
{			
		$(".article").find("img").each(function() {
			
			$imgHeight=parseInt($(this).css("height"),10);
			$imgWidth=parseInt($(this).css("width"),10);
			
			$imgHeight/=3;
			$imgWidth/=3;
			
			$(this).css({"height":$imgHeight,"width":$imgWidth});
		});
		
		$(".article").find("*").each(function() {
				 
		$fontSize=parseInt($(this).css("font-size"),10);
		
		if($fontSize>20)
		  $fontSize/=1.5;
		else if($fontSize>10)
		   $fontSize/=1.1;
		$(this).css({"font-size":$fontSize});
		});
				
}