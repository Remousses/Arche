<?php
	session_start();
    if(isset($_SESSION['Id_groupe']) && !empty($_GET['idAlerte']) && !empty($_GET['idProjet'])){
?>
        <!DOCTYPE html>
        <html>
            <head>
                <?php
                    require_once 'includes/head.php';
                ?>
            </head>

            <body>
                <?php 
                    require_once 'includes/menu.php';
                ?>
                <div class="milieu">
                    <br><br><br><br><br>
                    <?php
                        getProjet();

                        // pour projet
                        // if($_SESSION['Id_groupe'] == getIdGroupeNarrateur()){
                        //     require_once 'includes/fonctions/vues/fonction_vue_admin_narrateur.php';
                        //     redigerLivreSauvetage();
                        // }
                    ?>
                </div>
            </body>
        </html>
<?php
    }else{
        header('Location: all_alertes.php?message=erreurPage');
    }
?>