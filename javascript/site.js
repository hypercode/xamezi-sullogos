// JavaScript Document

function ajax(array)
{           
      var jsonString=JSON.stringify(array);
           
	  return $.ajax({
		         type:'POST',
				 url:'../php_library/dbSubmit.php',
				 data:{data: jsonString}
      });
}
function initializeDocumentDimensions()
{
	$windowHeight=$(window).innerHeight();
	$windowWidth=$(window).width();  
	$headerHeight=$('#header').height();
	$footerHeight=$('#footer').height();
	$mainBodyHeight=$('#main_body').height(); 
	$mainBodyWidth=$('#main_body').width();
	$fixedHeight=$windowHeight-$headerHeight-$footerHeight;
	
	//alert("window height: "+$windowHeight+"\n"+"document height: "+$bodyHeight);
	if($windowWidth<$mainBodyWidth)
	  $('body').width($mainBodyWidth); 
	if($mainBodyHeight < $fixedHeight)
	   $('#main_body').height($fixedHeight);
}
$(window).load(function(){
         $(".scroll").mCustomScrollbar();		 	
});

$(document).ready(function(e) {
	
	$(this).scrollTop(0);
    initializeDocumentDimensions();
	
    $("#nav_menu ul li a").hover(
	       function(){
		           $(this).stop().animate({color:"#f00"},1000);
		             },
		   function(){
			       $(this).stop().animate({color:"#333"},1000);
			         }
	);
	
});

