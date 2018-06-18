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
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $utilisateurs->fetch()){
            echo '<tr>
                    <td>' . $donnees['Nom_utilisateur'] . '</td>
                    <td>' . $donnees['Prenom_utilisateur'] . '</td>
                    <td>' . $donnees['Nom_groupe'] . '</td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?modifierUtilisateur=' . $donnees['Id_utilisateur'] . '"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?supprimerUtilisateur=' . $donnees['Id_utilisateur'] . '"><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $utilisateurs->closeCursor();           
?>
        </tbody>
<?php
    }
?>