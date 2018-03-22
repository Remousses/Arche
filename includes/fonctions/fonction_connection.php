<?php 
    $includeLevel = 2;
    require 'connexionDB.php';
    require 'fonctions_diverses.php';

    if(isset($_POST['connectionInternaute'])) {
        $nomInternaute = htmlentities($_POST['nomInternauteConnection'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
        $mdpInternaute = htmlentities($_POST['mdpInternauteConnection'], ENT_QUOTES, "ISO-8859-1");
           
        if(!empty($_POST['nomInternauteConnection']) && !empty($_POST['mdpInternauteConnection'])) {
            $connexion = DBConnection($includeLevel)->prepare('SELECT Id_internaute FROM internaute WHERE Nom_internaute = "' . $nomInternaute . '" AND Mdp_internaute = "' . $mdpInternaute . '"');
            $connexion->execute();
            $donnees = $connexion->fetch();
            var_dump($connexion);
            if(!($donnees['Id_internaute'] == "")){
                // on ouvre la session avec $_SESSION:
                $_SESSION['Id_internaute'] = $donnees['Id_internaute']; // mise en session du pseudo
                $connexion->closeCursor();
                alerteBox('Connexion r\351ussi', '../../index.php');
            }else{
                $connexion->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../connection.php?nomInternauteConnection=' . $nomInternaute);
            }
        }else{
            alerteBox('Veuillez r\351essayer', '../../connection.php?nomInternauteConnection=' . $nomInternaute);
        }
        
    }

    if(isset($_POST['connexionAdmin'])) {
        if(!empty($_POST['pseudoAdmin']) && !empty($_POST['passwordAdmin'])) {
            $pseudo = htmlentities($_POST['pseudoAdmin'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $motDePasse = htmlentities($_POST['passwordAdmin'], ENT_QUOTES, "ISO-8859-1");
           
            $connexion = DBConnection($includeLevel)->prepare('SELECT id, pseudo, gestions FROM internaute WHERE pseudo = "'.$pseudo.'" AND mdp = "'.$motDePasse.'"');
            $connexion->execute();
            $donnees = $connexion->fetch();
            
            if(!($donnees['id'] == "")){
                if($donnees['gestions'] == 'produits'){
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['gestion'] = $donnees['gestions']; // mise en session de la gestion
                    $_SESSION['pseudoAdmin'] = $donnees['pseudo']; // mise en session du pseudo
                    $connexion->closeCursor();
                    echo '<script>alert("Connexion r\351ussi");location="../../gestions_produits.php"</script>';
                }elseif($donnees['gestions'] == 'boutiques'){
                    // on ouvre la session avec $_SESSION:
                    $_SESSION['gestion'] = $donnees['gestions']; // mise en session de la gestion
                    $_SESSION['pseudoAdmin'] = $donnees['pseudo']; // mise en session du pseudo
                    $connexion->closeCursor();
                    echo '<script>alert("Connexion r\351ussi");location="../../gestions_boutiques.php"</script>';
                }else{
                    $connexion->closeCursor();
                    alerteBox('Vous n\'avez pas les droits', '../../admin.php');
                }
            }else{
                $connexion->closeCursor();
                alerteBox('Veuillez r\351essayer', '../../admin.php');
            }
        }
    }
?>