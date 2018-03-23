<?php 
    $includeLevel = 2;
    require 'connectionDB.php';
    require 'fonctions_diverses.php';

    if(isset($_POST['inscriptionInternaute'])){            
        if(!empty($_POST['nomInternauteInscription']) && !empty($_POST['prenomInternauteInscription']) 
            && !empty($_POST['mdpInternauteInscription'])) {

            $nomInternaute = htmlentities($_POST['nomInternauteInscription'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $prenomInternaute = htmlentities($_POST['prenomInternauteInscription'], ENT_QUOTES, "UTF-8");
            $mdpInternaute = htmlentities($_POST['mdpInternauteInscription'], ENT_QUOTES, "UTF-8");

            $inscription = DBConnection($includeLevel)->prepare('INSERT INTO internaute (Nom_internaute, Prenom_internaute, Mdp_internaute) 
            VALUES ("' . $nomInternaute . '", "' . $prenomInternaute . '", "' . $mdpInternaute . '")');
            
            if($inscription->execute()){
                $inscription->closeCursor();
                alerteBox('Inscription r\351ussi', '../../connection.php');
            }else{
                $inscription->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../connection.php?nomInternauteInscription=' . $nomInternaute . '&prenomInternauteInscription=' . $prenomInternaute);
            }
        }else{
            $inscription->closeCursor();
            alerteBox('Veuillez r\351essayer', '../../connection.php');
        }
    }

    if(isset($_POST['creerAlerte'])){        
        if(!empty($_POST['nomAlerte']) && !empty($_POST['informationsAlerte'])) {
            $nomAlerte = htmlentities($_POST['nomAlerte'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $informationsAlerte = htmlentities($_POST['informationsAlerte'], ENT_QUOTES, "UTF-8");
            $date = htmlentities($_POST['dateAlerte'], ENT_QUOTES, "UTF-8");

            $alerte = DBConnection($includeLevel)->prepare('INSERT INTO alerte (Nom_alerte, Informations, Date, Id_group) VALUES ("' . $nomAlerte . '", "' . $informationsAlerte . '", "' . $date . '", 1)');
            
            if($alerte->execute()){
                $alerte->closeCursor();
                alerteBox('Alerte cr\351\351e', '../../all_alertes.php');
            }else{
                $alerte->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informations=' . $informationsAlerte);
            }
        }else{
            alerteBox('Veuillez r\351essayer', '../../all_alertes.php');
        }
    }
?>