<?php 
	$reponse = DBConnection($includeLevel)->query('SELECT * FROM boutique'); // Envoi dee la requ�te
	echo '<table class="coller">'; //D�claration d'un tableau et de sa ligne en en-t�te
	echo '<th class="boutique">Boutique</th>';
	echo '<th class="boutique">Adresse</th>';
	echo '<th class="boutique">Contact</th>';
	echo '<th class="boutique">Horaires</th>';
	
	while ($donnees = $reponse->fetch()) {
		echo '<tr>';
		echo '<td class="boutique">' . $donnees['ville'] . '<br />';
		echo '<img alt="Boutique '. $donnees['ville'] . '" src="img/img_boutiques/' .  $donnees['image']  . '" height="200px"></td>';
		echo '<td class="boutique">' . $donnees['rue'] . ' ' . $donnees['cp'] . '</td>';
		echo '<td class="boutique">' . $donnees['telephone'] . '</td>';
		echo '<td class="boutique">' . $donnees['horaires'] . '</td>';
		echo '</tr>';
	}
	echo '</table>'; // Fin du tableau
	$reponse->closeCursor();
?>