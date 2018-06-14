<?php
    function inscriptionUtilisateur(){
?>
        <div class="card-header">S'inscrire</div>
        <div class="card-body">
            <form action="includes/fonctions/fonction_creation.php" method="post">
                <div class="form-group">
                    <label for="nomUtilisateurInscription">Nom</label>
                    <input class="form-control" type="text" name="nomUtilisateurInscription" maxlength="30" value="<?php echo isset($_GET['nomUtilisateurInscription']) ? $_GET['nomUtilisateurInscription'] : ''; ?>" placeholder="Entrer votre nom" required autofocus/>
                </div>
                <div class="form-group">
                    <label for="prenomUtilisateurInscription">Prénom</label>
                    <input class="form-control" type="text" name="prenomUtilisateurInscription" maxlength="30" value="<?php echo isset($_GET['prenomUtilisateurInscription']) ? $_GET['prenomUtilisateurInscription'] : ''; ?>" placeholder="Entrer votre prénom" required/>
                </div>
                <div class="form-group">
                    <label for="mdpUtilisateurInscription">Mot de passe</label>
                    <input class="form-control" type="password" name="mdpUtilisateurInscription" maxlength="30" placeholder="Entrer votre mot de passe" required/>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="inscriptionUtilisateur">S'inscrire</button>
            </form>
        </div>
<?php   
    }

    function connexionUtilisateur(){
?>
        <div class="card-header">Se connecter</div>
        <div class="card-body">
            <form action="includes/fonctions/fonction_connexion.php" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input class="form-control" type="text" name="nom" maxlength="30" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : ''; ?>" placeholder="Entrer votre nom" required autofocus/>
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input class="form-control" type="password" name="mdp" maxlength="30" placeholder="Entrer votre mot de passe" required/>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="connexion">Se connecter</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="inscription.php">S'inscrire</a>
            </div>
        </div>
<?php
    }

    function voirProjets($tabProjet, $idProjet, $idAlerte, $nomProjet, $dateDebutProjet, $dateFinProjet){
        $texteTache = getAllTacheParProjet($idProjet);
        
        echo '<div class="card mb-3">
                    <div class="card-body"> ';

        if(!in_array($idProjet, $tabProjet)){
            array_push($tabProjet, $idProjet);
            echo '<h6 class="card-title mb-1">' . $nomProjet . '</h6>
                        ' . $texteTache . '
                    </div>';
                    
            if($_SESSION['Id_groupe'] == getIdGroupeComite()){               

                echo '<hr class="my-0">
                    <div class="card-body py-2 small">
                    <a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?archiverProjet=' . $idProjet . '">Archiver</a>
                    <a href="#" class="mr-3 d-inline-block" data-toggle="modal" onclick="ajouterTache(' . $idProjet . ');" data-target="#ajouterTache">Ajouter une nouvelle tâche</a>
                    </div>';//, etc comme pour alerte avec le différent statut
            }else if($_SESSION['Id_groupe'] == getIdGroupeParrainFinancier()){
                echo '<hr class="my-0">
                    <div class="card-body py-2 small">
                    <a href="#" class="mr-3 d-inline-block" data-toggle="modal" data-target="#don" disabled>Faire un don</a>
                    </div>';
            }

            echo '<div class="card-footer small text-muted">
                <span class="mr-3 d-inline-block">Posté le ' . dateFr($dateDebutProjet) . '</span>
                <span class="mr-3 d-inline-block">Fini le ' . dateFr($dateFinProjet) . '</span>';
        }else{
             echo $texte;
        }

        echo '</div>
        </div>';

        return $tabProjet;
    }
?>