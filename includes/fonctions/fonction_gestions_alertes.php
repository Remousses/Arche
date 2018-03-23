<?php
    require 'connectionDB.php';
    require 'vues/fonction_vue_all.php';
    require 'vues/admin/fonction_vue_admin_comite.php';
	
    function get_all_alertes($includeLevel) {
        $alerteParPage = 20;

        $reponse = DBConnection($includeLevel)->query('SELECT Id_alerte, Nom_alerte, Informations, Date, Status FROM alerte');
        
        // $nbAlerte = $reponse->rowCount();
        // $nbPages = ceil($nbAlerte / $alerteParPage);
        
        // if(isset($_GET['page'])){
        //     $pageActuelle = intval($_GET['page']);
        
        //     if($pageActuelle > $nbPages && $pageActuelle > 1){
        //         $pageActuelle = $nbPages;
                
        //     }
        // }else{
        //     $pageActuelle = 1;
        // }
        
        while ($donnees = $reponse->fetch()) {
            if($donnees['Status'] == 1){
                allAlertes($donnees['Nom_alerte'], $donnees['Informations'], $donnees['Date']);
                
                if(empty($_SESSION)){
                   echo '<a href="connection.php">Veuillez vous connecter</a><br>';
                }else{
                    echo'<a href="alerte.php?nomAlerte=' . $donnees['Nom_alerte'] . '">Plus de détails</a><br>';
                }
            }else if(isset($_SESSION['Id_groupe']) == 3 && $donnees['Status'] == 0){
                allAlertes($donnees['Nom_alerte'], $donnees['Informations'], $donnees['Date']);
                statuerAlerte($donnees['Id_alerte']);
            }
        }

        $reponse->closeCursor();
        // return $nbPages;
    }

    if(strpos($_SERVER['PHP_SELF'], 'all_alertes.php') !== false && isset($_SESSION['Id_comite'])){
        if(!empty($_GET['confirmerAlerte'])){

        }else if(!empty($_GET['supprimerAlerte'])){

        }
    }

    function allAlertes($nomAlerte, $informations, $date){
        $informationsPlus = $informations;

        if (strlen($informationsPlus) > 20){
            $informationsPlus = substr($informationsPlus, 0, 20);

            $dernierMot = strrpos($informationsPlus," ");
            $informationsPlus = substr($informationsPlus, 0, $dernierMot);
            $informationsPlus .= " ...";
        }
        
        echo 'Nom : ' . $nomAlerte . '<br>
            Informations : ' . $informationsPlus . '<br>
            Lancer le ' . $date;
    }
?>