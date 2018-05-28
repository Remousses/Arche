<?php
    session_start();
    require_once 'connexionDB.php';
    require_once '../../param/infos_id_groupe.php';
    
    if(strpos($_SERVER['PHP_SELF'], 'fonction_validation.php') !== false && isset($_SESSION['Id_groupe'])){
        if($_SESSION['Id_groupe'] == getIdGroupeComite()){
            $connexion = DBconnexion();
            if(!empty($_GET['approuverAlerte']) && intval($_GET['approuverAlerte']) != 0){
                $approuver = $connexion->prepare('UPDATE alerte SET Statut = 1 WHERE Id_alerte = ' . $_GET['approuverAlerte']);
                
                if($approuver->execute()){
                    $approuver->closeCursor();
                    echo 'a';
                    header('Location: ../../all_alertes.php?message=succesApprouverAlerte');
                }else{
                    $approuver->closeCursor();
                    echo 'b';
                    header('Location: ../../all_alertes.php?message=erreurApprouverAlerte');
                }
            }else if(isset($_GET['approuverCandidature']) && !empty($_GET['idAlerte']) && intval($_GET['idAlerte']) != 0 && !empty($_GET['idUtilisateur']) && intval($_GET['idUtilisateur']) != 0){                
                $approuver = $connexion->prepare('UPDATE candidater_alerte SET Statut = 1 WHERE Id_alerte = ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur']);
                $missionnaire = $connexion->prepare('UPDATE utilisateur SET Id_groupe = ' . getIdGroupeMissionnaire() . ' WHERE Id_utilisateur = ' . $_GET['idUtilisateur']);
                $archiverCandidatures = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte != ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur']);
                    
                if($approuver->execute() && $missionnaire->execute() && $archiverCandidatures->execute()){
                    $archiverCandidatures->closeCursor();
                    $missionnaire->closeCursor();
                    $approuver->closeCursor();
                    header('Location: ../../candidatures.php?message=succesApprouverCandidature');
                }else{
                    $approuver->closeCursor();
                    header('Location: ../../candidatures.php?message=erreurApprouverCandidature');
                }
            }else if(!empty($_GET['archiverAlerte']) && intval($_GET['archiverAlerte']) != 0){                
                $archiver = $connexion->prepare('UPDATE alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte']);
                
                if($archiver->execute()){
                    $archiver->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesArchiverAlerte');
                }else{
                    $archiver->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurArchiverAlerte');
                }
            }else if(isset($_GET['archiverCandidature']) && !empty($_GET['idAlerte']) && intval($_GET['idAlerte']) != 0 && !empty($_GET['idUtilisateur']) && intval($_GET['idUtilisateur']) != 0){                
                $archiver = $connexion->prepare('UPDATE candidater_alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['idAlerte'] .' AND Id_utilisateur = ' . $_GET['idUtilisateur']);
                
                if($archiver->execute()){
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