<?php
	require 'connexionDB.php';
	
	function gestions_produits($includeLevel){
		$code = '';
		if (isset($_POST['order']) && isset($_POST['valider'])) {
			$code .= '<form id="formulaireTriProduits" method="post" action="gestions_produits.php">
				<fieldset style="width: 700px">
				Tri des produits : <input type="radio" id="order" name="order" value="produit_id" checked="checked"/>selon l\'id
								   <input type="radio" id="order" name="order" value="nom"/>selon le nom
								   <input type="radio" id="order" name="order" value="prix"/>selon le prix
								   <input type="radio" id="order" name="order" value="categorie"/>selon la cat&eacute;gorie
								   <input class="droite" type="submit" name="valider" id="valider" value="valider" />
				</fieldset>
			</form>
			<br /><br />';
			$reponse = DBConnection($includeLevel)->query('SELECT * FROM produit ORDER BY ' . $_POST['order'] . ''); // Envoi de la requete
			$nb = $reponse->rowCount(); // Compte du nombre de lignes retourn�es
			$code .= '<table class="coller">
					<tr>
					<th class="tableau">Id</th>
					<th class="tableau">Nom</th>
					<th class="tableau">Description</th>
					<th class="tableau">Prix</th>
					<th class="tableau">Catégorie</th>
					<tr>';
			
			while ($donnees = $reponse->fetch()) {
				$description = $donnees['description'];
				$code .= '<tr>
						<td class="tableau">' . $donnees['produit_id'] . '</td>
						<td class="tableau">' . $donnees['nom'] . '<br /><img alt="'. $donnees['nom'] . '" src="img/img_produits/' .  $donnees['image']  . '" height="75px"></td>
						<td class="tableau">' . $description . '</td>
						<td class="tableau">' . $donnees['prix'] . ' €</td>
						<td class="tableau">' . $donnees['categorie'] . '</td>
						<td class="gest_item"><a href="gestions_produits.php?suppProdNom=' . $donnees['nom'] . '&suppProdImg=' . $donnees['image'] . '"><img alt="Bouton supprimer" src="img/img_logo/Logo_Supprimer.png" height="20px"></a></td>
						<td class="gest_item"><a href="gestions_produits.php?modifProdNom=' . $donnees['nom'] . '"><img alt="Bouton modifier" src="img/img_logo/Logo_Modifier.png" height="20px"></a></td>
						</tr>';
			}
			
			$code .= '</table>
			<p class="milieu">Il y a ' . $nb . ' produits.</p>';
			// On libere la connexion du serveur pour d'autres requetes
			$reponse->closeCursor();
			$id_max = DBConnection($includeLevel)->query('SELECT MIN(categorie_id) AS id_Min, MAX(categorie_id) AS id_Max FROM categorie'); // Envoi de la requ�te
			$id_max->execute();
			$id = $id_max->fetch();
			$id_max->closeCursor();
			
			$code .= '<form id="formulaireAjoutProduit" method="post" action="gestions_produits.php" enctype="multipart/form-data">
				<fieldset style="width: 350px">
					<legend>Ajout d\'un produit</legend>
					Nom : <input type="text" id="nom" name="nom"/> <br />
					Description : <textarea id="description" name="description" cols="30" rows="3"/></textarea> <br />
					Prix : <input type="number" min="0" step="0.1" id="prix" name="prix" /> €<br />
					Image : <input type="file" id="image" name="image" /> <br />
					Cat&eacute;gorie : <input type="number" id="categorie" name="categorie" min="' . $id['id_Min'] . '" max="' . $id['id_Max'] . '"/> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer">
					<input class="droite" type="submit" name="ajouter" id="ajouter" value="Ajouter">
				</fieldset>
			</form>
			<br /><br />';
		}else{
			$code .= '<form id="formulaireTriProduits" method="post" action="gestions_produits.php">
				<fieldset style="width: 700px">
				Tri des produits : <input type="radio" id="order" name="order" value="produit_id" checked="checked"/>selon l\'id
								    <input type="radio" id="order" name="order" value="nom"/>selon le nom
								    <input type="radio" id="order" name="order" value="prix"/>selon le prix
								    <input type="radio" id="order" name="order" value="categorie"/>selon la cat&eacute;gorie
								    <input class="droite" type="submit" name="valider" id="valider" value="valider" />
				</fieldset>
			</form>
			<br /><br />';
			
			$id_max = DBConnection($includeLevel)->query('SELECT MIN(categorie_id) AS id_Min, MAX(categorie_id) AS id_Max FROM categorie'); // Envoi de la requ�te
			$id_max->execute();
			$id = $id_max->fetch();
			$id_max->closeCursor();
			
			$code .= '<form id="formulaireAjoutProduit" method="post" action="gestions_produits.php" enctype="multipart/form-data">
				<fieldset style="width: 350px">
					<legend>Ajout d\'un produit</legend>
					Nom : <input type="text" id="nom" name="nom"/> <br />
					Description : <textarea id="description" name="description" cols="30" rows="3"></textarea> <br />
					Prix : <input type="number" min="0" step="0.1" id="prix" name="prix" /> €<br />
					Image : <input type="file" id="image" name="image" /> <br />
					Cat&eacute;gorie : <input type="number" id="categorie" name="categorie" min="' . $id['id_Min'] . '" max="' . $id['id_Max'] . '"/> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer">
					<input class="droite" type="submit" name="ajouter" id="ajouter" value="Ajouter">
				</fieldset>
			</form>
			<br /><br />';
		}
		
		if (!empty($_GET['modifProdNom'])) {
			// Ici on mofifie un produit
			$modifProdNom = $_GET['modifProdNom'];

			$modif = DBConnection($includeLevel)->prepare('SELECT * FROM produit WHERE nom = ?'); // Envoi de la requ�te
			$modif->execute(array($modifProdNom));
			$donnees = $modif->fetch();
			$modif->closeCursor();
			$id_max = DBConnection($includeLevel)->query('SELECT MIN(categorie_id) AS id_Min, MAX(categorie_id) AS id_Max FROM categorie'); // Envoi de la requ�te
			$id_max->execute();
			$id = $id_max->fetch();
			$id_max->closeCursor();
			
			$code .= '<form id="formulaireModificationProduit" method="post" action="gestions_produits.php?modifProdNom1=' . $donnees['nom'] . '&modifProdImg1=' . $donnees['image'] . '" enctype="multipart/form-data">
				<fieldset style="width: 400px">
				<legend>Modification du produit <span class="gras">' . $donnees['nom'] . '</span></legend>
					Nom : <input type="text" id="nomModif" name="nomModif" value="' . $donnees['nom'] . '"/> <br />
					Description : <textarea id="descriptionModif" name="descriptionModif" cols="30" rows="3">' . $donnees['description'] . '</textarea> <br />
					Prix : <input type="number" min="0" step="0.1" id="prixModif" name="prixModif" value="' . $donnees['prix'] . '"/> €<br />
					Nom image : <input type="text" id="imageModifNom" name="imageModifNom" value="' . $donnees['image'] . '"/> <br />
					Nouvelle image : <input type="file" id="imageModif" name="imageModif"/> <br />
					Cat&eacute;gorie : <input type="number" id="categorieModif" name="categorieModif" min="' . $id['id_Min'] . '>" max="' . $id['id_Max'] . '" value="' . $donnees['categorie'] . '"/> <br /><br />
					<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer modification">
					<input class="droite" type="submit" name="modifier" id="modifier" value="Modifier">
				</fieldset>
			</form>
			<br /><br />';
		}
		
		if (isset($_GET['suppProdNom']) && isset($_GET['suppProdImg'])) {
			// Ici on supprime un people
			$suppProdNom = $_GET['suppProdNom'];
			$suppProdmg = $_GET['suppProdImg'];
			
			$suppression = DBConnection($includeLevel)->prepare('DELETE FROM produit WHERE nom = "' . $suppProdNom .'"'); // Envoi de la requ�te
			$nb = $suppression->rowCount(); // Compte du nombre de lignes retourn�es
			if($suppression->execute()){
				unlink('img/img_produits/' . $_GET['suppProdImg']);
				$code .= '<h4>Le produit ' . $suppProdNom . ' a &eacute;t&eacute; supprim&eacute;.</h4>';
			}else{
				$code .= '<h4>Erreur lors de la suppression.</h4>';
			}
			
			$suppression->closeCursor();
		}
		
		if(isset($_POST['ajouter']) && !empty($_POST['nom'])
				&& !empty($_POST['description']) && !empty($_POST['description'])
				&& !empty($_POST['prix']) && isset($_FILES['image'])
				&& !empty($_POST['categorie'])){
			
			$nom = htmlspecialchars($_POST['nom']);
			$description = htmlspecialchars($_POST['description']);
			$prix = htmlspecialchars($_POST['prix']);
			$image = $_FILES['image'];
			$categorie = htmlspecialchars($_POST['categorie']);
			
			$id_max = DBConnection($includeLevel)->query('SELECT MAX(produit_id) AS id_Max FROM produit');
			$id_max->execute();
			$donnees = $id_max->fetch();
			$max = $donnees['id_Max'] + 1;
			$id_max->closeCursor();
			$insertion = DBConnection($includeLevel)->prepare('INSERT INTO produit(produit_id, nom, description, prix, image, categorie) VALUES
			(' . $max . ', "' . $nom . '", "' . $description . '", "' . $prix . '", "' . $image['name'] . '", "' . $categorie . '")');
			if($insertion->execute()){
				$listExt = array ('png', 'jpg', 'jpeg');
				if (upload($image, '10000000', $listExt,'img/img_produits/')){
					$code .= '<h4>Le produit ' . $nom . ' a bien &eacute;t&eacute; enregistr&eacute;.</h4>';
				}
			}else{
				$code .= '<h4>Erreur lors de l\'enregistrement</h4>';
			}
				
			$insertion->closeCursor();
		}
		
		
		if(isset($_POST['modifier']) && !empty($_POST['nomModif'])
				&& !empty($_POST['prixModif']) && !empty($_POST['imageModifNom'])
				&& !empty($_POST['categorieModif'])){
			// Ici on modifie une boutique
			$nomModif = htmlspecialchars($_POST['nomModif']);
			$descriptionModif = htmlspecialchars($_POST['descriptionModif']);
			$prixModif = htmlspecialchars($_POST['prixModif']);
			$imageModifNom = htmlspecialchars($_POST['imageModifNom']);
			$categorieModif = htmlspecialchars($_POST['categorieModif']);
			
			if ($_FILES['imageModif']['name'] != '' && $_GET['modifProdImg1'] == $imageModifNom){
				$imageModif = $_FILES['imageModif'];
				$listExt = array ('png', 'jpg');
				if (upload($_FILES['imageModif'], '10000000', $listExt,'img/img_produits/')){
					$insertion = DBConnection($includeLevel)->prepare('UPDATE produit SET nom = "' . $nomModif . '", description = "' . $descriptionModif . '",
			        prix = "' . $prixModif . '",image = "' . $imageModif['name'] . '", categorie = "' . $categorieModif . '" WHERE nom = "' . $_GET['modifProdNom1'] . '"');
					if($insertion->execute()){
						unlink('img/img_produits/' . $_POST['imageModifNom']);
						$code .= '<h4>Le produit ' . $nomModif . ' a bien &eacute;t&eacute; modifi&eacute;.</h4>';
					}else{
						$code .= '<h4>Erreur lors de la modification</h4>';
					}
				}
				
				$insertion->closeCursor();
			
			}elseif($_FILES['imageModif']['name'] == ''){
				$insertion = DBConnection($includeLevel)->prepare('UPDATE produit SET nom = "' . $nomModif . '", description = "' . $descriptionModif . '",
			    prix = "' . $prixModif . '",image = "' . $imageModifNom . '", categorie = "' . $categorieModif . '" WHERE nom = "' . $_GET['modifProdNom1'] . '"');
				if($insertion->execute()){
					if($_GET['modifProdImg1'] != $imageModifNom){
						rename('img/img_produits/' . $_GET['modifProdImg1'], 'img/img_produits/' . $imageModifNom);
					}
					
					$code .= '<h4>Le produit ' . $nomModif . ' a bien &eacute;t&eacute; modifi&eacute;.</h4>';
				}else{
					$code .= '<h4>Erreur lors de la modification</h4>';
				}
			}else{
				$modif = DBConnection($includeLevel)->prepare('SELECT * FROM produit WHERE nom = ?'); // Envoi de la requ�te
				$modif->execute(array($_GET['modifProdNom1']));
				$donnees = $modif->fetch();
				$modif->closeCursor();
				$id_max = DBConnection($includeLevel)->query('SELECT MIN(categorie_id) AS id_Min, MAX(categorie_id) AS id_Max FROM categorie'); // Envoi de la requ�te
				$id_max->execute();
				$id = $id_max->fetch();
				$id_max->closeCursor();
					
				$code .= '<form id="formulaireModificationProduit" method="post" action="gestions_produits.php?modifProdNom1=' . $donnees['nom'] . '&modifProdImg1=' .$donnees['image'] . '" enctype="multipart/form-data">
					<fieldset style="width: 400px">
					<legend>Modification du produit <span class="gras">' . $donnees['nom'] . '</span></legend>
						Nom : <input type="text" id="nomModif" name="nomModif" value="' . $donnees['nom'] . '"/> <br />
						Description : <textarea id="descriptionModif" name="descriptionModif" cols="30" rows="3">' . $donnees['description'] . '</textarea> <br />
						Prix : <input type="number" min="0" step="0.1" id="prixModif" name="prixModif" value="' . $donnees['prix'] . '"/> €<br />
						Nom image : <input type="text" id="imageModifNom" name="imageModifNom" value="' . $donnees['image'] . '"/> <br />
						Nouvelle image : <input type="file" id="imageModif" name="imageModif"/> <br />
						Cat&eacute;gorie : <input type="number" id="categorieModif" name="categorieModif" min="' . $id['id_Min'] . '" max="' . $id['id_Max'] . '" value="' . $donnees['categorie'] . '"/> <br /><br />
						<input class="droite" type="reset" name="effacer" id="effacer" value="Effacer modification">
						<input class="droite" type="submit" name="modifier" id="modifier" value="Modifier">
					</fieldset>
				</form>
				<h4>Erreur lors de la modification: le nom de l\'image est introuvable.</h4>';	
			}
		}
		
		echo $code;
	}
?>