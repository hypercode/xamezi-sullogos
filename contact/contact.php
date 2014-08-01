<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Επικοινωνία</title>

<link href="../css/site.css" type="text/css" rel="stylesheet"/>
<link href="css/contact.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="../javascript/jquery-1.8.3.js"></script>
<script type="text/javascript" src="../javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../javascript/site.js"></script>
<script type="text/javascript" src="javascript/contact.js"></script>
</head>

<body>

    <?php
	  
	  include('../php_library/dbConnect.php');
	  include("../php_library/header.php");
    ?>
      
     <div id="main_body">
        <h4>Στοιχεία Επικοινωνίας</h4> 
   <table> 
     <tr> 
        <td><img src="../assets/icons/phone2.png" width="40" height="40"></td><td>+30 210 35678</td> 
     </tr> 
     <tr> 
        <td></td><td>+30 6978401234</td> 
     </tr> 
     <tr> 
        <td><img src="../assets/icons/mail2.png" width="40" height="40"></td><td>info@syllogos.gr</td> 
     </tr> 
   </table> 
   <h4>Φόρμα Επικοινωνίας</h4> 
   <form action="contact.php" method="post"> 
      <table> 
          <tr> 
             <td><label>Όνομα</label></td><td><input class="textbox" name="userName" type="text" size="30" maxlength="30"></td> 
          </tr> 
          <tr> 
             <td><label>E-mail</label></td><td><input class="textbox" name="userMail" type="email" size="30" maxlength="50"></td> 
          </tr> 
          <tr> 
             <td><label>Θέμα</label></td><td><input class="textbox" name="mailSubject" type="text" size="30" maxlength="50"></td> 
          </tr> 
          <tr> 
             <td><label>Μήνυμα</label></td><td><textarea class="textbox" name="mailBody" cols="50" rows="10"></textarea></td> 
          </tr> 
          <tr> 
             <td></td><td><input  class="textbox" name="send" type="submit" value="Αποστολή" /><input  class="textbox" name="reset" type="reset" value="Ακύρωση" /></td> 
          </tr> 
      </table> 
   </form> 
     </div>
	  
	  <?php
	    include("../php_library/footer.php");
	 ?>
	
</body>
</html>