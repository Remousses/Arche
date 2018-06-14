<?php
    require_once 'includes/fonctions/connexionDB.php';
    
    function getAllAlertes() {
        $tabAlerte = array();

        $reponse = DBconnexion()->prepare('SELECT Id_alerte, Nom_alerte, Informations_alerte, Date_alerte, Statut, espece.Id_espece, Nom_espece, Photo FROM alerte, espece WHERE alerte.Id_espece = espece.Id_espece AND Statut BETWEEN 0 AND 1 ORDER BY Statut');
        $reponse->execute();
        
        while ($donnees = $reponse->fetch()) {
            if(!($donnees['Id_alerte'] == "")){
                $texte = '';
                $statut = '';

                if(isset($_SESSION['Id_groupe'])){
                    $texte = '<a class="mr-3 d-inline-block" href="voir_projets.php?nomAlerte=' . $donnees['Nom_alerte'] . '&idAlerte=' . $donnees['Id_alerte'] . '&idEspece=' . $donnees['Id_espece'] . '">Voir les projets</a>';

                    if($_SESSION['Id_groupe'] == getIdGroupeComite()){
                        if($donnees['Statut'] == 0){
                            $statut = 'Attente';
                            $texte .= '<a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?approuverAlerte=' . $donnees['Id_alerte'] . '">Approuver</a>';
                        
                        }else if($donnees['Statut'] == 1){
                            $statut = 'Approuvée';

                            $nbProjet = DBconnexion()->prepare('SELECT COUNT(Id_projet) AS nbProjet FROM projet WHERE Id_alerte = ' . $donnees['Id_alerte'] . ' AND Statut = 1');
                            $nbParticipant = DBconnexion()->prepare('SELECT COUNT(Id_utilisateur) AS nbParticipant FROM candidater_alerte WHERE Role = "Participer physiquement" And Statut = 1 AND Id_alerte = ' . $donnees['Id_alerte']);
                            
                            if($nbParticipant->execute() && $nbProjet->execute()){
                                $donneesNbProjet = $nbProjet->fetch();
                                $donneesNbParticipant = $nbParticipant->fetch();
                                
                                if($donneesNbProjet['nbProjet'] > 0){
                                    $repartition = $donneesNbParticipant['nbParticipant'] / $donneesNbProjet['nbProjet'];
                                    
                                    if($repartition >= 1){
                                        $texte .= '<a class="mr-3 d-inline-block" href="includes/fonctions/fonction_repartition.php?idAlerte=' . $donnees['Id_alerte'] . '&nbProjet=' . $donneesNbProjet['nbProjet'] . '&nbParticipant=' . $donneesNbParticipant['nbParticipant'] . '">Répartition des candidats</a>';
                                    }
                                }
                            }

                            $nbProjet->closeCursor();
                            $nbParticipant->closeCursor();
                        }

                        $texte .= '<a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?archiverAlerte=' . $donnees['Id_alerte'] . '">Archiver</a>';

                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);

                    }else if($_SESSION['Id_groupe'] == getIdGroupeSentinelle()){ 
                        if($donnees['Statut'] == 0){
                            $statut = 'Attente';
                        }else if($donnees['Statut'] == 1){
                            $statut = 'Approuvée';
                        }

                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    
                    }else if($_SESSION['Id_groupe'] == getIdGroupeVisiteur() && $donnees['Statut'] == 1){
                        $texte .= '<a href="#" class="mr-3 d-inline-block" data-toggle="modal" onclick="candidater(' . $donnees['Id_alerte'] . ', ' . $donnees['Id_espece'] . ');" data-target="#candidater">Candidater</a>';

                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    
                    }else if($donnees['Statut'] == 1){
                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    }
                }else if($donnees['Statut'] == 1){
                    if(empty($_SESSION)){
                        $texte .= '<a class="mr-3 d-inline-block" href="connexion.php">Veuillez vous connecter</a>';
                    }

                    $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                }
            }
        }

        $reponse->closeCursor();
    }

    function voirNouvellesAlertes(){
        echo '<div class="dropdown-divider"></div>';

        $voirNouvellesAlertes = DBconnexion()->prepare('SELECT Id_alerte, Nom_alerte, Informations_alerte, Date_alerte FROM alerte WHERE Statut = 0 ORDER BY Id_alerte DESC LIMIT 0,3');
        $voirNouvellesAlertes->execute();

        if($voirNouvellesAlertes->rowCount() > 0){
            while($donnees = $voirNouvellesAlertes->fetch()){
                echo '<a class="dropdown-item" href="all_alertes.php#alerte' . $donnees['Id_alerte'] . '"><strong>' . $donnees['Nom_alerte'] . '</strong>
                    <span class="small float-right text-muted">' . dateFr($donnees['Date_alerte']) . '</span>
                    <div class="dropdown-message small">' . $donnees['Informations_alerte'] . '</div></a>';
            }
        }else{
            echo '<a class="dropdown-item" href="#">Aucune nouvelle alerte</a>';
        }

        $voirNouvellesAlertes->closeCursor();
        echo '<div class="dropdown-message small"></div>';
    }

    function nbNouvellesAlertes(){
        $nbNouvellesAlertes = DBconnexion()->prepare('SELECT COUNT(Id_alerte) AS nbNouvellesAlertes FROM alerte WHERE Statut = 0');
        $nbNouvellesAlertes->execute();
        $donnees = $nbNouvellesAlertes->fetch();

        if($donnees['nbNouvellesAlertes'] == 0){
            echo '';
        }else{
            echo $donnees['nbNouvellesAlertes'] . '<span class="indicator text-warning d-none d-lg-block">
                    <i class="fa fa-fw fa-circle"></i>
                </span>';
        }
    }
?>