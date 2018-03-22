<?php 
	session_start();
    
	if(!empty($_SESSION['Id_internaute'])){
		header('Location: index.php');
        
	}else{
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
                    require 'includes/fonctions/vues/fonction_vue_internaute.php';
                    echo '<br><br><br><br><br>';
                    connectionInternaute();
                    inscriptionInternaute();
                ?>
            </body>
        </html>
<?php
	}
?>