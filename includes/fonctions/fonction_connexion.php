<?php 
    require_once 'connexionDB.php';

    if(isset($_POST['connexion'])) {
        if(!empty($_POST['nom']) && !empty($_POST['mdp'])) {
            $nom = htmlentities($_POST['nom'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $mdp = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");

            $connexion = DBconnexion()->prepare('SELECT Id_utilisateur, groupe.Id_groupe, Nom_groupe FROM utilisateur, groupe WHERE Nom_utilisateur = "' . $nom . '" AND Mdp_utilisateur = "' . $mdp . '" AND groupe.Id_groupe = utilisateur.Id_groupe');
            $connexion->execute();
            $donnees = $connexion->fetch();
            
            if($connexion->rowCount() > 0){
                // on ouvre la session avec $_SESSION:
                $_SESSION['Id_utilisateur'] = $donnees['Id_utilisateur']; // mise en session de l'id de l'utilisateur
                $_SESSION['Id_groupe'] = $donnees['Id_groupe']; // mise en session de l'id du groupe de l'utilisateur
                $connexion->closeCursor();
                header('Location: ../../index.php?message=succesConnexion&nomGroupe=' . $donnees['Nom_groupe']);
            }else{
                $connexion->closeCursor();
                header('Location: ../../connexion.php?nom=' . $nom . '&message=erreurConnexion');
            }
        }else{
            header('Location: ../../connexion.php?message=erreurConnexion');
        }
    }
?>