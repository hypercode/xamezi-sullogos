<?php
   
  error_reporting(E_ERROR);
  //------------------------------------------------------------------ 
  $dbhost='localhost';
  $dbuser='root';
  $server = mysql_connect($dbhost,$dbuser);
  
  if(!$server) 
     die('Could not connect: ' . mysql_error());
    
 
  $db=mysql_select_db('sullogos_database',$server);
   
  if (!$db)
      die ('Can\'t connect to database : ' . mysql_error());
   
   mysql_query("SET NAMES 'utf8'", $server);
   //-----------------------------------------------------------------  
   function autoIncrementValue($tableName)
   {
	  $result=mysql_query("show table status like '$tableName'");
	  $row=mysql_fetch_array($result);
	  $nextId=$row['Auto_increment'];
	  $nextId--;
	  return $nextId;
   }
   
   function sqlQuery($query)
   {
     	 $result= mysql_query($query);
	     if(!$result)
	          die("Could not enter data". mysql_error());
		  else  
		      return $result;
	}
   //-----------------------------------------------------------------
	   
?>