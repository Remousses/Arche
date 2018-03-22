<?php 
    require 'connexionDB.php';

    function gestion_page_produits($includeLevel){
        $code = '';

        if(isset($_GET['categorie']) && !(empty($_GET['categorie']))){
            $reponse = DBConnection($includeLevel)->query('SELECT image, nom, description, prix, produit_id, categorie_id, libelle FROM produit, categorie WHERE categorie = "' . $_GET['categorie'] . '" and categorie_id = ' . $_GET['categorie']); // Envoi de la requ�te
            $categorie = $reponse->fetch();

            if(!(empty($categorie['categorie_id']))){
                $code .= '<div class="titre">
                <h1><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee> ' . $categorie['libelle'] . ' <marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h1>
                </div>
                <table class="coller">
                <tr>
                <th class="tableau">Image</th>
                <th class="tableau">Nom</th>
                <th class="tableau">Description</th>
                <th class="tableau">Prix</th>
                </tr>';
                
                while ($donnees = $reponse->fetch()) {
                    $code .= '<tr>
                    <td class="tableau"><img alt="'. $donnees['nom'] . '" src="img/img_produits/' .  $donnees['image']  . '" height="200px"></td>
                    <td class="tableau">' . $donnees['nom'] . '</td>
                    <td class="tableau">' . $donnees['description'] . '</td>
                    <td class="tableau">' . $donnees['prix'] . ' &euro;</span></td>';
                    
                    if(!(empty($_SESSION['pseudoUser']))){
                        $code .= '<td class="tableau">
                        <form method="post" action="includes/fonctions/fonction_panier.php">
                            <input type="hidden" name="idProduit" value="' . $donnees['produit_id'] . '">
                            <input type="hidden" name="action" value="ajout">
                            <input type="number" name="quantiteProduit" value="1" min="1">
                            <button name="ajouterArticle"><img class="image_panier" alt="Panier" src="img/img_logo/Logo_Panier.png"></button></td>
                        </form>
                        ';
                    }

                    $code .= '</tr>';
                }

                $code .= '</table>'; // Fin du tableau
                $reponse->closeCursor();

            }else{
                $reponse->closeCursor();
                $code .= '<script>alert("Cette page n\'existe pas. Redirection sur la page d\'accueil");location="index.php"</script>';
            }
        }else{
            $code .= '<script>alert("Cette page n\'existe pas. Redirection sur la page d\'accueil");location="index.php"</script>';
        }
        
        echo $code;
    }
?>