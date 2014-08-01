<?php
  
  session_start();
  
  //------- ROLE -----------------------------
  if(!isset($_SESSION['role']))
    $_SESSION['role']='admin'; //visitor,user,admin
	
  //------- MODE -----------------------------
  if(!isset($_SESSION['mode']))
    $_SESSION['mode']='edit'; //view,edit
	
  //------ EVENT -----------------------------
  if(!isset($_SESSION['eventID']))
      $_SESSION['eventID']=null;
  if(isset($_GET['eventID']))
      $_SESSION['eventID']= $_GET['eventID'];
  
		
   //----- ARTICLE ---------------------------
   if(!isset($_SESSION['articleID']))
      $_SESSION['articleID']=null;
   if(isset($_GET['articleID']))
      $_SESSION['articleID']= $_GET['articleID'];
  
  //----- ANNOUNCEMENT ---------------------------
  if(!isset($_SESSION['announcementID']))
      $_SESSION['announcementID']=null;
  if(isset($_GET['announcementID']))
      $_SESSION['announcementID']= $_GET['announcementID'];
  
  
 
  $role=$_SESSION['role'];
  $mode=$_SESSION['mode'];
  $eventID=$_SESSION['eventID'];
  $articleID=$_SESSION['articleID'];
  $announcementID=$_SESSION['announcementID'];

?>
