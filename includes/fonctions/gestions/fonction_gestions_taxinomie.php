<?php
    function getTaxinomie(){
        $taxinomie = $GLOBALS['connexion']->prepare('SELECT Nom_regne, Nom_embranchement, Nom_classe, Nom_ordre, Nom_famille, Nom_genre, Id_espece, Nom_espece, Photo FROM espece
        LEFT JOIN regne ON espece.Id_regne = regne.Id_regne
        LEFT JOIN embranchement ON espece.Id_embranchement = embranchement.Id_embranchement
        LEFT JOIN classe ON espece.Id_classe = classe.Id_classe
        LEFT JOIN ordre ON espece.Id_ordre = ordre.Id_ordre 
        LEFT JOIN famille ON espece.Id_famille = famille.Id_famille
        LEFT JOIN genre ON espece.Id_genre = genre.Id_genre
        ORDER BY Nom_espece');
        
        $taxinomie->execute();
        $nbColonne = 4;
?>
        <thead>
            <tr>
                <?php
                    for($nbCol = 0; $nbCol < $nbColonne; $nbCol ++){
                        echo '<th class="d-none"></th>';
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
<?php
                $i = 0;
                while($donnees = $taxinomie->fetch()){
                    echo '<td id="activeHover" class="text-center taxinomie" data-toggle="modal" onclick="taxinomie(' . $donnees['Id_espece'] . ');" data-target="#taxinomie"><img class="image_taxinomie" src="images/especes/' . $donnees['Photo'] . '" alt="' . $donnees['Nom_espece'] . '"><br>' . $donnees['Nom_espece'] . '</td>';
                    $i ++;

                    if($i == $nbColonne){
                        $i = 0;
                        echo '</tr><tr>';
                    }
                }
                $taxinomie->closeCursor();

                for($nbCol = 0; $nbCol < $nbColonne - $i; $nbCol ++){
                    echo '<td class="taxinomie"></td>';
                }
?>
            </tr>
        </tbody>
        
        <div class="modal fade" id="taxinomie" tabindex="-1" role="dialog" aria-labelledby="taxinomieLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modalTaxinomie"></div>
            </div>
        </div>
<?php
    }
?>