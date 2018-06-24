<?php
    function nbNouvellesCandidatures(){
        $nbNouvellesCandidatures = $GLOBALS['connexion']->prepare('SELECT COUNT(Statut) AS nbNouvellesCandidatures FROM candidater_alerte WHERE Statut = 0');
        $nbNouvellesCandidatures->execute();
        $donnees = $nbNouvellesCandidatures->fetch();

        if($donnees['nbNouvellesCandidatures'] == 0){
            echo '';
        }else{
            echo $donnees['nbNouvellesCandidatures'] . '<span class="indicator text-primary d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>';
        }
    }

    function voirNouvellesCandidatures(){
        echo '<div class="dropdown-divider"></div>';

        $voirNouvellesCandidatures = $GLOBALS['connexion']->prepare('SELECT Date_candidater, Nom_alerte, Nom_utilisateur, Prenom_utilisateur FROM candidater_alerte, utilisateur, alerte WHERE candidater_alerte.Statut = 0 AND candidater_alerte.Id_utilisateur = utilisateur.Id_utilisateur AND candidater_alerte.Id_alerte = alerte.Id_alerte ORDER BY Date_candidater DESC LIMIT 0,3');
        $voirNouvellesCandidatures->execute();

        if($voirNouvellesCandidatures->rowCount() > 0){
            while($donnees = $voirNouvellesCandidatures->fetch()){
                echo '<a class="dropdown-item" href="candidatures.php#' . $donnees['Nom_utilisateur'] . ' ' . $donnees['Prenom_utilisateur'] . '"><strong>' . $donnees['Nom_utilisateur'] . ' ' . $donnees['Prenom_utilisateur'] . '</strong>
                    <span class="small float-right text-muted">' . dateFr($donnees['Date_candidater']) . '</span>
                    <div class="dropdown-message small">' . $donnees['Nom_alerte'] . '</div></a>';
            }
        }else{
            echo '<span class="dropdown-item">Aucune nouvelle candidature</span>';
        }

        $voirNouvellesCandidatures->closeCursor();
        echo '<div class="dropdown-message small"></div>';
    }
?>