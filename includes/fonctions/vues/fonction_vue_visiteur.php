<?php
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
        
        echo '<div class="card mb-3 pt-3" id="alerte' . $idAlerte . '">
            <a href="' . (empty($_SESSION) ? 'connexion.php' : 'voir_projets.php?nomAlerte=' . $nomAlerte . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece) . '">
                <div class="text-center"><img class="image_alerte" src="images/especes/' . $photo .'" alt="' . $nomEspece . '"/></div> <br>
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
                    messageBox('success', 'La répartition a été effectuée.');
                    break;
                case 'erreurRepartition_' . $idAlerte:
                    messageBox('danger', 'La répartition n\'a pas été effectuée.');
                    break;
            }
        }

        echo '<h6 class="card-title mb-1"><a href="' . (empty($_SESSION) ? 'connexion.php' : 'voir_projets.php?nomAlerte=' . $nomAlerte . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece) . '">' . $nomAlerte . '</a></h6>
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
                                <label class="col-12" for="informationsCandidater">Pourquoi vous intéressez-vous à cette alerte ? <span class="small float-right text-muted" id="informationsCandidaterTailleMax"></span></label>
                                <textarea class="form-control" type="text" name="informationsCandidater" onkeypress="tailleTextarea('informationsCandidater', event);" col="30" row ="6" maxlength="1000" placeholder="Votre texte" required><?php echo isset($_GET['informationsCandidater']) ? $_GET['informationsCandidater'] : ''; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="role">Rôle</label>
                                <div class="row" style="margin: auto;">
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" id="ParticiperPhysiquement" value="Participer physiquement" checked>
                                        <label class="form-check-label" for="ParticiperPhysiquement">Participer physiquement</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" name="roleCandidater" id="ParticiperFinancierement" value="Participer financièrement">
                                        <label class="form-check-label" for="ParticiperFinancierement">Participer financièrement</label>
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
?>