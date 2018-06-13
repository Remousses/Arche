<?php
    function getTaxinomie(){
        $taximonie = DBconnexion()->prepare('SELECT Nom_regne, Nom_embranchement, Nom_classe, Nom_ordre, Nom_famille, Nom_genre, Nom_espece, Photo FROM espece
        LEFT JOIN regne ON espece.Id_regne = regne.Id_regne
        LEFT JOIN embranchement ON espece.Id_embranchement = embranchement.Id_embranchement
        LEFT JOIN classe ON espece.Id_classe = classe.Id_classe
        LEFT JOIN ordre ON espece.Id_ordre = ordre.Id_ordre
        LEFT JOIN famille ON espece.Id_famille = famille.Id_famille
        LEFT JOIN genre ON espece.Id_genre = genre.Id_genre');
        $taximonie->execute();
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
        while($donnees = $taximonie->fetch()){
            echo '<td class="text-center td-hover"><img src="images/especes/' . $donnees['Photo'] . '" height=200px width=230px><br>' . $donnees['Nom_espece'] . '<br><br></td>';
            $i ++;

            if($i == $nbColonne){
                $i = 0;
                echo '</tr><tr>';
            }
        }
echo '<td class="d-none"></td>';
        $taximonie->closeCursor();        
        echo '</tr>
        </tbody>';
    }
?>