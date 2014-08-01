// JavaScript Document

$(document).ready(function(){
	
	var announcementDiv='hidden';
	
	$('#panel').ready(function() {
		
		  $height=$(window).height();
          $('#panel').css("height",$height);
       });
	   
	 $('#showPanel').click(function(event){
		    event.stopPropagation();
		    $('#panel').animate(
			  {left:'-30px'},
			  {
				 duration:600,
			     easing:'easeOutBack'
			  }
		      );
		 
	 });
	 
	/* $('#showAnnouncementDiv').click(function(){
		 
		 switch(announcementDiv)
		 {
		   case 'hidden':
		     $('#announcementDiv').animate(
		     {height:'100px'},
		     300,
		     function(){
			     announcementDiv='shown';
			  });
		   break;
		   case 'shown':
		     $('#announcementDiv').animate(
		     {height:'0px'},
		     300,
		     function(){
			     announcementDiv='hidden';
			  });
		 }
	 });*/
	 
	 $('html').click(function(e){
			  
			  var container = $("#panel");

				if (!container.is(e.target) && container.has(e.target).length === 0)
				{
					container.animate(
					  {left:'-300px'},
					  {
						 duration:600,
						 easing:'easeOutBack'
					  }
					  );
					
				}
		 
		 });
	 
  });