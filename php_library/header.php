<div id="header">
    <div id="signup_login">
          <?php
            if(isset($_SESSION['user']))
			{
               echo '<span id="login_user">'.$_SESSION['user'].'</span>';
			   echo '<img class="icon" id="login_options" src="../assets/icons/gemicon/PNG/32x32/row 3/12.png" />';
			}
            else
               echo '<span id="login_user">Είσοδος</span>';
          ?>
    </div>
    <div id="logo_and_menu">
        <div id="logo">
          <img src="../assets/images/logo.png" />
          <a href="/sullogos2/">SYLLOGOS.GR</a>
        </div>
        <div id="nav_menu_header">
          <ul>
            <li><a href="/sullogos2/">Αρχική</a></li>
            <li><a href="/sullogos2/event/event.php">Εκδηλώσεις</a></li>
            <li><a href="/sullogos2/article/article.php">Άρθρα</a></li>
            <li><a href="/museum/">Μουσείο</a></li>
            <li><a href="/sullogos2/contact/contact.php">Επικοινωνία</a></li>
          </ul>
        </div>
    </div>
    
</div>