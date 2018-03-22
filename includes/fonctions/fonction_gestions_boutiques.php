<?php 
	require 'connexionDB.php';

	function gestions_boutiques($includeLevel){
		$code = '';

		if (isset($_POST['order']) && isset($_POST['valider'])) {
			$reponse = DBConnection($includeLevel)->query('SELECT * FROM boutique ORDER BY ' . $_POST['order'] . ''); // Envoi de la requete
			$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
			$code .= '<table class="coller">
			<tr>
			<th class="tableau">Id</th>
			<th class="tableau">Boutique</th>
			<th class="tableau">Adresse</th>
			<th class="tableau">Contact</th>
			<th class="tableau">Horaires</th>
			<tr>';
			
			while ($donnees = $reponse->fetch()) {
				$code .= '<tr>
				<td class="tableau">' . $donnees['id'] . '</td>
				<td class="tableau">' . $donnees['ville'] . '<br />
				<img alt="Boutique de '. $donnees['ville'] . '" src="img/img_boutiques/' .  $donnees['image']  . '" height="75px"></td>
				<td class="tableau">' . $donnees['rue'] . ' ' . $donnees['cp'] . '</td>
				<td class="tableau">' . $donnees['telephone'] . '</td>
				<td class="tableau">' . $donnees['horaires'] . '</td>
				<td class="gest_item"><a href="gestions_boutiques.php?suppBoutVille=' . $donnees['ville'] . '&suppBoutImg=' . $donnees['image'] . '"><img alt="Bouton supprimer" src="img/img_logo/Logo_Supprimer.png" height="20px"></a></td>
				<td class="gest_item"><a href="gestions_boutiques.php?modifBoutique=' . $donnees['ville'] . '"><img alt="Bouton modifier" src="img/img_logo/Logo_Modifier.png" height="20px"></a></td></tr>';
			}
			
			$code .= '</table>'; // Fin du tableau
			$code .= '<p class="milieu">Il y a ' . $nb . ' boutiques.</p>'; //Affichage du compte des lignes
			// On libere la connexion du serveur pour d'autres requetes
			$reponse->closeCursor();
					
			$code .= '<form id="formulaireAjoutBoutique" method="post" action="gestions_boutiques.php" enctype="multipart/form-data">
				<fieldset style="width: 350px">
					<legend>Ajout d\'une boutique</legend>
					Rue : <input type="text" id="rue" name="rue"/> <br />
					Code postal : <input type="text" id="cp" name="cp" /> <br />
					Ville : <input type="text" id="ville" name="ville" /> <br />
					Image : <input type="file" id="image" name="image" /> <br />
					T&eacute;l&eacute;phone : <input type="text" id="tel" name="tel" /> <br />
					Horaires : <textarea id="horaires" name="horaires" cols="20" rows="2"></textarea> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer">
					<input class="droite" type="submit" name="ajouter" id="ajouter" value="Ajouter">
				</fieldset>
			</form>
			<br /><br />';

		}else{
			$code .= '<form id="formulaireTriBoutiques" method="post" action="gestions_boutiques.php">
				<fieldset style="width: 700px">
				Tri des boutiques : <input type="radio" id="order" name="order" value="id" checked="checked"/>selon l\'id
								    <input type="radio" id="order" name="order" value="ville"/>selon la ville
								    <input type="radio" id="order" name="order" value="rue"/>selon l\'adresse
								    <input class="droite" type="submit" name="valider" id="valider" value="valider" />
				</fieldset>
			</form>
			<br /><br />
			
			<form id="formulaireAjoutBoutique" method="post" action="gestions_boutiques.php" enctype="multipart/form-data">
				<fieldset style="width: 350px">
					<legend>Ajout d\'une boutique</legend>
					Rue : <input type="text" id="rue" name="rue"/> <br />
					Code postal : <input type="text" id="cp" name="cp" /> <br />
					Ville : <input type="text" id="ville" name="ville" /> <br />
					Image : <input type="file" id="image" name="image" /> <br />
					T&eacute;l&eacute;phone : <input type="text" id="tel" name="tel" /> <br />
					Horaires : <textarea id="horaires" name="horaires" cols="20" rows="2"></textarea> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer">
					<input class="droite" type="submit" name="ajouter" id="ajouter" value="Ajouter">
				</fieldset>
			</form>
			<br /><br />';
		}

		if (isset($_GET['modifBoutique'])) {
			// Ici on mofifie une boutique
			$modifBoutique = $_GET['modifBoutique'];

			$modif = DBConnection($includeLevel)->prepare('SELECT * FROM boutique WHERE ville = ?'); // Envoi de la requ�te
			$modif->execute(array($modifBoutique));
			$donnees = $modif->fetch();
			
			$code .= '<form id="formulaireModificationBoutique" method="post" action="gestions_boutiques.php?modifBoutVille1=' . $donnees['ville'] . '&modifBoutImg1=' . $donnees['image'] .'" enctype="multipart/form-data">
				<fieldset style="width: 400px">
				<legend>Modification de la boutique de <span class="gras">' . $donnees['ville'] . '</span></legend>
					Rue : <input type="text" id="rueModif" name="rueModif" value="' . $donnees['rue'] . '"/> <br />
					Code postal : <input type="text" id="cpModif" name="cpModif" value="' . $donnees['cp'] . '"/> <br />
					Ville : <input type="text" id="villeModif" name="villeModif" value="' . $donnees['ville'] . '"/> <br />
					Nom image : <input type="text" id="imageModifNom" name="imageModifNom" value="' . $donnees['image'] . '"/> <br />
					Nouvelle image : <input type="file" id="imageModif" name="imageModif"/> <br />
					T&eacute;l&eacute;phone : <input type="text" id="telModif" name="telModif" value="' . $donnees['telephone'] . '"/> <br />
					Horaires : <textarea id="horairesModif" name="horairesModif" cols="20" rows="2">' . $donnees['horaires']  . '</textarea> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer modification">
					<input class="droite" type="submit" name="modifier" id="modifier" value="Modifier">
				</fieldset>
			</form>
			<br /><br />';
		}
		
		if (isset($_GET['suppBoutVille']) && isset($_GET['suppBoutImg'])) {
			// Ici on supprime un people
			$suppBoutVille = $_GET['suppBoutVille'];
			$suppBoutmg = $_GET['suppBoutImg'];
			
			$suppression = DBConnection($includeLevel)->prepare('DELETE FROM boutique WHERE ville="' . $suppBoutVille .'"'); // Envoi de la requ�te
			$nb = $suppression->rowCount(); // Compte du nombre de lignes retourn�es
			if($suppression->execute()){
				unlink('img/img_boutiques/' . $_GET['suppBoutImg']);
				$code .= '<h4>La boutique de ' . $suppBoutVille . ' a &eacute;t&eacute; supprim&eacute;.</h4>';
			}else{
				$code .= '<h4>Erreur lors de la suppression.</h4>';
			}
			
			$suppression->closeCursor();
		}
		
		if(isset($_POST['ajouter']) && !empty($_POST['rue'])
				&& !empty($_POST['cp']) && !empty($_POST['ville'])
				&& isset($_FILES['image']) && !empty($_POST['tel'])
				&& !empty($_POST['horaires'])){
			
			$rue = htmlspecialchars($_POST['rue']);
			$cp = htmlspecialchars($_POST['cp']);
			$ville = htmlspecialchars($_POST['ville']);
			$image = $_FILES['image'];
			$tel = htmlspecialchars($_POST['tel']);
			$horaires = htmlspecialchars($_POST['horaires']);
			$listExt = array ('png', 'jpg');
			if (upload($image, '10000000', $listExt,'img/img_boutiques/')){
				$id_max = DBConnection($includeLevel)->query('SELECT MAX(id) AS id_Max FROM boutique');
				$id_max->execute();
				
				while($donnees = $id_max->fetch()) {
					$max = $donnees['id_Max'] + 1;
					$insertion = DBConnection($includeLevel)->prepare('INSERT INTO boutique(id, rue, cp, ville, image, telephone, horaires) VALUES
				(' . $max . ', "' . $rue . '", "' . $cp . '", "' . $ville . '", "' . $image['name'] . '", "' . $tel . '", "' . $horaires . '")');
					if($insertion->execute()){
						$code .= '<h4>La boutique de ' . $ville . ' a bien &eacute;t&eacute; enregistr&eacute;e.</h4>';
					}else{
						$code .= '<h4>Erreur lors de l\'enregistrement</h4>';
					}
			
					$insertion->closeCursor();
				}
			}
		}
		
		if(isset($_POST['modifier']) && !empty($_POST['rueModif'])
				&& !empty($_POST['cpModif']) && !empty($_POST['villeModif'])
				&& !empty($_POST['imageModifNom']) && !empty($_POST['telModif'])
				&& !empty($_POST['horairesModif'])){
			// Ici on modifie une boutique
			$rueModif = htmlspecialchars($_POST['rueModif']);
			$cpModif = htmlspecialchars($_POST['cpModif']);
			$villeModif = htmlspecialchars($_POST['villeModif']);
			$imageModifNom = htmlspecialchars($_POST['imageModifNom']);
			$telModif = htmlspecialchars($_POST['telModif']);
			$horairesModif = htmlspecialchars($_POST['horairesModif']);
				
			try {
				if ($_FILES['imageModif']['name'] != '' && $_GET['modifBoutImg1'] == $imageModifNom){
					$imageModif = $_FILES['imageModif'];
					$listExt = array ('png', 'jpg');
					if (upload($_FILES['imageModif'], '10000000', $listExt,'img/img_boutiques/')){
						$insertion = DBConnection($includeLevel)->prepare('UPDATE boutique SET rue = "' . $rueModif . '", cp = "' . $cpModif . '", ville= "' . $villeModif . '",
						image = "' . $imageModif['name'] . '", telephone = "' . $telModif . '", horaires = "' . $horairesModif . '" WHERE ville = "' . $_GET['modifBoutVille1'] . '"');
						if($insertion->execute()){
							unlink('img/img_boutiques/' . $_POST['imageModifNom']);
							$code .= '<h4>La boutique de ' . $villeModif . ' a bien &eacute;t&eacute; modifi&eacute;e.</h4>';
						}else{
							$code .= '<h4>Erreur lors de la modification</h4>';
						}
					}
					$insertion->closeCursor();

				}elseif($_FILES['imageModif']['name'] == ''){
					$insertion = DBConnection($includeLevel)->prepare('UPDATE boutique SET rue = "' . $rueModif . '", cp = "' . $cpModif . '", ville= "' . $villeModif . '",
					image = "' . $imageModifNom . '", telephone = "' . $telModif . '", horaires = "' . $horairesModif . '" WHERE ville = "' . $_GET['modifBoutVille1'] . '"');
					if($insertion->execute()){
						if($_GET['modifBoutImg1'] != $imageModifNom){
							rename('img/img_boutiques/' . $_GET['modifBoutImg1'], 'img/img_boutiques/' . $imageModifNom);
						}
						$code .= '<h4>La boutique de ' . $villeModif . ' a bien &eacute;t&eacute; modifi&eacute;e.</h4>';
					}else{
						$code .= '<h4>Erreur lors de la modification</h4>';
					}
					$insertion->closeCursor();

				}else{
					$modif = DBConnection($includeLevel)->prepare('SELECT * FROM boutique WHERE ville = ?'); // Envoi de la requ�te
					$modif->execute(array($_GET['modifBoutVille1']));
					$donnees = $modif->fetch();
								
					$code .= '<form id="formulaireModificationBoutique" method="post" action="gestions_boutiques.php?modifBoutVille1=' . $donnees['ville'] . '&modifBoutImg1=' . $donnees['image'] .'" enctype="multipart/form-data">
						<fieldset style="width: 400px">
						<legend>Modification de la boutique de <span class="gras">' . $donnees['ville'] . '</span></legend>
							Rue : <input type="text" id="rueModif" name="rueModif" value="' . $donnees['rue'] . '"/> <br />
							Code postal : <input type="text" id="cpModif" name="cpModif" value="' . $donnees['cp'] . '"/> <br />
							Ville : <input type="text" id="villeModif" name="villeModif" value="' . $donnees['ville'] . '"/> <br />
							Nom image : <input type="text" id="imageModifNom" name="imageModifNom" value="' . $donnees['image'] . '"/> <br />
							Nouvelle image : <input type="file" id="imageModif" name="imageModif"/> <br />
							T&eacute;l&eacute;phone : <input type="text" id="telModif" name="telModif" value="' . $donnees['telephone'] . '"/> <br />
							Horaires : <textarea id="horairesModif" name="horairesModif" cols="20" rows="2">' . $donnees['horaires']  . '</textarea> <br /><br />
							<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer modification">
							<input class="droite" type="submit" name="modifier" id="modifier" value="Modifier">
						</fieldset>
					</form>';

				}
			}catch(Exception $erreur){
				die('Erreur : ' . $erreur->getMessage());
			}
		}

		echo $code;
	}
?>