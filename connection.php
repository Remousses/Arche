<?php 
	session_start();
    require_once 'includes/fonctions/fonctions_diverses.php';

	if(!isset($_SESSION['Id_internaute'])){
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
                    require_once 'includes/fonctions/vues/fonction_vue_all.php';
                    echo '<br><br><br><br><br>';
                    connectionInternaute();
                    inscriptionInternaute();
                ?>

                <!-- alterner connection et inscription comme GeekZone_2.0 -->
            </body>
        </html>
<?php
    }else{
        header('Location: index.php');
    }
?>