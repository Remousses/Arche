<?php
    echo '<span>Vous avez recherch&eacute; : ' . $_GET['chainesearch'] . '</span><br /><br />';
    echo 'Les r&eacute;sultats de recherche sont : <br /><br />';
    while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo $donnees['nom'] .'<br />';
        echo '<img alt="'. $donnees['nom'] . '" src="img/img_produits/' .  $donnees['image']  . '" height="200px"><br />';
        echo $donnees['prix'] .' €<br />';
        echo $donnees['description'] .'<br />';
    }
?>