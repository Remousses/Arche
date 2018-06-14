<?php
    require_once 'connexionDB.php';

    function archiverAlerte($idAlerte){
        $connexion = DBConnexion();
        $archiverAlerte = $connexion->prepare('UPDATE alerte SET Statut = 2 WHERE Id_alerte = ' .$idAlerte);
        $rechercheProjet = $connexion->prepare('SELECT Nom_projet FROM projet WHERE Id_alerte = ' . $idAlerte);

        if($rechercheProjet->execute() && $rechercheProjet->rowCount() > 0){
            $archiverProjet = $connexion->prepare('UPDATE projet SET Statut = 2 WHERE Id_alerte = ' . $idAlerte);
            $archiverProjet->execute();
            $archiverProjet->closeCursor();
        }
        
        $archiverAlerte->execute();

        $rechercheProjet->closeCursor();
        $archiverAlerte->closeCursor();
            
    }
?>