<?php
    if(!empty($_SESSION)){
?>
        <div class="bouton">
            <a class="btn" href="deconnection.php">D&eacute;connection</a>
        </div>
<?php
    }else{
?>      <div class="bouton">
            <a class="btn" href="connection.php">Connection</a>
        </div>
<?php
}
?>