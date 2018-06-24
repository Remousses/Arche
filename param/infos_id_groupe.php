<?php
    function getIdGroupeVisiteur(){
        return 1;
    }

    function getIdGroupeNarrateur(){
        return 2;
    }

    function getIdGroupeComite(){
        return 3;
    }

    function getIdGroupeAdministrateur(){
        return 4;
    }

    function getIdGroupeMissionnaire(){
        return 5;
    }

    function getIdGroupeSentinelle(){
        return 6;
    }

    function getIdGroupeParrainFinancier(){
        return 7;
    }

    function getIdGroupeRessourcesHumaines(){
        return 8;
    }

    function getIdGroupePersonnelPermanent(){
        return 9;
    }

    function getNomGroupe(){
        $nomGroupe = $GLOBALS['connexion']->prepare('SELECT Nom_groupe FROM groupe WHERE Id_groupe = ' . $_SESSION['Id_groupe']);
        $nomGroupe->execute();
        $donnee = $nomGroupe->fetch();
        $nom = $donnee['Nom_groupe'];
        $nomGroupe->closeCursor();

        echo $nom;
    }
?>