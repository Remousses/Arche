<?php
    require '../param/id.php';
    header('Content-Type: text/html; charset=UTF-8');
    define('pageprecedente', $_SERVER["HTTP_REFERER"], true);

    if(isset($_POST['search']) && !empty($_POST['search'])) {
        $chainesearch = addslashes($_POST['search']);

        try{
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host='.$hote.';dbname='. $base, $utilisateur, $mdp);
            // Sp�cification de l'encodage (en cas de probl�me d'affichage :
            $bdd->exec('SET NAMES utf8');
        }catch(Exception $erreur){
            echo 'Erreur : '.$e->getMessage();
            echo 'N° : '.$e->getCode();
        }			  

        $requete = 'SELECT * from produit WHERE nom LIKE "%'. $chainesearch . '%" OR description LIKE "%'. $chainesearch .'%"';

        // Ex�cution de la requ�te SQL
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
        $nb = $resultat->rowCount();
        if($nb == 0){
            echo 'Aucun r&eacute;sultat pour ' . $chainesearch;
        }else{
            header('Location: ../recherche.php?chainesearch=' . $chainesearch);
        }

    }else{
        header('Location: ' . pageprecedente);
    }
?>