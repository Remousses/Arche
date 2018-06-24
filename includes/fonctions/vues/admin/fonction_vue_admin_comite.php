<?php
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
              <a class="dropdown-item small" href="candidatures.php">Voir toutes les candidatures</a>
            </div>
          </li>
<?php
    }

    function getCandidatures(){
        $candidatures = $GLOBALS['connexion']->prepare('SELECT Informations_candidater, Role, Date_candidater, alerte.Id_alerte, Nom_alerte, utilisateur.Id_utilisateur, Nom_utilisateur, Prenom_utilisateur FROM candidater_alerte, utilisateur, alerte WHERE candidater_alerte.Statut = 0 AND candidater_alerte.Id_utilisateur = utilisateur.Id_utilisateur AND candidater_alerte.Id_alerte = alerte.Id_alerte ORDER BY Date_candidater DESC');
        $candidatures->execute();
?>      <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Alerte</th>
                <th>Informations</th>
                <th>Date</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $candidatures->fetch()){
            echo '<tr>
                    <td class="vertical_align">' . $donnees['Nom_utilisateur'] . '</td>
                    <td class="vertical_align">' . $donnees['Prenom_utilisateur'] . '</td>	
                    <td class="vertical_align">' . $donnees['Nom_alerte'] . '</td>
                    <td class="vertical_align">' . $donnees['Informations_candidater'] . '</td>
                    <td class="vertical_align">' . dateFr($donnees['Date_candidater']) . '</td>
                    <td class="vertical_align">';

                    if($donnees['Role'] == 'Participer physiquement'){
                        echo '<img src="images/icons/users-workers.png" alt="' . $donnees['Role'] . '" height=15>';
                    }else if($donnees['Role'] == 'Participer financièrement'){
                        echo '<i class="fa fa-euro"></i>';
                    }else{
                        echo '<i class="fa fa-warning"></i>';
                    }
                    
                    echo '</td>
                    <td class="vertical_align"><a href="includes/fonctions/fonction_validation.php?idAlerte=' . $donnees['Id_alerte'] . '&role=' . $donnees['Role'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&approuverCandidature="><i class="fa fa-check"></i></a></td>
                    <td class="vertical_align"><a href="includes/fonctions/fonction_validation.php?idAlerte=' . $donnees['Id_alerte'] . '&role=' . $donnees['Role'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&archiverCandidature="><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $candidatures->closeCursor();        
        echo '</tbody>';
    }

    function creerProjet(){
?>
        <div class="card card-login mx-auto mt-5 mb-5">
            <div class="card-header">Création d'un projet</div>
            <div class="card-body">
                <form action="includes/fonctions/fonction_creation.php" method="post">
                    <div class="form-group">
                        <label class="col-12" for="nomProjet">Nom du projet <span class="small float-right text-muted" id="nomProjetTailleMax"></span></label>
                        <input class="form-control" type="text" name="nomProjet" onkeypress="tailleInput('nomProjet', event);" maxlength="100" value="<?php echo isset($_GET['nomProjet']) ? $_GET['nomProjet'] : ''; ?>" placeholder="Entrer un nom de projet" required/>
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
                </form>
            </div>
        </div>

        <!-- Modal ajouter tâche -->
        <div class="modal fade" id="ajouterTache" tabindex="-1" role="dialog" aria-labelledby="ajouterTacheLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div id="modalAjouterTache" class="modal-content">
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
                                    case 'erreurDateTache':
                                        messageBox('danger', 'La date de la tâche n\'est pas valide');
                                        echo $script;
                                        break;
                                    case 'existeTache':
                                        messageBox('warning', 'Cette tâche à déjà été affectée pour ce projet.');
                                        echo $script;
                                        break;
                                    default:
                                        break;
                                } 
                            }
                        ?>
                        <form action="includes/fonctions/fonction_creation.php" method="post">
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
                                <span class="small float-right text-muted" id="nouvelleActiviteTailleMax">
                                <input class="form-control" type="text" name="nouvelleActivite" id="nouvelleActivite" onkeypress="tailleInput('nouvelleActivite', event);" maxlength="100" value="<?php echo isset($_GET['nouvelleActivite']) ? $_GET['nouvelleActivite'] : ''; ?>" disabled placeholder="Entrer un nom d'une activité"/>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

    function selectTache(){
        $allActivite = $GLOBALS['connexion']->prepare('SELECT DISTINCT Activite FROM tache ORDER BY Activite');
        $allActivite->execute();

        while($donnees = $allActivite->fetch()){
            echo '<option value="' .  $donnees['Activite'] . '">' . $donnees['Activite'] . '</option>';
        }

        $allActivite->closeCursor();
    }
?>