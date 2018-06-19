<?php
    function profilUtilisateur(){
        $tabAlerte = array();
        $nbAlerte = array();
        $nbProjet = array();
        $like = '%[' . $_SESSION['Id_utilisateur'] . ']%';
        $profil = $GLOBALS['connexion']->prepare('SELECT alerte.Id_alerte, Nom_alerte, alerte.Statut, Id_projet, Nom_projet, Date_debut, Date_fin 
        FROM alerte, projet WHERE Id_utilisateur LIKE "' . $like . '" AND projet.Id_alerte = alerte.Id_alerte ORDER BY alerte.Id_alerte, alerte.Statut, Date_debut');
        $profil->execute();
        
        if($profil->rowCount() > 0){
            while ($donnees = $profil->fetch()) {
                if(!in_array($donnees['Statut'], $tabAlerte)){
                    array_push($tabAlerte, $donnees['Statut']);
                    
                    echo '<ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="profil.php">Profil</a>
                        </li>
                        <li class="breadcrumb-item active">Projets ';
    
                    if($donnees['Statut'] == 1){
                        echo 'En cours';
                    }else if($donnees['Statut'] == 2){
                        echo 'Terminée';
                    }
                }
    
                echo '</li>
                    </ol>
                    <div class="card mb-3">
                        <div class="card-body">';
    
                if(!in_array($donnees['Id_alerte'], $nbAlerte)){
                    array_push($nbAlerte, $donnees['Id_alerte']);
                    echo '<h6 class="card-title mb-1">Nom de l\'alerte : ' . $donnees['Nom_alerte'] . '</h6>';
                    
                    if(!in_array($donnees['Id_projet'], $nbProjet)){
                        array_push($nbProjet, $donnees['Id_projet']);
                        echo '<p class="card-text small">Nom du projet : ' . $donnees['Nom_projet'] . '</p>';
                        
                        $tacheParProjet = $GLOBALS['connexion']->prepare('SELECT Activite FROM tache WHERE Id_projet = ' . $donnees['Id_projet'] . ' ORDER BY Activite');
                        $tacheParProjet->execute();
    
                        if($tacheParProjet->rowCount() > 0){
                            echo '<span class="card-text small">Tâches :</span><br>';
                        }
    
                        while($tache = $tacheParProjet->fetch()){
                            echo '<span class="card-text small mr-3">- ' . $tache['Activite'] . '</span>';
                        }
                        
                        $tacheParProjet->closeCursor();
                        
                        echo '<p class="card-text small mt-3">Du ' . dateFr($donnees['Date_debut']) . ' au ' . dateFr($donnees['Date_fin']) . '</p>';
                    }
                }
    
                echo '</div>
                    </div>';
            }
    
            $profil->closeCursor();
        }else{
            if(!empty($_SESSION)){
                if($_SESSION['Id_groupe'] == getIdGroupeMissionnaire() || $_SESSION['Id_groupe'] == getIdGroupeNarrateur() || $_SESSION['Id_groupe'] == getIdGroupeVisiteur()){
                    echo '<ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="profil.php">Profil</a>
                    </li>
                    <li class="breadcrumb-item active">Aucun projet</li>';
                }
            }
        }
    }

    function getAllProjetParAlerte(){
        $tabProjet = array();
        $projetParAlerte = $GLOBALS['connexion']->prepare('SELECT Id_projet, Nom_projet, Date_debut, Date_fin, alerte.Id_alerte FROM alerte, projet WHERE alerte.Id_alerte = ' . $_GET['idAlerte'] . ' AND projet.Statut = 1 AND alerte.Id_alerte = projet.Id_alerte ORDER BY Date_debut DESC');
        
        if($projetParAlerte->execute() && $projetParAlerte->rowCount() > 0){
            while ($donnees = $projetParAlerte->fetch()) {
                $tabProjet = voirProjets($tabProjet, $donnees['Id_projet'], $donnees['Id_alerte'], $donnees['Nom_projet'], $donnees['Date_debut'], $donnees['Date_fin']);
            }

            $projetParAlerte->closeCursor();
            
        }else if($_SESSION['Id_groupe'] != getIdGroupeComite()){
            $projetParAlerte->closeCursor();
            echo '<script language="Javascript">
                    document.location.replace("all_alertes.php?message=erreurProjet_' . $_GET['idAlerte'] . '#alerte' . $_GET['idAlerte'] . '");
            </script>';
        }
    }

    function getAllTacheParProjet($idProjet){
        $tacheParProjet = $GLOBALS['connexion']->prepare('SELECT Activite, Realisation, Date_debut, Date_fin FROM tache WHERE Id_projet = ' . $idProjet . ' ORDER BY tache.Date_debut DESC');
        $texteTache = '';

        if($tacheParProjet->execute() && $tacheParProjet->rowCount() > 0){
            while ($donnees = $tacheParProjet->fetch()) {
                $texteTache .= '<p class="card-text small">Tâche : ' . $donnees['Activite'] . '
                <br>Avancement : ' . $donnees['Realisation'] . '
                <br>Délais : Du ' . dateFr($donnees['Date_debut']) . ' au ' . dateFr($donnees['Date_fin']) . '</p>';
            }

            $tacheParProjet->closeCursor();
            
        }else if($_SESSION['Id_groupe'] != getIdGroupeComite()){
            $tacheParProjet->closeCursor();
            echo '<script language="Javascript">
                    document.location.replace("all_alertes.php?message=erreurProjet_' . $_GET['idAlerte'] . '#alerte' . $_GET['idAlerte'] . '");
            </script>';
        }

        return $texteTache;
    }
?>