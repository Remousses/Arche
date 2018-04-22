<?php
	function DBConnexion() {
		$base = 'archedb';
		$hote = 'localhost';
		$utilisateur = 'root';
		$mdp = '';
		
		if(session_id() == ""){
			session_start();
		}
		
		try {
			$pdo_options [PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO ( 'mysql:host=' . $hote . ';dbname=' . $base, $utilisateur, $mdp );
			// Sp�cification de l'encodage (en cas de probleme d'affichage :
			$bdd->exec ('SET NAMES utf8');
			
		} catch (Exception $e) {
			die ('Erreur : ' . $e->getMessage ());
		}
		
		return $bdd;
	}
?>