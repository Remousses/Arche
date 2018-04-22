<?php
    require_once 'includes/fonctions/connexionDB.php';
    
    function getAllAlertes() {
        $tabAlerte = array();

        $reponse = DBconnexion()->prepare('SELECT Id_alerte, Nom_alerte, Informations_alerte, Date_alerte, Statut, espece.Id_espece, Nom_espece, Photo FROM alerte, espece WHERE alerte.Id_espece = espece.Id_espece AND Statut BETWEEN 0 AND 1 ORDER BY Statut');
        $reponse->execute();
        
        while ($donnees = $reponse->fetch()) {
            if(!($donnees['Id_alerte'] == "")){
                $texte = '';
                $statut ='';

                if(isset($_SESSION['Id_groupe'])){ 
                    if($_SESSION['Id_groupe'] == getIdGroupeComite()){ 
                        if($donnees['Statut'] == 0){
                            $statut = 'Attente';
                            $texte = '<a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?approuverAlerte=' . $donnees['Id_alerte'] . '">Approuver</a>';
                        
                        }else if($donnees['Statut'] == 1){
                            $statut = 'Approuvée';
                            $texte = '<a class="mr-3 d-inline-block" data-toggle="modal" onclick="candidater(' . $donnees['Id_alerte'] . ', ' . $donnees['Id_espece'] . ');" data-target="#candidater">Candidater</a>';
                        }

                        $texte .= '<a class="mr-3 d-inline-block" href="voir_projets.php?idAlerte=' . $donnees['Id_alerte'] . '&idEspece=' . $donnees['Id_espece'] . '">Voir les projets</a>
                        <a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?archiverAlerte=' . $donnees['Id_alerte'] . '">Archiver</a>';

                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    }else if($_SESSION['Id_groupe'] == getIdGroupeSentinelle()){ 
                        if($donnees['Statut'] == 0){
                            $statut = 'Attente';
                        }else if($donnees['Statut'] == 1){
                            $statut = 'Approuvée';
                            $texte = '<a class="mr-3 d-inline-block" data-toggle="modal" onclick="candidater(' . $donnees['Id_alerte'] . ', ' . $donnees['Id_espece'] . ');" data-target="#candidater">Candidater</a>
                            <a class="mr-3 d-inline-block" href="voir_projets.php?idAlerte=' . $donnees['Id_alerte'] . '&idEspece=' . $donnees['Id_espece'] . '">Voir les projets</a>';
                        }

                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    
                    }else if($donnees['Statut'] == 1){
                        $texte = '<a class="mr-3 d-inline-block" data-toggle="modal" onclick="candidater(' . $donnees['Id_alerte'] . ', ' . $donnees['Id_espece'] . ');" data-target="#candidater">Candidater</a>';
                        $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                        modalCandidater($donnees['Id_alerte'], $donnees['Id_espece']);
                    }
                }else if($donnees['Statut'] == 1){
                    if(empty($_SESSION)){
                        $texte = '<a class="mr-3 d-inline-block" href="connexion.php">Veuillez vous connecter</a>';
                    }else{
                        $texte = '<a class="mr-3 d-inline-block" href="voir_projets.php?idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '">Voir les projets</a>';
                    }

                    $tabAlerte = voirAlertes($tabAlerte, $statut, $donnees['Id_alerte'], $donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Id_espece'], $donnees['Photo'], $donnees['Date_alerte'], $texte);
                }
            }
        }

        $reponse->closeCursor();
    }

    function getAlerte(){
        $reponse = DBconnexion()->prepare('SELECT Id_alerte, Nom_alerte, Informations_alerte, Photo, Date_alerte, Nom_espece FROM alerte, espece WHERE alerte.Id_espece = espece.Id_espece AND Id_alerte = ' . $_GET['idAlerte'] . ' AND alerte.Id_espece = '. $_GET['idEspece'] . ' AND Statut = 1');
        $reponse->execute();
        
        while ($donnees = $reponse->fetch()) {
            voirAlerte($donnees['Nom_alerte'], $donnees['Informations_alerte'], $donnees['Nom_espece'], $donnees['Photo'], $donnees['Date_alerte'], 0);
        }
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

    function voirNouvellesAlertes(){
        echo '<div class="dropdown-divider"></div>';

        $voirNouvellesAlertes = DBconnexion()->prepare('SELECT Id_alerte, Nom_alerte, Informations_alerte, Date_alerte FROM alerte WHERE Statut = 0 ORDER BY Id_alerte DESC LIMIT 0,3');
        $voirNouvellesAlertes->execute();

        if($voirNouvellesAlertes->rowCount() > 0){
            while($donnees = $voirNouvellesAlertes->fetch()){
                echo '<a class="dropdown-item" href="all_alertes.php#alerte' . $donnees['Id_alerte'] . '"><strong>' . $donnees['Nom_alerte'] . '</strong>
                    <span class="small float-right text-muted">' . dateFr($donnees['Date_alerte']) . '</span>
                    <div class="dropdown-message small">' . $donnees['Informations_alerte'] . '</div>';
            }
        }else{
            echo '<a class="dropdown-item" href="#">Aucune nouvelle alerte</a>';
        }

        echo '<div class="dropdown-message small"></div>';
    }

    function repartitionParticipant(){
        
    }
?>