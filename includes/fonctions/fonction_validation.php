<?php
    session_start();
    require_once 'connexionDB.php';
    require_once '../../param/infos_id_groupe.php';
    
    if(strpos($_SERVER['PHP_SELF'], 'fonction_validation.php') !== false && isset($_SESSION['Id_groupe'])){
        if($_SESSION['Id_groupe'] == getIdGroupeComite()){
            if(!empty($_GET['approuverAlerte']) && intval($_GET['approuverAlerte']) != 0){
                $approuver = DBconnexion()->prepare('UPDATE alerte SET Statut = 1 WHERE Id_alerte = ' . $_GET['approuverAlerte']);
                
                if($approuver->execute()){
                    $approuver->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesApprouverAlerte');
                }else{
                    $approuver->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurApprouverAlerte');
                }
            }else if(!empty($_GET['archiverAlerte']) && intval($_GET['archiverAlerte']) != 0){                
                $archiver = DBconnexion()->prepare('UPDATE alerte SET Statut = 2 WHERE Id_alerte = ' . $_GET['archiverAlerte'] .'');
                
                if($archiver->execute()){
                    $archiver->closeCursor();
                    header('Location: ../../all_alertes.php?message=succesArchiverAlerte');
                }else{
                    $archiver->closeCursor();
                    header('Location: ../../all_alertes.php?message=erreurArchiverAlerte');
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