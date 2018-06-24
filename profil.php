<?php
    session_start();
    
    if(isset($_SESSION['Id_groupe'])){
?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <?php
                    require_once 'includes/head.php';
                    verificationIdGroupe('profil.php'); 
                ?>
            </head>
            
            <body class="fixed-nav sticky-footer bg-dark" id="page-top">
                <?php 
                    require_once 'includes/menu.php';
                ?>
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <?php
                            if(isset($_GET['message'])){
                                message();
                            }
                        ?>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                        
                        <?php
                            profilUtilisateur();
                        ?>
                    </div>
                    <?php
                        require_once 'includes/footer.php';
                    ?>
                </div>
            </body>
        </html>
<?php
    }else{
        header('Location: index.php?message=erreurPage');
    }
?>