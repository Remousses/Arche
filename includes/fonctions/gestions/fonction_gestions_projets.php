<?php
    function profilUtilisateur(){
        $tabAlerte = array();
        $nbAlerte = array();
        $nbProjet = array();

        $profil = DBconnexion()->prepare('SELECT Id_projet, Nom_projet, Date_debut, Date_fin, alerte.Id_alerte, Nom_alerte, alerte.Statut FROM projet, alerte WHERE Id_utilisateur LIKE "%|' . $_SESSION['Id_utilisateur'] . '|%" AND projet.Id_alerte = alerte.Id_alerte ORDER BY alerte.Id_alerte, alerte.Statut, Date_debut');
        $profil->execute();

        if($profil->rowCount() > 0){
            while ($donnees = $profil->fetch()) {
                if(!in_array($donnees['Statut'], $tabAlerte)){
                    array_push($tabAlerte, $donnees['Statut']);
                    
                    echo '<ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="profil.php">Profil</a>
                    </li>
                    <li class="breadcrumb-item active">Projets ';

                    if($donnees['Statut'] == 1){
                        echo 'En cours';
                    }else if($donnees['Statut'] == 2){
                        echo 'Terminée';
                    }
                }

                echo '</li>
                    </ol>
                    <div class="card mb-3">
                        <div class="card-body">';

                if(!in_array($donnees['Id_alerte'], $nbAlerte)){
                    array_push($nbAlerte, $donnees['Id_alerte']);
                    echo '<h6 class="card-title mb-1">Nom de l\'alerte : ' . $donnees['Nom_alerte'] . '</h6>';
                    
                    if(!in_array($donnees['Id_projet'], $nbProjet)){
                        array_push($nbProjet, $donnees['Id_projet']);
                        echo '<p class="card-text small">Nom du projet : ' . $donnees['Nom_projet'] . '</p>
                            <p class="card-text small">Du ' . $donnees['Date_debut'] . ' au ' . $donnees['Date_fin'] . '</p>';
                    }
                }

                echo '</div>
                    </div>';
            }

            $profil->closeCursor();

        }else{
            $profil->closeCursor();
            echo '<script>document.location.href="index.php?message=erreurProfil";</script>';
        }
    }

    function getAllProjetParAlerte(){
        $nbProjet = array();
        $projetParAlerte = DBconnexion()->prepare('SELECT projet.Id_projet AS IdProjet, Nom_projet, projet.Date_debut AS DateDebutProjet, projet.Date_fin AS DateFinProjet, alerte.Id_alerte AS IdAlerte, Activite, Realisation, tache.Date_debut AS DateDebutTache, tache.Date_fin AS DateFinTache FROM alerte, projet, tache WHERE alerte.Id_alerte = ' . $_GET['idAlerte'] . ' AND alerte.Id_alerte = projet.Id_alerte AND projet.Id_projet = tache.Id_projet ORDER BY projet.Id_projet, DateDebutProjet, DateDebutTache');
        $projetParAlerte->execute();

        if($projetParAlerte->rowCount() > 0){
            while ($donnees = $projetParAlerte->fetch()) {
                $nbProjet = voirProjets($nbProjet, $donnees['IdProjet'], $donnees['IdAlerte'], $donnees['Nom_projet'], $donnees['DateDebutProjet'], $donnees['DateFinProjet'], $donnees['Activite'], $donnees['Realisation'], $donnees['DateDebutTache'], $donnees['DateFinTache']);
            }

            $projetParAlerte->closeCursor();
        }else{
            $projetParAlerte->closeCursor();
            echo '<script language="Javascript">
                    document.location.replace("all_alertes.php?message=erreurProjet_' . $_GET['idAlerte'] . '#alerte' . $_GET['idAlerte'] . '");
            </script>';
        }
    }
?>