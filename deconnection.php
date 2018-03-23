<?php
	session_start();
	session_destroy();
	require 'includes/fonctions/fonctions_diverses.php';
	pagePrecedente();
	/*if(pageprecedente == "gestions_produits.php" || pageprecedente == "gestions_boutiques.php"){
		header('Location: index.php');
	}else{
		header('Location: ' . pageprecedente);
	}*/
	
	exit;
?>