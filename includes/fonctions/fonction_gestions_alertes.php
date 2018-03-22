<?php
	require 'connexionDB.php';
	
    function get_all_alertes($includeLevel) {
        $alerteParPage = 20;
        $code = '';

        $reponse = DBConnection($includeLevel)->query('SELECT Nom_alerte, Informations, Date FROM alerte');
        
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
            $code .= 'Nom : ' . $donnees['Nom_alerte'] . '<br>
                    Informations : ' . $donnees['Informations'] . '<br>
                    Lancer le ' . $donnees['Date'];
            
            if(isset($_SESSION['Id_internaute'])){
                $code .= '<a href="alerte.php?nomAlerte=' . $donnees['Nom_alerte'] . '">Plus de détails</a><br>';
            }else{
                $code .= '<a href="connection.php">Veuillez vous connecter</a><br>';
            }
                    
        }
        
        $code .= '</table>';
        $reponse->closeCursor();

        echo $code;
        // return $nbPages;
    }
?>