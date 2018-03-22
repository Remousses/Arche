<?php 
    session_start();
    
    if(!empty($_SESSION['Id_internaute'])){
        header('Location: all_alertes.php')
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'includes/head.php'; ?>
    </head>

    <body>
        <?php 
            require 'includes/btn_fixed.php';
            require 'includes/menu.php';
        ?>
        <br><br><br><br><br>
        <?php
            require 'includes/fonctions/vues/fonction_vue_internaute.php';
            
            participationProjet();
        ?>
        <br><br><br>
    </body>
</html>