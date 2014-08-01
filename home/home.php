<?php
  include("../php_library/session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Αρχική Σελίδα</title>

<link href="../css/site.css" type="text/css" rel="stylesheet"/>
<link href="css/home.css" type="text/css" rel="stylesheet"/>
<link href="../plugins/masonry/style.css" rel="stylesheet"/>
<link href="../plugins/zrssfeed/jquery.zrssfeed.css" rel="stylesheet"/>

<script type="text/javascript" src="../javascript/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../plugins/masonry/jquery.masonry.min.js"></script>
<script type="text/javascript" src="../plugins/zrssfeed/jquery.zrssfeed.js"></script>
<script type="text/javascript" src="../javascript/site.js"></script>
<script type="text/javascript" src="javascript/home.js"></script>
</head>

<body>
        
      <?php
	  
	  include('../php_library/dbConnect.php');
	  include('../php_library/files.php');
	  include("../php_library/header.php");
    
      
      echo '<div id="main_body">
               <div id="container">';
	               
				   //------------------------------- EVENT -------------------------
	               $sql='select EventID,Title,Description,Date from Event order by Date desc limit 0,1';
				   $result=sqlQuery($sql);
				   
				   while($row=mysql_fetch_array($result))
				   {
					       echo '<div class="item col3 event"> 
					             <a target="blank" href="/sullogos2/event/event.php?eventID='.$row['EventID'].'"';
						   echo '<h3  class="title">'.$row['Title'].'</h3>';
						   echo '<div class="eventImageSlider"></div>';
						   echo '<p class="description">'.$row['Description'].'</p>
								 <div class="eventThumbImages">';
						 
								$imgArray=getEventImages($row['EventID']);
									 
								if(!is_null($imgArray))
								{
								
								  $imagesCount=count($imgArray);
								  if($imagesCount>5)
					                  $imagesCount=5;
								  for($j=0;$j<$imagesCount;$j++)   
									echo "<img src='../event/events/".$row['EventID']."/thumbnail/$imgArray[$j]'/>";
				
								  unset($imgArray);
								}
						  echo '</div>';//eventThumbImages
					  echo '</a></div>';
				   }
	
	                //------------------------------- ARTICLE ---------------------------------------
			        $sql='select * from article order by DateTime desc limit 0,2';
				    $result=sqlQuery($sql);
				   
				   while($row=mysql_fetch_array($result))
				   {
					    echo '<div class="articleContainer item col3">
			 			        <a target="blank" href="/sullogos2/article/article.php?articleID='.$row['ArticleID'].'">
					               <div class="article">'.readArticle("article",$row['ArticleID']).'</div>
						        </a>
							  </div>';		
				   }
            
		echo '<div class="item col3 article"> Welcome on the CSS3 Shadows Generator (Box-Shadow),
 This generator lets you generate a CSS3 code that adds a shadow to an html box. This generator lets you easily configure different parameters of the shadow. You can change the size (spread), the color, the opacity, the blurriness, the type of shadow (inner or outter) and the offset of the shadow. While you change the parameters of the shadow a preview automatically updates to the new configuration. When the result satisfies you, you can directly copy the CSS3 code of the shadow in the Code section of this generator. The CSS3 properties generated with this generator works only on the newest browsers like FireFox, Safari, Google Chrome, Internet Explorer 9, Opera...</div>
              <div class="item col4" id="rssFeed">
              </div>
              <div class="clear"></div>
        </div><!--container-->
         
        <div id="rightDiv">
             <div id="news">
                <div id="newsWindow">
                     <div id="newsContainer">
                            <div class="news">
                              <span class="title">Τι αλλάζει στις αντικειμενικές αξίες των ακινήτων</span>
                              <p class="description">Με νέο αυτοματοποιημένο σύστημα θα προσδιορίζονται οι αντικειμενικές αξίες των ακινήτων. Σύμφωνα με το Έθνος, στον υπολογισμό τους θα λαμβάνεται υπόψη το τρέχον τίμημα στην αγορά, ώστε να συμπέσουν με τις εμπορικές τιμές.
        Παράλληλα, θα προβλέπεται επέκταση του αντικειμενικού προσδιορισμού των αξιών βάσει του ίδιου σχεδίου σε ολόκληρη την Ελλάδα.
        Όπως αναφέρει η εφημερίδα, θα υπάρξουν μειώσεις έως και 35% για τα ακίνητα σε μεσαίες και ακριβές περιοχές αλλά και αυξήσεις από την επέκταση των αντικειμενικών αξιών σε όλη την Ελλάδα. Εκτιμάται δε πως υψηλότερα θα είναι τα ποσοστά μείωσης στα παλιά ακίνητα και μικρότερα στα νεόδμητα.</p>
                            </div>
                            <div class="news">
                            <span class="title">Στις 14 Απριλίου οι εκλογές στη Βενεζουέλα</span>
                            <p class="description">Στις 14 Απριλίου θα διεξαχθούν οι εκλογές στη Βενεζουέλα, για την ανάδειξη του διαδόχου του Ούγκο Τσάβες, που άφησε την τελευταία του πνοή νικημένος από τον καρκίνο, σε ηλικία 58 ετών.
        Ο Νικολάς Μαδούρο, υποδειχθείς από τον ίδιο τον Ούγκο Τσάβες, ως διάδοχό του, ορκίστηκε προσωρινός πρόεδρος της χώρας, λίγες μόλις ώρες μετά την κηδεία του αποθανόντος προέδρου της Βενεζουέλας.</p>
                            </div>
                            <div class="news">
                            <span class="title">Το συνέδριο του Χαλίφη</span>
                            <p class="description">Ο Ιζνογκούντ της ελληνικής πολιτικής, ο Χαλίφης στη θέση του Χαλίφη, έκανε και το συνέδριό του. Συγκινητική και η προσπάθεια των ατροφικών πια συμφερόντων που ανέλαβαν εργολαβικά να τον αναστήσουν. Την εικόνα του, το ήθος του, την αξιοσύνη του, την ευστροφία του, το κύρος του. Να τους το αναγνωρίζουμε. Μόνο που όλοι εκείνοι ένα πράγμα λησμόνησαν. ‘Ότι ο Χαλίφης έμεινε χωρίς Χαλιφάτο. Τι σημασία έχει όμως, εκείνος θα το ζήσει ερήμην, μέχρι τελικής πτώσεως. Δικής του, του ΠΑΣΟΚ, της χώρας, θα δείξει.</p>
                            </div>
                            <div class="news">
                            <span class="title">Στο νοσοκομείο ο Νέλσον Μαντέλα</span>
                             <p class="description">Η προεδρία της δημοκρατίας στη Νότια Αφρική ανακοίνωσε επίσημα νωρίτερα, σήμερα ότι, ο τέως πρόεδρος Νέλσον Μαντέλα βρίσκεται ήδη στο νοσοκομείο.
        Αιτία της νοσηλείας Μαντέλα αναφέρθηκε στην ίδια ανακοίνωση πως είναι "να μπορέσει να πραγματοποιηθεί ο προγραμματισμένος πλήρης εργαστηριακός έλεγχος" του ιστορικού ηγέτη, του συμβόλου του αγώνα κατά του απαρτχάιντ στη Νότια Αφρική.</p>
                            </div>
                    </div><!--newsContainer-->
                  
                </div><!--newsWindow-->';
    ?>
                
                <div id="controls">
                    <img class="icon" id="downArrow" src="../assets/icons/arrow_down4.png"/>
                    <img class="icon" id="upArrow" src="../assets/icons/arrow_up4.png"/>
                    <img class="icon" id="close" src="../assets/icons/gemicon/PNG/32x32/row 8/12.png"/>
                </div>
                
             </div><!--news-->
             <div id="museum_link"><a href="/museum/"><img  src="../assets/images/museum_icon.jpg"/></a></div>
        </div><!--rightDiv-->
        <div class="clear"></div>
     </div><!--main_body-->
     <?php
	    include("../php_library/footer.php");
	 ?>
       
</body>
</html>