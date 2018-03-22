<?php
	/**
	 * Fonction de controle de validitation d'un fichier telecharge et inscription sur le disque
	 *
	 * La fonction admet quatre parametres :
	 * $fichier : le fichier en lui-memem;
	 * $tailleMax : la taille maximale du fichier en octets;
	 * $extensionsPossibles : tableau des extensions autorisees;
	 * $repertoireDestination : nom du fichier o� sera enregistr� le fichier (suivi de /).
	 */
	
	function upload($fichier, $tailleMax, $extensionsPossibles, $repertoireDestination){
		if ($fichier['error'] == 0){
			// Verification d'une eventuelle erreur d'envoie
			// Puis traitements li�s au fichier transmis
			$tailleFichier = $fichier['size']; // Recuperation de la taille du fichier
			$typeFichier = $fichier['type']; // Recuperation du type de fichier
			$nomFichier = $fichier['name']; // Recuperation du nom complet du fichier
			$detailFichier = pathinfo($fichier['name']); // Recuperation des details du fichier
			$extensionFichier = $detailFichier['extension']; // Recuperation de l'extension du fichier
	
			if ($tailleFichier <= $tailleMax){
				// Verification de la taille du fichier, ici <= $tailleMax
	
				if (in_array($extensionFichier, $extensionsPossibles)){
					// Verification de l'extension
					$resultat = move_uploaded_file($fichier['tmp_name'], $repertoireDestination.$nomFichier);
					return $resultat; //Retour du resultat de l'ecriture du fichier
				}else{
					// L'extension n'est pas autorisee
					echo '<h4>D&eacute;sol&eacute;, mais l\'extension <b>' . $extensionFichier . '</b> du fichier ' . $fichier['name'] . ' n\'est pas autoris&eacute;e !</h4>';
				}
			}else{
				// La taille du fichier n'est pas autorisee
				echo '<h4>D&eacute;sol&eacute;, mais la taille du fichier ' . $fichier['name'] . ' dépasse 10 Mo !</h4>';
			}
		}else{
			// Une erreur est survenue au telechargement du fichier
			echo '<h4>D&eacute;sol&eacute;, mais il y a eu une erreur au téléchargement du fichier ' . $fichier['name'] . ' !</h4>';
		}
	}
?>