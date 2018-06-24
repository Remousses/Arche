<?php
    session_start();
    
	if(!isset($_SESSION['Id_groupe'])){
?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <?php 
                    require_once 'includes/head.php';
                    verificationIdGroupe('connexion.php');
                ?>
            </head>

            <body class="bg-dark">
                <div class="container">
                    <div class="card card-login mx-auto mt-5">
                        <?php
                            if(isset($_GET['message'])){
                                message();
                            }

                            connexionUtilisateur();
                        ?>
                    </div>
                </div>
            </body>
        </html>
<?php
    }else{
        header('Location: index.php?message=erreurPageConnexion');
    }
?>