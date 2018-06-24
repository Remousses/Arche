<?php
    function getSalarie(){
        $salaries = $GLOBALS['connexion']->prepare('SELECT Id_salarie, Nom_salarie, Prenom_salarie, Poste, Nom_site FROM salarie, site WHERE salarie.Id_site = site.Id_site');
        $salaries->execute();
?>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Poste</th>
                <th>Bureau</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $salaries->fetch()){
            echo '<tr>
                    <td class="vertical_align">' . $donnees['Nom_salarie'] . '</td>
                    <td class="vertical_align">' . $donnees['Prenom_salarie'] . '</td>
                    <td class="vertical_align">' . $donnees['Poste'] . '</td>
                    <td class="vertical_align">' . $donnees['Nom_site'] . '</td>
                    <td class="vertical_align"><a href="#"><i class="fa fa-edit"></i></a></td>
                    <td class="vertical_align"><a href="#"><i class="fa fa-close"></i></a></td>
                </tr>';
        }
        $salaries->closeCursor();           
?>
        </tbody>
<?php
    }
?>