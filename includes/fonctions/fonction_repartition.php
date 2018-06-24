<?php
    require_once 'connexionDB.php';
    require_once '../../param/infos_id_groupe.php';

    $connexion = connexionDB();

    if(isset($_GET['idAlerte']) && isset($_GET['nbProjet']) && isset($_GET['nbParticipant'])){
        $idAlerte = $_GET['idAlerte'];
        $repartition = $_GET['nbParticipant'] / $_GET['nbProjet'];
        
        if($repartition >= 1){
            $candidats = $connexion->prepare('SELECT Id_utilisateur FROM candidater_alerte WHERE Role = "Participer physiquement" And Statut = 1 AND Id_alerte = ' . $idAlerte);
            $tab = array();
    
            if($candidats->execute() && $candidats->rowCount() > 0){
                while($donnees = $candidats->fetch()){
                    array_push($tab, $donnees['Id_utilisateur']);
                }
            }
    
            $candidats->closeCursor();
            
            // Nombre de valeurs à obtenir dans le tableau final
            define('NB_VALUES', 10 * $_GET['nbProjet']);
            // On mélange le tableau précédent, aléatoirement
            shuffle($tab);
            // On ne récupère que les NB_VALUES premières valeurs du tableau précédent
            $tabCandidat = array_slice($tab, 0, NB_VALUES);
            
            $projets = $connexion->prepare('SELECT Id_projet FROM projet WHERE Id_alerte = ' . $idAlerte . ' AND Statut = 1');
            
            if($projets->execute() && $projets->rowCount() > 0){
                $tabProjet = array();
    
                while($donnees = $projets->fetch()){
                    array_push($tabProjet, $donnees['Id_projet']);
                }

                $projets->closeCursor();

            }else{
                $projets->closeCursor();
                header('Location: ../../all_alertes.php?message=erreurRepartition_' . $idAlerte . '#alerte' . $idAlerte);
            }

            for($id = 0; $id < sizeof($tabProjet); $id++){
                $concat = '[' . $tabCandidat[$id] . '] ';
                $projet = $connexion->prepare('UPDATE projet SET Id_utilisateur = CONCAT(Id_utilisateur, "'. $concat . '") WHERE Id_projet = ' . $tabProjet[$id]);
                $majNarrateur = $connexion->prepare('UPDATE utilisateur SET Id_groupe = ' . getIdGroupeNarrateur() . ' WHERE Id_utilisateur = ' . $tabCandidat[$id]);
                $majCandidature = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_utilisateur = ' . $tabCandidat[$id] . ' AND Role = "Participer physiquement" AND Id_alerte = ' . $idAlerte);
                
                if($projet->execute() && $projet->rowCount() > 0 && $majNarrateur->execute() && $majNarrateur->rowCount() > 0 
                    && $majCandidature->execute() && $majCandidature->rowCount() > 0){
                    $projet->closeCursor();
                    $majNarrateur->closeCursor();
                    $projet->closeCursor();
                    unset($tabCandidat[$id]);
                }else{
                    $projet->closeCursor();
                    $majNarrateur->closeCursor();
                    $projet->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurRepartition_' . $idAlerte . '#alerte' . $idAlerte);
                }
            }

            for ($idProjet = 0, $idCad = 0; $idCad < sizeof($tabCandidat); $idProjet++, $idCad++) {
                $idUtilisateur = $tabCandidat[sizeof($tabProjet) + $idCad];
                $concat = '[' . $tabCandidat[sizeof($tabProjet) + $idCad] . '] ';

                if($idProjet % sizeof($tabProjet) == 0){
                    $idProjet = 0;
                }
                
                $projet = $connexion->prepare('UPDATE projet SET Id_utilisateur = CONCAT(Id_utilisateur, "'. $concat . '") WHERE Id_projet = ' . $tabProjet[$idProjet]);
                $majCandidature = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_utilisateur = ' . $idUtilisateur . ' AND Role = "Participer physiquement" AND Id_alerte = ' . $idAlerte);
 
                if($projet->execute() && $projet->rowCount() > 0 && $majCandidature->execute() && $majCandidature->rowCount() > 0){
                    $majCandidature->closeCursor();
                    $projet->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesRepartition_' . $idAlerte . '#alerte' . $idAlerte);
                }else{
                    $majCandidature->closeCursor();
                    $projet->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurRepartition_' . $idAlerte . '#alerte' . $idAlerte);
               }
            }
        }else{
            header('Location: ../../all_alertes.php?message=erreurRepartition_' . $idAlerte . '#alerte' . $idAlerte);
        }
    }else{
        header('Location: ../../index.php?message=erreurPage');
    }

    $connexion = null;
?>