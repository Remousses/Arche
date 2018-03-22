<?php 
    $includeLevel = 2;
    require 'connexionDB.php';
    require 'fonctions_diverses.php';

    if(isset($_POST['inscriptionInternaute'])){
        $nomInternaute = htmlentities($_POST['nomInternaute'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
        $prenomInternaute = htmlentities($_POST['prenomInternaute'], ENT_QUOTES, "UTF-8");
        $mdpInternaute = htmlentities($_POST['mdpInternaute'], ENT_QUOTES, "UTF-8");
            
        if(!empty($_POST['nomInternaute']) && !empty($_POST['prenomInternaute']) 
            && !empty($_POST['mdpInternaute'])) {

            $inscription = DBConnection($includeLevel)->prepare('INSERT INTO internaute (Nom_internaute, Prenom_internaute, Mdp_internaute) 
            VALUES ("' . $nomInternaute . '", "' . $prenomInternaute . '", "' . $mdpInternaute . '")');
            
            if($inscription->execute()){
                $inscription->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../connection.php');
            }else{
                $inscription->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../all_alertes.php?nomInternaute=' . $nomInternaute . '&prenomInternaute=' . $prenomInternaute);
            }
        }else{
            $inscription->closeCursor();
            alerteBox('Veuillez r\351essayer', '../../all_alertes.php?nomInternaute=' . $nomInternaute . '&prenomInternaute=' . $prenomInternaute);
        }
    }

    if(isset($_POST['creerAlerte'])){
        $nomAlerte = htmlentities($_POST['nomAlerte'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
        $informationsAlerte = htmlentities($_POST['informationsAlerte'], ENT_QUOTES, "UTF-8");
        
        if(!empty($_POST['nomAlerte']) && !empty($_POST['informationsAlerte'])) {
            $date = htmlentities($_POST['dateAlerte'], ENT_QUOTES, "UTF-8");
            $alerte = DBConnection($includeLevel)->prepare('INSERT INTO alerte (Nom_alerte, Informations, Date) VALUES ("' . $nomAlerte . '", "' . $informationsAlerte . '", "' . $date . '")');
            
            if($alerte->execute()){
                $alerte->closeCursor();
                alerteBox('Alerte cr\351\351e', '../../all_alertes.php');
            }else{
                $alerte->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informations=' . $informationsAlerte);
            }
        }else{
            alerteBox('Veuillez r\351essayer', '../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informations=' . $informationsAlerte);
        }
    }
?>