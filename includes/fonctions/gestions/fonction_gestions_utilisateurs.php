<?php
    function getUtilisateur(){
        $utilisateurs = $GLOBALS['connexion']->prepare('SELECT Id_utilisateur, Nom_utilisateur, Prenom_utilisateur, Nom_groupe FROM utilisateur, groupe WHERE utilisateur.Id_groupe = groupe.Id_groupe');
        $utilisateurs->execute();
?>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Groupe</th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $utilisateurs->fetch()){
            echo '<tr>
                    <td class="vertical_align">' . $donnees['Nom_utilisateur'] . '</td>
                    <td class="vertical_align">' . $donnees['Prenom_utilisateur'] . '</td>
                    <td class="vertical_align">' . $donnees['Nom_groupe'] . '</td>
                    <td class="vertical_align"><a href="#"><i class="fa fa-ban"></i></a></td>
                </tr>';
        }

        $utilisateurs->closeCursor();           
?>
        </tbody>
<?php
    }
?>