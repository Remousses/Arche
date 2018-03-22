<?php
	session_start();
	session_destroy();
	define('pageprecedente', $_SERVER["HTTP_REFERER"], true);
	
	if(pageprecedente == "gestions_produits.php" || pageprecedente == "gestions_boutiques.php"){
		header('Location: index.php');
	}else{
		header('Location: ' . pageprecedente);
	}
	
	exit;
?>