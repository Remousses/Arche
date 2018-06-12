<?php
	session_start();
	session_destroy();
	require_once 'includes/fonctions/fonction_diverses.php';
	pagePrecedente();
	
	exit;
?>