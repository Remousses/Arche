<?php
    function getTaxinomie(){
        $taximonie = DBconnexion()->prepare('SELECT Nom_regne, Nom_embranchement, Nom_classe, Nom_ordre, Nom_famille, Nom_genre, Nom_espece FROM espece
        LEFT JOIN regne ON espece.Id_regne = regne.Id_regne
        LEFT JOIN embranchement ON espece.Id_embranchement = embranchement.Id_embranchement
        LEFT JOIN classe ON espece.Id_classe = classe.Id_classe
        LEFT JOIN ordre ON espece.Id_ordre = ordre.Id_ordre
        LEFT JOIN famille ON espece.Id_famille = famille.Id_famille
        LEFT JOIN genre ON espece.Id_genre = genre.Id_genre');
        $taximonie->execute();
?>
        <thead>
            <tr>
                <th>Règne</th>
                <th>Embranchement</th>
                <th>Classe</th>
                <th>Ordre</th>
                <th>Famille</th>
                <th>Genre</th>
                <th>Espèce</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $taximonie->fetch()){
            echo '<tr>
                    <td>' . $donnees['Nom_regne'] . '</td>
                    <td>' . $donnees['Nom_embranchement'] . '</td>
                    <td>' . $donnees['Nom_classe'] . '</td>
                    <td>' . $donnees['Nom_ordre'] . '</td>
                    <td>' . $donnees['Nom_famille'] . '</td>
                    <td>' . $donnees['Nom_genre'] . '</td>
                    <td>' . $donnees['Nom_espece'] . '</td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php"><i class="fa fa-close"></i></a></td>'; //?idAlerte=' . $donnees['Id_alerte'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&approuverCandidature=
                    echo '<td class="text-center"><a href="includes/fonctions/fonction_validation.php"><i class="fa fa-close"></i></a></td>'; //?idAlerte=' . $donnees['Id_alerte'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&archiverCandidature=
                echo '</tr>';
        }

        $taximonie->closeCursor();        
        echo '</tbody>';
    }
?>