<?php 
    session_start();
    
    if(isset($_SESSION['Id_groupe']) && !empty($_GET['nomAlerte'])){
?>
        <!DOCTYPE html>
        <html>
            <head>
                <?php require_once 'includes/head.php'; ?>
            </head>

            <body>
                <?php 
                    require_once 'includes/btn_fixed.php';
                    require_once 'includes/menu.php';
                ?>
                <br><br><br><br><br>
                <?php
                    require_once 'includes/fonctions/vues/fonction_vue_all.php';
                    participationProjet();
                ?>
                <br><br><br>
            </body>
        </html>
<?php
    }else{
        header('Location: all_alertes.php');
    }
?>