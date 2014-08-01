<?php
  include("../php_library/session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Άρθρα</title>

<link href="../plugins/smint/css/smint.css" rel="stylesheet" type="text/css"  />
<link href="../css/site.css" type="text/css" rel="stylesheet"/>
<link href="css/article.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="../javascript/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../javascript/json2.js"></script>
<script type="text/javascript" src="../tools/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../tools/ckeditor/config.js"></script>
<script type="text/javascript" src="../plugins/smint/js/jquery.smint.js"></script>
<script type="text/javascript" src="../javascript/site.js"></script>
<script type="text/javascript" src="javascript/article.js"></script>
</head>

<body>
<div class="start_page"></div> 
  <?php
  
     include('../php_library/dbConnect.php');
     include('../php_library/files.php');
     include("../php_library/header.php");
	 
	 echo '<div id="main_body"> ';
	 
	 if(!isset($_GET['articleID']) && !isset($_POST['ADD']))
	 {
		 //$category=sqlQuery("select * from category");
		 $found=false;
	     $category="";
	     $menu='<a id="start_page"><img src="../assets/icons/arrow_up4.png"></a>';
		 
		 $sql= "select distinct article.CategoryID,category.Title
				from article,category
				where article.CategoryID=category.CategoryID
				order by CategoryID";
		 $result=sqlQuery($sql);
	   
	     while($row=mysql_fetch_array($result))
	         $menu.='<a id="'.$row['Title'].'">'.$row['Title'].'</a>';
		   
		 echo '<div class="smint_menu">'.$menu.'</div>';
		   
		 $sql= "select ArticleID,article.Title as ArticleTitle,category.CategoryID,category.Title as CategoryTitle,DateTime
				from article,category
				where article.CategoryID=category.CategoryID
				order by category.CategoryID,DateTime desc";
	     $result=sqlQuery($sql);
  
         echo '<div id="articles">';
		 //==============================   ADMINISTRATOR   =====================================
		  if($role=='admin' && $mode=='edit')
			 echo   '<form method="post" action="article.php">
					 <input size="45" type="text" name="title" placeholder="Τίτλος Άρθρου"/>
					 <input type="submit" name="ADD" value="Δημιουργία Νέου Άρθρου"/>
					 </form>';
		  //======================================================================================
		   while($row=mysql_fetch_array($result))
		   {
			   
			 $found=true;
			 
			 if($row['CategoryTitle']!=$category)
			 {	
				if($category!="")
				   echo '</div>';
				
				echo '<div class="'.$row['CategoryTitle'].' articlesOfSameCategory">';
				$category=$row['CategoryTitle'];
				echo '<div class="category">'.$category.'</div>';
			 }
			 echo '<div class="articleContainer" id="'.$row['ArticleID'].'">';
			 
					  //=================   ADMINISTRATOR   =======================
					  if($role=='admin' && $mode=='edit')
						  echo '<button class="deleteArticle delete">Διαγραφή</button>';
					 //============================================================
					 
					 echo '<a target="blank" href="'.$_SERVER['PHP_SELF'].'?articleID='.$row['ArticleID'].'">
					       <div class="article">'.readArticle("article",$row['ArticleID']).'</div>
						   </a>';
				
						 
			echo '</div>';//articleContainer
		   }
			
		   if($found)
			 echo '</div>';
		   else
			  echo "Δεν υπάρχουν προς το παρόν άρθρα";
		  echo '</div>';//articles
	 }
	 else if(!isset($_GET['articleID']) && isset($_POST['ADD']) && $role=='admin')
     {
	 if(! get_magic_quotes_gpc() )
	     $title=addslashes($_POST['title']);
	  $sql="insert into article (Title,CategoryID) ".
	       "values('$title',1)";
		   
	  mysql_query("SET NAMES 'utf8'", $server);
     $result= mysql_query( $sql, $server );
	 if(!$result)
	   die("Could not enter data". mysql_error());
	   
	  $lastID=autoIncrementValue('article'); 
	  	 
	   $path=getcwd();
	   $path.="/articles/".$lastID."/";
	   makeDir($path);
	   $path.="images/";
	   makeDir($path);
	   
	   header("Location: ".$_SERVER['PHP_SELF']."?articleID=".$lastID);
    }
	 else
	 {
		  $articleID=$_GET['articleID'];
		  $article=sqlQuery("select * from article where ArticleID=".$articleID);
		  $row=mysql_fetch_array($article);
		  $categoryID=$row['CategoryID'];
		  $title=$row['Title'];
		  
		  
		   
		   //==========================  ADMINISTRATOR   =====================================
	       if($role=='admin' && $mode=='edit')
		   {
			       echo '<div>';
				   echo '<input size="120" type="text" name="title" id="title" placeholder="Τίτλος Άρθρου" required value="'.$title.'" style="margin-right:10px;"></input>';
				   
				   $categories=sqlQuery("select * from category");
				   
				   echo '<select id="CategoryID">';
				   while($row=mysql_fetch_array($categories))
				   {
					   echo '<option ';
					   if($categoryID==$row['CategoryID'])
						  echo 'selected="selected"';
					   echo' value="'.$row['CategoryID'].'">'.$row['Title'].'</option>';
				   }
				   
				   echo '</select><br/>';
				   echo '<div id="textAreaArticle"><textarea class="ckeditor" name="editor1" id="editor1">'.readArticle("article",$articleID).'</textarea></div>';
				   echo '<script type="text/javascript">
				            
							var editor=CKEDITOR.replace("editor1",{
								filebrowserBrowseUrl : "/sullogos2/tools/ckfinder/ckfinder.html",
								filebrowserImageBrowseUrl : "/sullogos2/tools/ckfinder/ckfinder.html?type=Images",
								filebrowserFlashBrowseUrl : "/sullogos2/tools/ckfinder/ckfinder.html?type=Flash",
								filebrowserUploadUrl : "/sullogos2/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
								filebrowserImageUploadUrl : "/sullogos2/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
								filebrowserFlashUploadUrl : "/sullogos2/tools/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
								
							
								});
						</script>';
				
				   echo '<button id="saveButton" value="'.$articleID.'">Αποθήκευση</button>
				         <div id="saveMessage"></div>';
				   
				   echo '</div>
				         <div id="chtml"></div>';		   
		   }
		   //===========================================================================================
		   else
		      echo '<div id="articleViewer">'.readArticle("article",$articleID).'</div>';
		 
	 }
	 echo ' </div>';//main_body
	 include("../php_library/footer.php");

  ?>  
 
</body>
</html>