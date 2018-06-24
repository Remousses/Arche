<?php
    session_start();
    require_once 'connexionDB.php';
    require_once 'fonction_diverses.php';
    require_once '../../param/infos_id_groupe.php';
    
    if(strpos($_SERVER['PHP_SELF'], 'fonction_validation.php') !== false && isset($_SESSION['Id_groupe'])){
        if($_SESSION['Id_groupe'] == getIdGroupeComite()){
            $connexion = connexionDB();
            if(!empty($_GET['approuverAlerte']) && intval($_GET['approuverAlerte']) != 0){
                $approuver = $connexion->prepare('UPDATE alerte SET Statut = 1 WHERE Id_alerte = ' . $_GET['approuverAlerte']);
                
                if($approuver->execute() && $approuver->rowCount() > 0){
                    $approuver->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesApprouverAlerte');
                }else{
                    $approuver->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurApprouverAlerte');
                }
            }else if(isset($_GET['approuverCandidature']) && isset($_GET['role']) && !empty($_GET['idAlerte']) && intval($_GET['idAlerte']) > 0 && !empty($_GET['idUtilisateur']) && intval($_GET['idUtilisateur']) > 0){
                $approuver = $connexion->prepare('UPDATE candidater_alerte SET Statut = 1 WHERE Id_alerte = ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur'] . ' AND Statut BETWEEN 0 AND 1');
                $idGroupe = null;

                if($_GET['role'] == 'Participer physiquement'){
                    $idGroupe = getIdGroupeMissionnaire();
                }else if($_GET['role'] == 'Participer financièrement'){
                    $idGroupe = getIdGroupeParrainFinancier();
                }

                $missionnaire = $connexion->prepare('UPDATE utilisateur SET Id_groupe = ' . $idGroupe . ' WHERE Id_utilisateur = ' . $_GET['idUtilisateur']);
                $archiverCandidatures = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte != ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur']);
                
                if($approuver->execute() && $approuver->rowCount() > 0 && $missionnaire->execute() && $missionnaire->rowCount() > 0 
                    && $archiverCandidatures->execute() && $archiverCandidatures->rowCount() >= 0){
                    $archiverCandidatures->closeCursor();
                    $missionnaire->closeCursor();
                    $approuver->closeCursor();
                    header('Location: ../../candidatures.php?message=succesApprouverCandidature');
                }else{
                    $archiverCandidatures->closeCursor();
                    $missionnaire->closeCursor();
                    $approuver->closeCursor();
                    header('Location: ../../candidatures.php?message=erreurApprouverCandidature');
                }
            }else if(!empty($_GET['archiverAlerte']) && intval($_GET['archiverAlerte']) > 0){
                $rechercheProjet = $connexion->prepare('SELECT Nom_projet FROM projet WHERE Id_alerte = ' . $_GET['archiverAlerte']);
                
                if($rechercheProjet->execute() && $rechercheProjet->rowCount() > 0){
                    $archiverProjet = $connexion->prepare('UPDATE projet SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte']);
                    $archiverProjet->execute();
                    $archiverProjet->closeCursor();
                }

                $rechercheProjet->closeCursor();
                $archiverAlerte = $connexion->prepare('UPDATE alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte']);
                $archiverCandidatures = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte']);

                if($archiverAlerte->execute() && $archiverAlerte->rowCount() > 0 && $archiverCandidatures->execute() && $archiverCandidatures->rowCount() >= 0){
                    $archiverAlerte->closeCursor();

                    $utilisateur = $connexion->prepare('SELECT Id_utilisateur FROM candidater_alerte WHERE Id_alerte = 1');
                    $utilisateur->execute();
                    
					while ($donnees = $utilisateur->fetch()){
						$retourVisiteur = $connexion->prepare('UPDATE utilisateur SET Id_groupe = 1 WHERE Id_utilisateur = ' . $donnees['Id_utilisateur']);
						$retourVisiteur->execute();
						$retourVisiteur->closeCursor();
					}

					$utilisateur->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesArchiverAlerte');
                }else{
                    $archiverAlerte->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurArchiverAlerte');
                }
            }else if(!empty($_GET['archiverProjet']) && intval($_GET['archiverProjet']) > 0){                
                $archiverProjet = $connexion->prepare('UPDATE projet SET Statut = 2 WHERE Id_projet = ' . $_GET['archiverProjet']);
                $rechercheUtilisateurParProjet = $connexion->prepare('SELECT Id_utilisateur FROM projet WHERE Id_projet = ' . $_GET['archiverProjet']);
                $rechercheUtilisateurParProjet->execute();
                $donnees = $rechercheUtilisateurParProjet->fetch();
                preg_match_all('#[0-9]+#', $donnees['Id_utilisateur'], $extraction);

                foreach($extraction[0] as $idUtilisateur){
                    $archiverCandidature = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte'] . ' AND Id_utilisateur = ' . $idUtilisateur);
                    $retourVisiteur = $connexion->prepare('UPDATE utilisateur SET Id_groupe = 1 WHERE Id_utilisateur = ' . $idUtilisateur);
                    $retourVisiteur->execute();
                    $retourVisiteur->closeCursor();
                    $archiverCandidature->execute();
                    $archiverCandidature->closeCursor();
                }
                
                $parametreUrl = parametreUrl();
                
                if($archiverProjet->execute() && $archiverProjet->rowCount() > 0){
                    $archiverProjet->closeCursor();
                    header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $parametreUrl[1] . '&idEspece=' . $parametreUrl[2] . '&message=succesArchiverProjet');
                }else{
                    $archiverProjet->closeCursor();
                    header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $parametreUrl[1] . '&idEspece=' . $parametreUrl[2] . '&message=erreurArchiverProjet');
                }
            }else if(isset($_GET['archiverCandidature']) && !empty($_GET['idAlerte']) && intval($_GET['idAlerte']) > 0 && !empty($_GET['idUtilisateur']) && intval($_GET['idUtilisateur']) > 0){                
                $archiver = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur']);
                
                if($archiver->execute() && $archiver->rowCount() > 0){
                    $archiver->closeCursor();
                    header('Location: ../../candidatures.php?message=succesArchiverCandidature');
                }else{
                    $archiver->closeCursor();
                    header('Location: ../../candidatures.php?message=erreurArchiverCandidature');
                }
            }else{
                header('Location: ../../index.php?message=erreurPage');
            }
        }else{
           header('Location: ../../index.php?message=erreurPage');
        }
    }else{
        header('Location: ../../index.php?message=erreurPage');
    }
?>