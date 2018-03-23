<?php 
    $includeLevel = 2;
    require_once 'connectionDB.php';
    require_once 'fonctions_diverses.php';

    if(isset($_POST['connection'])) {
        if(!empty($_POST['nom']) && !empty($_POST['mdp'])) {
            $nom = htmlentities($_POST['nom'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $mdp = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");

            $connection = DBConnection($includeLevel)->prepare('SELECT Id_internaute, groupe.Id_groupe, Nom_groupe FROM internaute, groupe WHERE Nom_internaute = "' . $nom . '" AND Mdp_internaute = "' . $mdp . '" AND groupe.Id_groupe = internaute.Id_groupe');
            $connection->execute();
            $donnees = $connection->fetch();
            
            if(!($donnees['Id_internaute'] == "")){
                // on ouvre la session avec $_SESSION:
                $_SESSION['Id_groupe'] = $donnees['Id_groupe']; // mise en session de l'id de l'internaute
                $connection->closeCursor();
                alerteBox('Vous \352tes connect\351s en tant que ' . $donnees['Nom_groupe'], '../../index.php');
            }else{
                $connection->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../connection.php?nom=' . $nomInternaute);
            }
        }else{
            alerteBox('Veuillez r\351essayer', '../../connection.php');
        }
    }
?>