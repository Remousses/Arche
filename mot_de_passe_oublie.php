<?php
    session_start();
    
	if(isset($_SESSION['Id_groupe'])){
?>
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <?php
                    require_once 'includes/head.php';
                    verificationIdGroupe('mot_de_passe_oublie.php');
                ?>
            </head>
            
            <body class="bg-dark">
                <div class="container">
                    <div class="card card-login mx-auto mt-5">
                        <?php
                            if(isset($_GET['message'])){
                                message();
                            }
                        ?>
                        <div class="card-header">Modifier votre mot de passe</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <span class="small float-right text-muted" id="mdpOublieEmailTailleMax"></span>
                                    <input class="form-control" name="mdpOublieEmail" onkeypress="tailleInput('mdpOublieEmail', event);" type="email" placeholder="Entrer votre email"/>
                                </div>
                                <a class="btn btn-primary btn-block" type="submit">Modifier</a>
                            </form>
                        </div>
                    </div>
                </div>
            </body>
        </html>
<?php
    }else{
        header('Location: index.php?message=erreurPageMdpOublie');
    }
?>