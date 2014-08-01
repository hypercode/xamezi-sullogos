// JavaScript Document

$(document).ready(function() {
	
	    //-------------Initialize timeline--------------------
		 $('.smint_menu').smint({
						'scrollSpeed' : 800 
						});
	    
		
		//-------------Initialize prettyPhoto-----------------
		$("a[rel^='prettyPhoto']").prettyPhoto();
		$("a[rel=prettyPhoto]").live("click",function() {
   		 	 $.prettyPhoto.open($(this).attr("href"),"","");
   			 return false;
		});
		 
        
		//-----------Initialize Mosaic------------------------
		$('.bar2').mosaic({animation:'slide'});
		
		
		//----------Initialize DatePicker---------------------
		$("#datePicker").datepicker({dateFormat: "yy-mm-dd"});
		$("#datePicker").datepicker($.datepicker.regional['gr']);
		 
		
		//----Initialize Timeago----
		$(".commentTime").timeago();
		 
		//-----Display thumb photos for each event----------
		$('.mosaic-block').each(function(i){
			
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
			timer=5000 + Math.floor(Math.random() * 10000);
			
			$('.mosaic-backdrop',target).append(images[0]);
			$('.mosaic-backdrop img',target).fadeIn(800);
			
			setInterval(function() {
				 
			  image=images[c];
			  $('.mosaic-backdrop',target).empty().append(image);
			  $('.mosaic-backdrop img',target).fadeIn(800);
			  c++;
			  if(c==images.length)
				c=0;
			}, timer);
    
        });
		
		//--------Event image gallery display --------
		/*$("ul.fadeIn li").each(function (i) {
		     $(this).delay(i*300).fadeIn(400);
        });
	*/
	    //----Upload photo to gallery --------
		$("#add").click( function(){
			  var windowSizePos="width=900,height=600,top=100,left=400";
			  var eventID=$("#eventIDHidden").html();
			  window.open( "../tools/FileUploader/index.html","uploader",windowSizePos);
			  uploader.moveTo(300,100);
		});
		
		//-----------Display event delete option----------------
		$(".mosaic-block").hover(
     	function(){$(".delete",this).fadeIn(50);},
	  	function(){$(".delete",this).fadeOut(50);}
                 );
		//-----------Display photo delete option------------
	    $("li").hover(
           function(){$(".delete",this).fadeIn(50);},
	       function(){$(".delete",this).fadeOut(50);}
        );
	    
		//---------Delete photo------------------------------
		$("img.deleteImage").click(function(){
			var image=$(this).parent().attr("id");
			$imageli=$(this).parent();
			var deleted=false;
			
			var dataToSend =[  
								  ["Table","event"],
								  ["Function","deleteImage"],
								  ["Image",image]								
						   ]					  
			
			$imageli.remove();
			ajax(dataToSend); 		
		
	    });	
		
		//-------Delete event---------------------------
		 $(".deleteEvent").click(function(){
			var eventID=$(this).parent().attr("id");
			$event=$(this).parent();
				
			var dataToSend =[  
								  ["Table","event"],
								  ["Function","deleteEvent"],
								  ["EventID",eventID]								
						   ]					  
			
			ajax(dataToSend); 		
			$event.remove();
	     });	
	 
	    //---------Initialize Videos List---------------
		$("#PlaylistURL").ready(function(e){
			 
			  if($('#PlaylistURL').val()!="")
			  {
			    $PlaylistURL=$('#PlaylistURL').val();
			    playlistInit($PlaylistURL);
			  }
		});
		
		//-------Edit Videos List------------------
		$("#PlaylistURL").change(function(e){

			  $PlaylistURL=$('#PlaylistURL').val();
			  if(isURL($PlaylistURL))
			  {
		         $PlaylistURL=$('#PlaylistURL').val().split("list=");
			     $PlaylistURL=$PlaylistURL[1].split('&');
			     $PlaylistURL=$PlaylistURL[0];
				 
				 playlistInit($PlaylistURL); 
				 $('#PlaylistURL').val($PlaylistURL);
			  }
			   
		 });
		 
		 //------Save Event to database----------------
		 $("#addData").click(function(e){
			
			 var dataToSend =[  
			                    ["Table","event"],
								["Function","update"],
			  				    ["Title",$('#title').val()],
								["Date",$('#datePicker').val()],
								["Description",$('#description').val()],
								["PlaylistURL",$('#PlaylistURL').val()]
							
							  ]					  

			 ajax(dataToSend).success(function (data) 
			 {
				  data=data.split('-');
				  if(data[0]=='1')
					  $('#message').addClass('successMessage');
				  else if(data[0]=='2')
					  $('#message').addClass('failedMessage');
								
				  $('#message').empty().append(data[1]);
			 });
			
		 });
        
		//------------Like event comment-----------------	
		$(".likeButton").live("click",function(e){
			
			
		    $commentID=e.target.parentNode.parentNode.id;
		
			var dataToSend =[  
			                    ["Table","commentevent"],
			  				    ["Function","Like"],
								["CommentID",$commentID]
							
							]	
			ajax(dataToSend).success(function (data) 
			{
				 $('#'+e.target.parentNode.id+'>:nth-child(2)').empty().append(data);
			});			
			
		});

        //-----------Make a comment-----------------------------------
		$("#newCommentSubmit").click(function(){
			 
			 var dataToSend =[  
			                    ["Table","commentevent"],
			  				    ["Function","Insert"],
								["Comment",$('#newCommentContent').val()],
								["TimeDate",null]
														
							]	
			ajax(dataToSend).success(function (data) 
			{
				  $('#comments').prepend(data);
				  $(".commentTime").live("ready",timeago());
			});						  
		});
		
});

function playlistInit(PlaylistURL)
{

	    var playListURL = 'http://gdata.youtube.com/feeds/api/playlists/'+PlaylistURL+'?v=2&alt=json&callback=?';
		var videoURL= 'http://www.youtube.com/watch?v=';
		$.getJSON(playListURL, function(data) {
   		var list_data="";
    	$.each(data.feed.entry, function(i, item) {
        var feedTitle = item.title.$t;
        var feedURL = item.link[1].href;
        var fragments = feedURL.split("/");
        var videoID = fragments[fragments.length - 2];
        var url = videoURL + videoID;
        var thumb = "http://img.youtube.com/vi/"+ videoID +"/default.jpg";
        list_data += '<li><a rel="prettyPhoto" href="'+ url +'" title="'+ feedTitle +'"><span>'+feedTitle+'</span><br/><img alt="'+ feedTitle+'" src="'+ thumb +'"/></a></li>';
        });
		 $("#videosList").empty().append(list_data);
        }); 
	
}	

function isURL(PlaylistURL)
{
	   if((PlaylistURL.search("list="))!=-1)
	     return true;
	    else
		  return false;
}
 

