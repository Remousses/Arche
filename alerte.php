<?php 
    session_start();
    
    if(isset($_SESSION['Id_groupe']) && !empty($_GET['idAlerte']) && !empty($_GET['idEspece'])){
?>
        <!DOCTYPE html>
        <html>
            <head>
                <?php require_once 'includes/head.php'; ?>
            </head>

            <body>
                <?php 
                    require_once 'includes/menu.php';
                ?>
                <div class="milieu">
                    <br><br><br><br><br>
                    <?php
                        
                        require_once 'includes/fonctions/gestions/fonction_gestions_projets.php';
                        require_once 'includes/fonctions/vues/fonction_vue_all.php';
                        getAlerte(1);
                        echo '<br><br>';
                        participationAlerte();
                        echo '<br><br>';
                        getAllProjetParAlerte();
                    ?>
                </div>
            </body>
        </html>
<?php
    }else{
        header('Location: all_alertes.php?message=erreurPage');
    }
?>