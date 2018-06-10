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
                        <label for="dateDebutProjet">Date de début</label>
                        <input style="background-color: white;" class="form-control" type="text" name="dateDebutProjet" id="dateDebutProjet" value="<?php echo isset($_GET['dateDebutProjet']) ? $_GET['dateDebutProjet'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                    </div>
                    <div class="form-group">
                        <label for="dateFinProjet">Date de fin</label>
                        <input style="background-color: white;" class="form-control" type="text" name="dateFinProjet" id="dateFinProjet" value="<?php echo isset($_GET['dateFinProjet']) ? $_GET['dateFinProjet'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                    </div>
                    <div class="form-group">
                        <label for="activite">Activité</label>
                        <select class="form-control" name="activite">
                            <?php selectTache(); ?>
                        </select>
                    </div>

                    <input type="hidden" name="idAlerte" value="<?php echo isset($_GET['idAlerte']) ? $_GET['idAlerte'] : ''; ?>">
                    <input type="hidden" name="idEspece" value="<?php echo isset($_GET['idEspece']) ? $_GET['idEspece'] : ''; ?>">
                    
                    <button class="btn btn-primary btn-block" type="submit" name="creerProjet">Créer un projet</button>
                    <!-- <a class="btn btn-secondary btn-block text-white" data-toggle="modal" data-target="#ajouterTache">Créer une nouvelle tâche</a> -->
                </form>
            </div>
        </div>

        <!-- Modal ajouter tâche -->
        <div class="modal fade" id="ajouterTache" tabindex="-1" role="dialog" aria-labelledby="ajouterTacheLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modal" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajouterTacheLabel">Ajout d'une tâche</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <?php
                            if(isset($_GET['message'])){
                                $script = '<script src="js/modal.js"></script>';

                                switch($_GET['message']){
                                    case 'erreurTache':
                                        messageBox('danger', 'La tâche n\'a pas été ajouté.');
                                        echo $script;
                                        break;
                                    case 'existeTache':
                                        messageBox('warning', 'Cette tâche à déjà été affectée');
                                        echo $script;
                                        break;
                                    default:
                                        break;
                                } 
                            }
                        ?>
                        <form id="form" action="includes/fonctions/fonction_creation.php" method="post">
                            <div class="form-group">
                                <label for="choixTache">Que voulez vous faire ?</label>
                                <div class="row" style="margin: auto;">
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" id="choixTache1" name="choixTache" checked>
                                        <label class="form-check-label" for="choixTache1">Ajouter une tâche</label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="form-check-input" id="choixTache2" name="choixTache">
                                        <label class="form-check-label" for="choixTache2">Créer une tâche</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="selectActiviteDiv">
                                <select class="form-control" name="selectActivite" id="selectActivite">
                                    <?php selectTache(); ?>
                                </select>
                            </div>
                            <div class="form-group d-none" id="nouvelleActiviteDiv">
                                <input class="form-control" type="text" name="nouvelleActivite" id="nouvelleActivite" maxlength="30" value="<?php echo isset($_GET['nouvelleActivite']) ? $_GET['nouvelleActivite'] : ''; ?>" disabled placeholder="Entrer un nom d'une activité"/>
                            </div>
                            <div class="form-group">
                                <label for="dateDebutTache">Date de début</label>
                                <input style="background-color: white;" class="form-control" type="text" name="dateDebutTache" id="dateDebutTache" value="<?php echo isset($_GET['dateDebutTache']) ? $_GET['dateDebutTache'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                            </div>
                            <div class="form-group">
                                <label for="dateFinTache">Date de fin</label>
                                <input style="background-color: white;" class="form-control" type="text" name="dateFinTache" id="dateFinTache" value="<?php echo isset($_GET['dateFinTache']) ? $_GET['dateFinTache'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                            </div>
                            
                            <input type="hidden" name="idAlerte"  value="<?php echo $_GET['idAlerte']; ?>">
                            <input type="hidden" name="idEspece" value="<?php echo $_GET['idEspece']; ?>">
                            <input type="hidden" id="idProjet" name="idProjet" value="<?php echo isset($_GET['idProjet']) ? $_GET['idProjet'] : ''; ?>">

                            <button class="btn btn-primary btn-block" type="submit" name="creerTache">Ajouter</button>
                            <a class="btn btn-secondary btn-block text-white" data-toggle="modal" data-target="#nouvelleTache">Créer une nouvelle tâche</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal nouvelle tâche -->
        <div class="modal fade" id="nouvelleTache" tabindex="-1" role="dialog" aria-labelledby="nouvelleTacheLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modal" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nouvelleTacheLabel">Création d'une nouvelle tâche</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <?php
                            if(isset($_GET['message'])){
                                $script = '<script src="js/modal.js"></script>';

                                switch($_GET['message']){
                                    case 'erreurTache':
                                        messageBox('danger', 'La tâche n\'a pas été ajouté.');
                                        echo $script;
                                        break;
                                    case 'existeTache':
                                        messageBox('warning', 'Cette tâche à déjà été affectée');
                                        echo $script;
                                        break;
                                    default:
                                        break;
                                } 
                            }
                        ?>
                        <form id="form" action="includes/fonctions/fonction_creation.php" method="post">
                            <div class="form-group">
                                <label for="activite">Nom de l'activité</label>
                                <input class="form-control" type="text" name="activite" maxlength="30" value="<?php echo isset($_GET['activite']) ? $_GET['activite'] : ''; ?>" placeholder="Entrer un nom d'une activité" required/>
                            </div>
                            <div class="form-group">
                                <label for="dateDebutTache">Date de début</label>
                                <input style="background-color: white;" class="form-control" type="text" name="dateDebutTache" id="dateDebutTache" value="<?php echo isset($_GET['dateDebutTache']) ? $_GET['dateDebutTache'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                            </div>
                            <div class="form-group">
                                <label for="dateFinTache">Date de fin</label>
                                <input style="background-color: white;" class="form-control" type="text" name="dateFinTache" id="dateFinTache" value="<?php echo isset($_GET['dateFinTache']) ? $_GET['dateFinTache'] : ''; ?>" placeholder="jj/mm/aaaa" required/>
                            </div>
                            
                            <input type="hidden" name="idAlerte"  value="<?php echo $_GET['idAlerte']; ?>">
                            <input type="hidden" name="idEspece" value="<?php echo $_GET['idEspece']; ?>">
                            <input type="hidden" id="idProjet" name="idProjet" value="<?php echo isset($_GET['idProjet']) ? $_GET['idProjet'] : ''; ?>">

                            <button class="btn btn-primary btn-block" type="submit" name="creerTache" retourCreerTache>Créer une tâche</button>
                            <a class="btn btn-default btn-block" id="retourCreerTache">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    function selectTache(){
        $allActivite = DBConnexion()->prepare('SELECT DISTINCT Activite FROM tache ORDER BY Activite');
        $allActivite->execute();

        while($donnees = $allActivite->fetch()){
            echo '<option value="' .  $donnees['Activite'] . '">' . $donnees['Activite'] . '</option>';
        }

        $allActivite->closeCursor();
    }
?>