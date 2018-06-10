<?php
	session_start();
    if(isset($_SESSION['Id_groupe'])){
?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <?php require_once 'includes/head.php'; ?>
            </head>
            
            <body class="fixed-nav sticky-footer bg-dark" id="page-top">
                <?php 
                    require_once 'includes/menu.php';
                ?>
            
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="./">Accueil</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="profil.php">Profil</a>
                            </li>
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