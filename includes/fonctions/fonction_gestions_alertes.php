<?php
    require_once 'connectionDB.php';
    require_once 'vues/fonction_vue_all.php';
    require_once 'vues/admin/fonction_vue_admin_comite.php';
	
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
                voirAlertes($donnees['Nom_alerte'], $donnees['Informations'], $donnees['Date']);
                
                if(empty($_SESSION)){
                   echo '<a href="connection.php">Veuillez vous connecter</a><br>';
                }else{
                    echo'<a href="alerte.php?nomAlerte=' . $donnees['Nom_alerte'] . '">Plus de détails</a><br>';
                }
            }else if(isset($_SESSION['Id_groupe']) && $donnees['Status'] == 0){
                voirAlertes($donnees['Nom_alerte'], $donnees['Informations'], $donnees['Date']);
                
                if($_SESSION['Id_groupe'] == 3){
                    statuerAlerte($donnees['Id_alerte']);
                }else if($_SESSION['Id_groupe'] == 7){
                    echo 'Alerte en attente<br>';
                }
            }
        }

        $reponse->closeCursor();
        // return $nbPages;
    }
?>