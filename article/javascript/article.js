// JavaScript Document


$(document).ready(function(){
	
	 loadArticle();
    
	//-------Initialize categories menu-----------
	 $('.smint_menu').smint({
						'scrollSpeed' : 1000 
						});
	    
	
	//-----------Display delete icon----------------
	$(".articleContainer").hover(
      function(){$(".delete",this).fadeIn(50);},
	  function(){$(".delete",this).fadeOut(50);}
                 );
				 
		
	//----------Save Article---------------------
	$("#saveButton").click(function(){
		 
		 var d=CKEDITOR.instances["editor1"].getData();
		// d=addslashes(d);
		  var dataToSave =[  
			                 
									 ["Table","article"],
									 ["Function","update"],
									 ["ArticleID",$("#saveButton").val()],
									 ["Title",$('#title').val()],
									 ["CategoryID",$('#CategoryID').val()]

						  ]		
				
          var jsonString=JSON.stringify(dataToSave);
		  $.ajax({
		           type:'POST',
				   url:'../php_library/dbSubmit.php',
				   dataType:'html',
				   data:{data: jsonString, content: d},
				   success:function(data){
					   $('#saveMessage').empty().append("Article Saved Successfully");
				   }
		   });	
	});
	
	//-------Delete Article---------------------------
	$(".deleteArticle").click(function(){
			var articleID=$(this).parent().attr("id");
			//alert(articleID);
			$article=$(this).parent();
				
			var dataToSend =[  
								  ["Table","article"],
								  ["Function","delete"],
								  ["ArticleID",articleID]								
						   ]					  
			
			ajax(dataToSend); 		
			$article.remove();
	 });	
	
	
});
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
function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

