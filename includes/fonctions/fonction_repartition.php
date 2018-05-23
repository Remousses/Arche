<?php
    require_once 'connexionDB.php';
    require_once '../../param/infos_id_groupe.php';

    if(isset($_GET['idAlerte']) && isset($_GET['nbProjet']) && isset($_GET['nbParticipant'])){
        $max = 3;
        $idAlerte = $_GET['idAlerte'];
        $repartition = $_GET['nbParticipant'] / $_GET['nbProjet'];
        
        if($repartition >= $max){
            $connexion = DBConnexion();
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
            
            $projets = $connexion->prepare('SELECT Id_projet FROM projet WHERE Id_alerte = ' . $idAlerte);
            
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
        echo '<br>sizeof($tabProjet) : ' . sizeof($tabProjet);
            echo 'sizeof($tabCandidat)) : ' . sizeof($tabCandidat);
        var_dump($tabProjet);
        var_dump($tabCandidat);
            for ($idProjet = 1, $cad = 0; $cad < sizeof($tabCandidat); $idProjet++, $cad++) {
                $idUtilisateur = $tabCandidat[$cad];
                echo '<br>$tabCandidat[$cad] : ' . $tabCandidat[$cad];
    echo '<br>$idProjet : ' . $idProjet;
                if(sizeof($tabProjet) == 1){
                    if($idProjet == 1){
                        ajoutNarrateur($connexion, $idUtilisateur);
                    }
                }else if($idProjet % sizeof($tabProjet) == 0){
                    $idProjet = 0;
                    ajoutNarrateur($connexion, $idUtilisateur);
                }
    
                if(sizeof($tabProjet) == 1){
                    echo 'if';
                    $id = $tabProjet[0];
                }else if($idProjet == 0){
                    echo 'else if';
                    $id = $tabProjet[sizeof($tabProjet) - 1];
                }else{
                    echo 'else';
                    $id = $tabProjet[$idProjet - 1];
                }
                echo '<br>id : ' . $id . '<br>';
                
                $projet = $connexion->prepare('UPDATE projet SET Id_utilisateur = CONCAT(Id_utilisateur, "|' . $idUtilisateur . '| ") WHERE Id_projet = ' . $id);
                $majCandidature = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_utilisateur = ' . $idUtilisateur . ' AND Role = "Participer physiquement" AND Id_alerte = ' . $idAlerte);
                var_dump($projet);
                var_dump($majCandidature);
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

    function ajoutNarrateur($connexion, $idUtilisateur){
        $narrateur = DBConnexion()->prepare('UPDATE utilisateur SET Id_groupe = ' . getIdGroupeNarrateur() . ' WHERE Id_utilisateur = ' . $idUtilisateur);
        $narrateur->execute();
        $narrateur->closeCursor();
        echo 'ok';
        if($_SESSION['Id_utilisateur'] == $idUtilisateur){
            $_SESSION['Id_groupe'] = getIdGroupeNarrateur();
        }
    }
?>