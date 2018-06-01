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
                <div class="center"><img class="image_alerte" src="images/especes/' . $photo .'" alt="' . $nomEspece . '"/></div> <br>
            </a>
            <div class="card-body">';
            
        if(isset($_GET['message'])){
            switch ($_GET['message']){
                case 'erreurProjet_' . $idAlerte :
                    messageBox('danger', 'Cette alerte n\'a pas de projets en cours. Vous avez été redirigez vers la page des alertes.');
                    break;
                case 'succesCandidature_' . $idAlerte:
                    messageBox('success', 'Votre demande de candidature va être prise en compte.');
                    break;
                case 'erreurCandidature_' . $idAlerte:
                    messageBox('danger', 'Erreur lors de la demande de candidature.');
                    break;
                case 'existeCandidature_' . $idAlerte:
                    messageBox('warning', 'Vous avez déjà candidater à cette alerte.');
                    break;
                case 'succesRepartition_' . $idAlerte:
                    messageBox('success', 'La répartition a été effectuée. L\'alerte va être supprimée');

                    if(isset($_GET['archiverAlerte'])){
                        echo  $_GET['archiverAlerte'] == true ? archiverAlerte($idAlerte) : '';
                    }

                    break;
                case 'erreurRepartition_' . $idAlerte:
                    messageBox('danger', 'La répartition n\'a pas été effectuée.');
                    break;
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

                            <div class="form-group">
                                <label for="">Rôle</label>
                                <div class="row" style="margin: auto;">
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" value="Participer physiquement" checked>
                                        <label class="form-check-label" for="Participer physiquement">Participer physiquement</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" value="Participer financièrement">
                                        <label class="form-check-label" for="Participer financièrement">Participer financièrement</label>
                                    </div>
                                </div>
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
        $texte = '<p class="card-text small">Tâche : ' . $activite . '
        <br>Avancement : ' . $realisation . '
        <br>Délais : Du ' . dateFr($dateDebutTache) . ' au ' . dateFr($dateFinTache) . '</p>';
        
        echo '<div class="card mb-3">
                    <div class="card-body"> ';

        if(!in_array($idProjet, $nbProjet)){
            array_push($nbProjet, $idProjet);
            echo '<h6 class="card-title mb-1">' . $nomProjet . '</h6>
                        ' . $texte . '
                    </div>';

            if($_SESSION['Id_groupe'] == getIdGroupeComite()){               

                echo '<hr class="my-0">
                    <div class="card-body py-2 small">
                    <a class="mr-3 d-inline-block" href="#">Archiver</a>
                    <a href="#" class="mr-3 d-inline-block" data-toggle="modal" data-target="#ajouterTache">Ajouter une nouvelle tâche</a>
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

        return $nbProjet;
    }
?>