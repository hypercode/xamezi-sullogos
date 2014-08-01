<?php


  include("session.php");
  include('dbConnect.php');
  include('files.php');

  //$eventID=$_SESSION['eventID'];
  $userID=2;
  $userName="iPaixtouras";
  
  $data = json_decode(stripslashes($_POST['data']),true);
  $table=$data[0][1];
  $sql="";
 

  if($table=='event' && $role=='admin')
  {
	  $function=$data[1][1];
	  
	  if($function=='update')
	  {
		  $sql.="update event set ";
		  for($i=2;$i<count($data);$i++)
		  {
			 if($data[$i][0]!="")
				$sql.=$data[$i][0]."='".$data[$i][1]."'";
			 if($i<count($data)-1)
				 $sql.=",";
		  }
		  $sql.=" where eventID='".$eventID."'";	
		  
		  $result=sqlQuery($sql);
	
		   if(!$result)
			  echo "2-Οι αλλαγές δεν καταχωρήθηκαν. Προσπαθήστε ξανά.";
		   else
			  echo '1-Οι αλλαγές σας καταχωρήθηκαν επιτυχώς.';
	  }
	  else if($function=="deleteEvent")
	  {
		  $eventID=$data[2][1];
		  $sql.="delete from event where eventID='".$eventID."'";
		  
		 $result=sqlQuery($sql);
		 
		 if($result)
		 {
			 $dir=getcwd()."/../event/events/".$eventID;
             deleteDir($dir);
			 //$dir=$dir."/TEST";
			 //deleteDir($dir);
		 }
	  }
	  else if($function=="deleteImage")
	  {
		  $image=$data[2][1];
		 
		  $file=getcwd()."/../event/events/".$image;
		  $thumb=split('/',$image);
		  $thumbnail=getcwd()."/../event/events/".$thumb[0]."/thumbnail/".$thumb[1];
		
		  
		  if(file_exists($file))
			unlink($file);
			
		  if(file_exists($thumbnail))
			unlink($thumbnail);
	  }
   
  }
  else if($table=='commentevent' && $role!='visitor')
  {
	   
        $function=$data[1][1];
		
		if($function=="Like")
		{
			$commentID=$data[2][1];
			
			$sql="select * ".
			     "from userlikes ".
				 "where commentID='$commentID' and userID=$userID";
			$result=sqlQuery($sql);
			$num_rows=mysql_num_rows($result);
			 
			if($num_rows==0)
			{
				$sql="update commentevent ".
				      "set Likes=Likes+1 ".
					  "where commentID='$commentID'";
				sqlQuery($sql);
				
					
			    $sql="select Likes from commentevent where commentID='$commentID'";
                $result=sqlQuery($sql);
				$row=mysql_fetch_array($result);
				
				
				$sql="insert into userlikes (CommentID, UserID) values ($commentID,$userID) ";
				sqlQuery($sql);     
				
				echo $row['Likes'];

			 }
			 else
			    echo 'exete kanei hdh like'; 
			 
					   
		}
		else if($function=="Insert")
		{
			
			$commentContent=$data[2][1];
			$time=date ("Y-m-d H:i:s");
			
			$sql="insert into commentevent (EventID, TimeDate,UserID,UserName,Comment,Likes) 
			      values ($eventID,'$time',$userID,'$userName','$commentContent',0) ";
			$result=sqlQuery($sql);      
				
					
			$lastID=autoIncrementValue('commentevent');
				
			echo '<div id="'.$lastID.'">
							  <div class="commentUser">'.$userName.'</div>
							  <div class="commentTime" title="'.$time.'"></div>
							  <div class="commentContent">'.$commentContent.'</div>
							  <div class="commentLikes" id="L'.$lastID.'">
								  <img class="likeButton" src="../assets/icons/like.png" />
								  <pre class="likeCount">0</pre>
							  </div>
			     </div>' ;	
		}	  
  }
  else if($table=="article" && $role=='admin')
  {
	  $function=$data[1][1];
	  
	  if($function=="update")
	  {
		  $articleID=$data[2][1];
		  $title=$data[3][1];
		  $categoryID=$data[4][1];
		  $content=$_POST['content'];
			
		  sqlQuery("update article set Title='$title',CategoryID='$categoryID' where ArticleID='$articleID'");
		  
		  writeHtml('article',$articleID,"$content");
	  }
	  else if($function=='delete')
	  {
		  $articleID=$data[2][1];
		  
		  $result=sqlQuery("delete from article where ArticleID='$articleID'");
		  
		  if($result)
		  {
			 $dir=getcwd()."/../article/articles/".$articleID;
             deleteDir($dir);
		  }
		     
	  }
  	 
  }
  /*else if($table=="CKEditor")
  {
	 // $articleID=$data[1][1];
	  $title=$data[1][1];
	  $data=readHtml($title,$articleID);
		  
		  echo $data;
	
  }*/
  else if($table=="announcement" && $role=="admin")
  {
	   $function=$data[1][1];
	   
	   if($function=='update')
	   {
			   $announcementID=$data[2][1];
			   $title=$data[3][1];
			   $description=$data[4][1];
			   $type=$data[5][1];
			   $sendMail=$data[6][1];
			   $dateExpire=$data[7][1];
			   $importance=$data[8][1];
			   $isEvent=false;
			   
			   if($type=="event")
			   {
				 $isEvent=true;
				 
				 if($sendMail)
				 {
					 //mail
					 echo 'mail';
				 }
			   }
			
			   
				$result=sqlQuery("update announcement set    Title='$title',Description='$description',isEvent='$isEvent',ExpirationDate='$dateExpire',Importance='$importance' 
				where AnnouncementID='$announcementID'");	
				
				if(!$result)
					 echo "2-Οι αλλαγές δεν καταχωρήθηκαν. Προσπαθήστε ξανά.";
				else
					 echo '1-Οι αλλαγές σας καταχωρήθηκαν επιτυχώς.';	
	   }
	   else if($function=='delete')
	   {
		    $announcementID=$data[2][1];
			$sql.="delete from announcement where AnnouncementID='".$announcementID."'";
		  
		    sqlQuery($sql);
	   }
  }
 
?>