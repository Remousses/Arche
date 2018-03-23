<?php 
	session_start();
    require 'includes/fonctions/fonctions_diverses.php';

	if(!isset($_SESSION['Id_internaute'])){
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
                    require 'includes/fonctions/vues/fonction_vue_all.php';
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