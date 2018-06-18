<?php
    function getSiteStockage(){
        $sites = $GLOBALS['connexion']->prepare('SELECT Id_site, Nom_site, Rue, Code_postal, Commune, Pays FROM site');
        $sites->execute();
?>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Rue</th>
                <th>Code postal</th>
                <th>Commune</th>
                <th>Pays</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $sites->fetch()){
            echo '<tr>
                    <td>' . $donnees['Nom_site'] . '</td>
                    <td>' . $donnees['Rue'] . '</td>
                    <td>' . $donnees['Code_postal'] . '</td>
                    <td>' . $donnees['Commune'] . '</td>
                    <td>' . $donnees['Pays'] . '</td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?modifierSite=' . $donnees['Id_site'] . '"><i class="fa fa-edit"></i></a></td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?supprimerSite=' . $donnees['Id_site'] . '"><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $sites->closeCursor();           
?>
        </tbody>
<?php
    }
?>