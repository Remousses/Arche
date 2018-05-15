<?php
    function nbNouvellesCandidatures(){
        $nouvellesCandidatures = DBconnexion()->prepare('SELECT COUNT(Statut) AS nouvellesCandidatures FROM candidater_alerte WHERE Statut = 0');
        $nouvellesCandidatures->execute();
        $donnees = $nouvellesCandidatures->fetch();

        if($donnees['nouvellesCandidatures'] == 0){
            echo '';
        }else{
            echo $donnees['nouvellesCandidatures'] . '<span class="indicator text-primary d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>';
        }
    }

    function voirNouvellesCandidatures(){
        echo '<div class="dropdown-divider"></div>';

        $voirNouvellesCandidatures = DBconnexion()->prepare('SELECT Date_candidater, Nom_alerte, Nom_utilisateur, Prenom_utilisateur FROM candidater_alerte, utilisateur, alerte WHERE candidater_alerte.Statut = 0 AND candidater_alerte.Id_utilisateur = utilisateur.Id_utilisateur AND candidater_alerte.Id_alerte = alerte.Id_alerte ORDER BY Date_candidater DESC LIMIT 0,3');
        $voirNouvellesCandidatures->execute();

        if($voirNouvellesCandidatures->rowCount() > 0){
            while($donnees = $voirNouvellesCandidatures->fetch()){
                echo '<a class="dropdown-item" href="candidatures.php#' . $donnees['Nom_utilisateur'] . ' ' . $donnees['Prenom_utilisateur'] . '"><strong>' . $donnees['Nom_utilisateur'] . ' ' . $donnees['Prenom_utilisateur'] . '</strong>
                    <span class="small float-right text-muted">' . dateFr($donnees['Date_candidater']) . '</span>
                    <div class="dropdown-message small">' . $donnees['Nom_alerte'] . '</div></a>';
            }
        }else{
            echo '<a class="dropdown-item" href="#">Aucune nouvelle candidature</a>';
        }

        $voirNouvellesCandidatures->closeCursor();
        echo '<div class="dropdown-message small"></div>';
    }

    function getCandidatures(){
        $candidatures = DBconnexion()->prepare('SELECT Informations_candidater, Date_candidater, alerte.Id_alerte, Nom_alerte, utilisateur.Id_utilisateur, Nom_utilisateur, Prenom_utilisateur FROM candidater_alerte, utilisateur, alerte WHERE candidater_alerte.Statut = 0 AND candidater_alerte.Id_utilisateur = utilisateur.Id_utilisateur AND candidater_alerte.Id_alerte = alerte.Id_alerte ORDER BY Date_candidater DESC');
        $candidatures->execute();
?>      <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Alerte</th>
                <th>Informations</th>
                <th>Date</th>
                <th class="d-none"></th>
                <th class="d-none"></th>
            </tr>
        </thead>
        <tbody>
<?php
        while($donnees = $candidatures->fetch()){
            echo '<tr>
                    <td>' . $donnees['Nom_utilisateur'] . '</td>
                    <td>' . $donnees['Prenom_utilisateur'] . '</td>	
                    <td>' . $donnees['Nom_alerte'] . '</td>
                    <td>' . $donnees['Informations_candidater'] . '</td>
                    <td>' . dateFr($donnees['Date_candidater']) . '</td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?idAlerte=' . $donnees['Id_alerte'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&approuverCandidature="><i class="fa fa-check"></i></a></td>
                    <td class="text-center"><a href="includes/fonctions/fonction_validation.php?idAlerte=' . $donnees['Id_alerte'] . '&idUtilisateur=' . $donnees['Id_utilisateur'] . '&archiverCandidature="><i class="fa fa-close"></i></a></td>
                </tr>';
        }

        $candidatures->closeCursor();        
        echo '</tbody>';
    }
?>