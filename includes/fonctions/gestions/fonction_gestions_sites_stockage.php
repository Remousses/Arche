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
                    <td class="vertical_align">' . $donnees['Nom_site'] . '</td>
                    <td class="vertical_align">' . $donnees['Rue'] . '</td>
                    <td class="vertical_align">' . $donnees['Code_postal'] . '</td>
                    <td class="vertical_align">' . $donnees['Commune'] . '</td>
                    <td class="vertical_align">' . $donnees['Pays'] . '</td>
                    <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                    <td class="vertical_align"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $sites->closeCursor();           
?>
        </tbody>
<?php
    }
?>