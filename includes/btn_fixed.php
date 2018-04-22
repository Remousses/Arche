<?php
    if(!empty($_SESSION)){
?>
        <div class="bouton">
            <a class="btn" href="deconnexion.php">D&eacute;connexion</a>
        </div>
        <div class="bouton" style="margin-top: 35px;">
            <a class="btn" href="profile.php">Profile</a>
        </div>
<?php
    }else{
?>      <div class="bouton">
            <a class="btn" href="connexion.php">connexion</a>
        </div>
<?php
}
?>