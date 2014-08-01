<?php
  include("../php_library/session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Εκδηλώσεις</title>

<link href="../css/site.css" type="text/css" rel="stylesheet"/>
<link href="css/event.css" type="text/css" rel="stylesheet"/>
<link href="../plugins/prettyPhoto/prettyPhoto.css" type="text/css" rel="stylesheet"/>
<link href="../plugins/datepicker/css/ui-lightness/jquery-ui-1.10.1.custom.css" type="text/css" rel="stylesheet"/>
<link href="../plugins/custom-scrollbar-plugin/jquery.mCustomScrollbar.css"  rel="stylesheet" type="text/css" />
<link href="../plugins/mosaic/css/mosaic.css" rel="stylesheet" type="text/css"  />
<link href="../plugins/smint/css/smint.css" rel="stylesheet" type="text/css"  />

<script type="text/javascript" src="../javascript/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../javascript/json2.js"></script>
<script type="text/javascript" src="../plugins/prettyPhoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="../plugins/datepicker/js/jquery-ui-1.10.1.custom.js"></script>
<script type="text/javascript" src="../plugins/custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="../plugins/timeago/jquery.timeago.js"></script>
<script type="text/javascript" src="../plugins/mosaic/js/mosaic.1.0.1.js"></script>
<script type="text/javascript" src="../plugins/smint/js/jquery.smint.js"></script>
<script type="text/javascript" src="../javascript/site.js"></script>
<script type="text/javascript" src="javascript/event.js"></script>
</head>

<body>
<div class="start_page"></div>
 <?php 
  
  include('../php_library/dbConnect.php');
  include('../php_library/files.php');
  include("../php_library/header.php");
 
  echo '<div id="main_body">';     
  
  if(!isset($_GET['eventID']) && !isset($_POST['ADD']))
  {
	   $found=false;
	   $year="";
	   $menu='<a id="start_page"><img src="../assets/icons/arrow_up4.png"></a>';
	   
	   $sql="select distinct YEAR(Date) as Year from event order by Date desc";
	   $result=sqlQuery($sql);
	   
	   while($row=mysql_fetch_array($result))
	       $menu.='<a id="'.$row['Year'].'">'.$row['Year'].'</a>';
	   
	   echo '<div class="smint_menu">'.$menu.'</div>'; 
	   
	   $sql="select EventID,Title,Description,YEAR(Date) as Year from event order by Date desc";
	   $result=sqlQuery($sql);
  
       echo '<div id="events">';
	   
	   //==============================   ADMINISTRATOR   =====================================
	  if($role=='admin' && $mode=='edit')
	  {
		  echo '<form method="post" action="event.php" >
			   <input size="45" type="text" name="title" placeholder="Τίτλος Εκδήλωσης"/>
			   <input type="submit" name="Submit" value="Δημιουργία Νέας Εκδήλωσης"/>
			   </form>';
	  }
	  //=====================================================================================
	   while($row=mysql_fetch_array($result))
	   {
		   
		 $found=true;
		 
		 if($row['Year']!=$year)
		 {	
			if($year!="")
			   echo '</div>';
			
			echo '<div class="'.$row['Year'].' eventsOfOneYear">';
			$year=$row['Year'];
			echo '<div class="year">'.$year.'</div>';
		 }
		 echo '<div class="mosaic-block bar2" id="'.$row['EventID'].'">';
		 
				  //=================   ADMINISTRATOR   =======================
				  if($role=='admin' && $mode=='edit')
					  echo '<button class="deleteEvent delete">Διαγραφή</button>';
				 //============================================================
				 
				 echo '<a target="blank" href="'.$_SERVER['PHP_SELF'].'?eventID='.$row['EventID'].'" 
					  class="event mosaic-overlay"> 
					  <div class="details">
						  <h4>'.$row[1].'</h4>
						  <p>'.$row[2].'</p>
					  </div>
				  </a> 
				  <div class="mosaic-backdrop"> 
				  </div>
				  <div class="mosaicEventThumbImages">';
					 
				   $imgArray=getEventImages($row['EventID']);
						 
					if(!is_null($imgArray))
					{
					
					  $imagesCount=count($imgArray);
					  if($imagesCount>5)
						 $imagesCount=5;
					  for($j=0;$j<$imagesCount;$j++)   
						echo "<img src='events/".$row['EventID']."/thumbnail/$imgArray[$j]'/>";
	
					  unset($imgArray);
					}
					 
		   echo    '</div>
			  </div>';//event_section
	   }
		
	   if($found)
	     echo '</div>';
	   else
	      echo "Δεν υπάρχουν προς το παρόν εκδηλώσεις";
	  
	 
   echo '</div>';
  }
  else if(!isset($_GET['eventID'])  && isset($_POST['ADD']) && $role=='admin')
  {
	  if(!get_magic_quotes_gpc() )
	     $title=addslashes($_POST['title']);
	 
	  $sql="insert into event (title) ".
	       "values('$title')";
	  $result=sqlQuery($sql);
	
	  $lastID=autoIncrementValue('event');
	 
	  header("Location: ".$_SERVER['PHP_SELF']."?eventID=".$lastID."");

  }
  else
  {
	  $sql="select  * from Event ".
	       "where EventID=$eventID";
	  $result=sqlQuery($sql);

	
	  if(!($row=mysql_fetch_array($result)))
		  echo  "Δεν βρέθηκε η εκδήλωση";
	  else
	  {		   
	     $title=$row['Title'];
		 $date=$row['Date'];
		 $description=$row['Description'];
	     $playlisturl=$row['PlaylistURL'];
		  
		 
		 echo  ' <div id="info">'; 
		 //==============================   ADMINISTRATOR   ===================================== 
		 if($role=='admin' && $mode=='edit')
		 {
			 echo '<input size="45" type="text" name="title" id="title" placeholder="Τίτλος Εκδήλωσης" required value="'.$title.'"></input>
				 <input type="text" id="datePicker" name="date" placeholder="Ημερομηνία Εκδήλωσης" value="'.$date.'"/><br/>
				 <textarea name="description" id="descriptionEdit"  rows="7" placeholder="Περιγραφή Εκδήλωσης">'.$description.'</textarea><br/>
				 <input type="button" id="addData" value="Αποθήκευση" />
				 <div id="message"></div>';
				
		 }
		 //=======================================================================================
		 else
		 {
			 echo '<div id="title">'.$title.'</div>
				   <div id="date">'.$date.'</div>
				   <div id="description">'.$description.'</div>';
		 }
		 echo '</div>
		  <div id="media">
			<div id="photos" class="scroll">
			 <ul class="fadeIn">';			
					//==============================   ADMINISTRATOR   =====================================
					if($role=='admin' && $mode=='edit')
					   echo '<li style="background-color:#D7D7D7; cursor:pointer">
					         <img src="../assets/icons/add1.png" id="add" /></li>';
				    //=======================================================================================
				
				    $imgArray=getEventImages($eventID);
					
					if(is_null($imgArray))
						echo "<p>Δεν υπάρχουν προς το παρόν φωτογραφίες. Θα προστεθούν το συντομότερο.</p>";		 
					else
					{
					
					  $imagesCount=count($imgArray);
					  for($j=0;$j<$imagesCount;$j++) 
					  {     
						echo "<li id='$eventID/$imgArray[$j]'><a rel='prettyPhoto[pp_gal]' href='events/$eventID/$imgArray[$j]' class='imageRow'><img class='gallery' src='events/$eventID/thumbnail/$imgArray[$j]'/></a>";
						
						//===============  ADMINISTRATOR   ==============================
						if($role=='admin' && $mode=='edit')
						    echo '<button class="deleteImage delete">Διαγραφή</button>';
						//=======================================================================================
						
						echo '</li>';	
						
					   }
					   unset($imgArray);
					 }
					 echo '<li id="eventIDHidden" style="visibility:hidden">'.$f.'</li>';			
		   
	    echo '</ul>
			</div>
			<div id="videos" class="scroll">';
			   
			   //=================   ADMINISTRATOR   =====================================
			   if($role=='admin' && $mode=='edit')
			      echo '<input "type="text" size="26" name="PlaylistURL" id="PlaylistURL" value="'. $playlisturl.'" style="margin-left:35px;"/>';
			   //=======================================================================================
			   else
			       echo '<input style="display:none "type="text" size="45" name="PlaylistURL" id="PlaylistURL" value="'. $playlisturl.'"/>';
				   
			   echo '<ul id="videosList" >
			   </ul>
			</div>	
		  </div>';
		  //===================   USER - ADMINISTRATOR   ===============================
		  if($role!='visitor')
		  {
			   echo '<div id="newComment">
					 <input type="text"  size="70" id="newCommentContent"/>
					 <input type="button" id="newCommentSubmit" value="comment"/>
					 </div>';
		  }
		  //=======================================================================================
		   echo '<div id="comments">';
		   
		   $sql="select  * from commentevent ".
	            "where EventID=$eventID";
	       $result=sqlQuery($sql);

	       while($row=mysql_fetch_array($result))
		   {				
				echo '<div class="comment" id="'.$row['CommentID'].'">
						 <div class="commentUser">'.$row['UserName'].'</div>
						 <div class="commentTime" title="'.$row['TimeDate'].'"></div><br/>
						 <div class="commentContent">'.$row['Comment'].'</div>
						 <div class="commentLikes" id="L'.$row['CommentID'].'">
							<img class="likeButton" src="../assets/icons/like.png" />
							<div class="likeCount">'.$row['Likes'].'</div>
						 </div>
					 </div>';
			}
			   
		    echo '</div>
		          <div class="clear"></div>';
		
	    }
	  }
  
      echo '</div>';//main_body
    
      include("../php_library/footer.php");

?>

</body>
</html>
