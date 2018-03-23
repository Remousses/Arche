<?php
    session_start();
    $includeLevel = 2;
    require_once 'connectionDB.php';
    require_once 'fonctions_diverses.php';

    if(strpos($_SERVER['PHP_SELF'], 'fonction_validation.php') !== false && isset($_SESSION['Id_groupe'])){
        if($_SESSION['Id_groupe'] == 3){
            if(!empty($_GET['confirmerAlerte'])){
                $update = DBConnection($includeLevel)->prepare('UPDATE alerte SET Status = 1 WHERE Id_alerte = ' . $_GET['confirmerAlerte']);
                
                if($update->execute()){
                    alerteBox('L\'alerte \340 \351t\351 modifi\351e', '../../all_alertes.php');
                }else{
                    alerteBox('Veuillez r\351essayer', '../../all_alertes.php');
                }
            }else if(!empty($_GET['supprimerAlerte'])){                
                $suppression = DBConnection($includeLevel)->prepare('DELETE FROM alerte WHERE Id_alerte = "' . $_GET['supprimerAlerte'] .'"');
                
                if($suppression->execute()){
                    alerteBox('L\'alerte \340 \351t\351 supprim\351e', '../../all_alertes.php');
                }else{
                    $suppression->closeCursor();
                    alerteBox('Veuillez r\351essayer', '../../all_alertes.php');
                }
            }else {
                alerteBox('Cette page n\'existe pas. Redirection sur la page d\'accueil', '../../index.php');
            }
        }else {
            alerteBox('Cette page n\'existe pas. Redirection sur la page d\'accueil', '../../index.php');
        }
    }else {
        alerteBox('Cette page n\'existe pas. Redirection sur la page d\'accueil', '../../index.php');
    }
?>