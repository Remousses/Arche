<?php
	function DBConnection($includeLevel) {
		if($includeLevel == 1){
			require_once 'param/id_dev.php';
		}else if ($includeLevel == 2){
			require_once '../../param/id_dev.php';
		}
		
		if(session_id() == ""){
			session_start();
		}
		
		try {
			$pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO ( 'mysql:host=' . $hote . ';dbname=' . $base, $utilisateur, $mdp );
			// Sp�cification de l'encodage (en cas de probl�me d'affichage :
			$bdd->exec ('SET NAMES utf8');
			
		} catch (Exception $e) {
			die ('Erreur : ' . $e->getMessage ());
		}
		
		return $bdd;
	}
?>