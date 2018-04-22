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

    function voirAlertes($tabAlerte, $statut, $idAlerte, $nomAlerte, $informations, $nomEspece, $idEspece, $photo, $date, $texte){
        if($statut != ''){
            if(!in_array($statut, $tabAlerte)){
                array_push($tabAlerte, $statut);
                echo '<ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="all_alertes.php">Alertes</a>
                    </li>';

                if($statut == 'Attente'){
                    echo '<li class="breadcrumb-item active">Alertes en attente de validation';
                }else if($statut == 'Approuvée'){
                    echo '<li class="breadcrumb-item active">Alertes approuvées';
                }

                echo '</li>
                    </ol>';
            }
        }
        
        echo '<div class="card mb-3" id="alerte' . $idAlerte . '">
            <a href="' . (empty($_SESSION) ? 'connexion.php' : 'voir_projets.php?idAlerte=' . $idAlerte . '&idEspece=' . $idEspece) . '">
                <div class="center"><img src="images/especes/' . $photo .'" alt="' . $nomEspece . '" heigth="40%" width="40%"/></div> <br>
            </a>
            <div class="card-body">';
            if(isset($_GET['message'])){
                if($_GET['message'] == 'erreurProjet_' . $idAlerte){
                    messageBox('danger', 'Cette alerte n\'a pas de projets en cours. Vous avez été redirigez vers la page des alertes.');
                }
            }
                echo '<h6 class="card-title mb-1"><a href="' . (empty($_SESSION) ? 'connexion.php' : 'voir_projets.php?idAlerte=' . $idAlerte . '&idEspece=' . $idEspece) . '">' . $nomAlerte . '</a></h6>
                <p class="card-text small">' . $informations .'</p>
            </div>
            <hr class="my-0">
            <div class="card-body py-2 small">
            ' . $texte .'
            </div>
            <div class="card-footer small text-muted">Postée le ' . dateFr($date) . '</div>
        </div>';

        return $tabAlerte;
    }

    function modalCandidater($idAlerte, $idEspece){
?>
        <div class="modal fade" id="candidater" tabindex="-1" role="dialog" aria-labelledby="candidaterLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="candidaterLabel">Candidature</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form action="includes/fonctions/fonction_creation.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="informationsCandidater">Pourquoi vous intéressez-vous à cette alerte ?</label>
                                <textarea class="form-control" type="text" name="informationsCandidater" col="30" row ="6" maxlength="1000" placeholder="Votre texte" required></textarea>
                            </div>
                            
                            <input type="hidden" id="idAlerteCandidater" name="idAlerteCandidater">
                            <input type="hidden" id="idEspeceCandidater" name="idEspeceCandidater">                            
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-primary" type="submit" name="candidaterAlerte">Candidater</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }

    function voirProjets($nbProjet, $idProjet, $idAlerte, $nomProjet, $dateDebutProjet, $dateFinProjet, $activite, $realisation, $dateDebutTache, $dateFinTache){
        $texte = '<p class="card-text small">Tâche : ' . $activite . ' réalisé par ......... à définir ' . $realisation . '</p>
        <p class="card-text small">Du ' . $dateDebutTache . ' au ' . $dateFinTache . '</p>';
        
        echo '<div class="card mb-3">
                    <div class="card-body"> ';

        if(!in_array($idProjet, $nbProjet)){
            array_push($nbProjet, $idProjet);
                    echo '<h6 class="card-title mb-1"><a class="mr-3 d-inline-block" data-toggle="modal" data-target="#participationAlerte">' . $nomProjet . '</a></h6>
                        ' . $texte . '
                    </div>
                    <hr class="my-0">
                <div class="card-body py-2 small">
                    <a class="mr-3 d-inline-block" data-toggle="modal" data-target="#don" disabled>Faire un don</a>';

            if($_SESSION['Id_groupe'] == getIdGroupeComite()){               

                echo '<a class="mr-3 d-inline-block" href="#">Archiver, etc comme pour alerte avec le différent statut</a>';
            }

            echo '</div>
                    <div class="card-footer small text-muted">
                        <span class="mr-3 d-inline-block">Posté le ' . $dateDebutProjet . '</span>
                        <span class="mr-3 d-inline-block">Fini le ' . $dateFinProjet . '</span>';
        }else{
             echo $texte;
        }

        echo '</div>
        </div>';

        return $nbProjet;
    }

    function infoProjet($tabAlerte, $nbAlerte, $nbProjet, $idAlerte, $nomAlerte, $idProjet, $nomProjet, $dateDebut, $dateFin, $statut){
        if(!in_array($statut, $tabAlerte)){
            array_push($tabAlerte, $statut);
            var_dump($tabAlerte);
            echo '<ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="profil.php">Profil</a>
            </li>
            <li class="breadcrumb-item active">Projets ';

            if($statut == 1){
                echo 'En cours';
            }else if($statut == 2){
                echo 'Terminée';
            }
        }

        echo '</li>
            </ol>
            <div class="card mb-3"">
                <div class="card-body">';

        if(!in_array($idAlerte, $nbAlerte)){
            array_push($nbAlerte, $idAlerte);
            echo '<h6 class="card-title mb-1">Nom de l\'alerte : ' . $nomAlerte . '</h6>';
            
            if(!in_array($idProjet, $nbProjet)){
                array_push($nbProjet, $idProjet);
                echo '<p class="card-text small">Nom du projet : ' . $nomProjet . '</p>
                    <p class="card-text small">Du ' . $dateDebut . ' au ' . $dateFin . '</p>';
            }
        }

        echo '</div>
            </div>';
    }
?>