<?php
    function statuerAlerte($idAlerte){
        echo'<a href="includes/fonctions/fonction_validation.php?approuverAlerte=' . $idAlerte . '">V</a>
            <a href="includes/fonctions/fonction_validation.php?archiverAlerte=' . $idAlerte . '">X</a><br>';
    }

    function gestionParticipantProjet($nbParticipant){
        echo'<a href="includes/fonctions/gestions/fonction_gestions_projets.php?nbParticipantProjet=' . $nbParticipant . '">V</a>';
    }

    function nouvellesAlertes(){
?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span>
<?php
                nbNouvellesAlertes();
?>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Nouvelles alertes :</h6>
<?php
                voirNouvellesAlertes();                   
?>
                <a class="dropdown-item small" href="all_alertes.php">Voir toutes les alertes</a>
            </div>
            </li>
<?php
    }

    function nouvellesCandidatures(){
?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-envelope"></i>
              <span>
<?php
                nbNouvellesCandidatures();
?>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">Nouvelles candidatures :</h6>
<?php
                voirNouvellesCandidatures();                   
?>
              <a class="dropdown-item small" href="candidatures.php">Voir les candidatures</a>
            </div>
          </li>
<?php
    }

    function creerProjet(){
?>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Création d'un projet</div>
            <div class="card-body">
                <form id="form" action="includes/fonctions/fonction_creation.php" method="post">
                    <div class="form-group">
                        <label for="nomProjet">Nom du projet</label>
                        <input class="form-control" type="text" name="nomProjet" maxlength="30" value="<?php echo isset($_GET['nomProjet']) ? $_GET['nomProjet'] : ''; ?>" placeholder="Entrer un nom de projet" required/>
                    </div>
                    <div class="form-group">
                        <label for="dateDebut">Date de début</label>
                        <input class="form-control" type="text" name="dateDebut" id="dateDebut" value="<?php echo isset($_GET['dateDebut']) ? $_GET['dateDebut'] : ''; ?>" placeholder="mm/jj/aaaa" required/>
                    </div>
                    <div class="form-group">
                        <label for="dateFin">Date de fin</label>
                        <input class="form-control" type="text" name="dateFin" id="dateFin" value="<?php echo isset($_GET['dateFin']) ? $_GET['dateFin'] : ''; ?>" placeholder="mm/jj/aaaa" required/>
                    </div>
                    <div class="form-group">
                        <label for="activite">Activité</label>
                        <select class="form-control" name="activite">
                            <?php selectTache(); ?>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary btn-block" type="submit" name="creerProjet">Créer un projet</button>
                    <a class="btn btn-secondary btn-block text-white" data-toggle="modal" data-target="#nouvelleTache">Créer une nouvelle tâche</a>
                </form>
            </div>
        </div>

        <!-- Modal nouvelle espèce -->
        <div class="modal fade" id="nouvelleTache" tabindex="-1" role="dialog" aria-labelledby="nouvelleTacheLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modal" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nouvelleTacheLabel">Création d'un nouvelle tâche</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <?php
                            if(isset($_GET['message'])){
                                if($_GET['message'] == 'erreurTache'){
                                    messageBox('danger', 'La tâche n\'a pas été créée.');
                                    echo '<script src="js/modal.js"></script>';
                                }
                            }
                        ?>
                        <form id="form" action="includes/fonctions/fonction_creation.php" method="post">
                            <div class="form-group">
                                <label for="activite">Nom de l'activité</label>
                                <input class="form-control" type="text" name="activite" maxlength="30" value="<?php echo isset($_GET['activite']) ? $_GET['activite'] : ''; ?>" placeholder="Entrer un nom d'une activité" required/>
                            </div>
                            
                            <button class="btn btn-primary btn-block" type="submit" name="creerTache">Créer une tâche</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    function selectTache(){
        $allActivite = DBConnexion()->prepare('SELECT Activite FROM tache ORDER BY Activite');
        $allActivite->execute();

        while($donnees = $allActivite->fetch()){
            echo '<option value="' .  $donnees['Activite'] . '">' . $donnees['Activite'] . '</option>';
        }

        $allActivite->closeCursor();
    }
?>