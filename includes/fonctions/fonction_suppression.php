<?php
    require_once 'connexionDB.php';

    function archiverAlerte($idAlerte){
        $archiver = DBConnexion()->prepare('UPDATE alerte SET Statut = 2 WHERE Id_alerte = ' . $idAlerte);
        $archiver->execute();
        $archiver->closeCursor();
    }
?>