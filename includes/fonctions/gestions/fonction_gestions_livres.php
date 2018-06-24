<?php
    function getAllLivre(){
        $tabProjet = array();
        $livres = $GLOBALS['connexion']->prepare('SELECT Titre, Narration, Date, livre_sauvetage.Id_projet, Nom_utilisateur, Prenom_utilisateur, 
        alerte.Id_alerte, Nom_alerte, projet.Statut, espece.Id_espece, Nom_espece, Photo FROM livre_sauvetage 
        LEFT JOIN utilisateur ON utilisateur.Id_utilisateur = livre_sauvetage.Id_utilisateur 
        LEFT JOIN projet ON projet.Id_projet = livre_sauvetage.Id_projet 
        LEFT JOIN alerte ON alerte.Id_alerte = projet.Id_alerte 
        LEFT JOIN espece ON espece.Id_espece = alerte.Id_espece
        ORDER BY projet.Statut');
        $livres->execute();

        if($livres->rowCount() > 0){
            while($donnees = $livres->fetch()){                
                if(!in_array($donnees['Statut'], $tabProjet)){
                    array_push($tabProjet, $donnees['Statut']);
                    echo '<ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <a href="livres.php">Livre de sauvetage</a>
                        </li>';
            
                    if($donnees['Statut'] == 1){
                        echo '<li class="breadcrumb-item active">Projet en cours';
                    }else if($donnees['Statut'] == 2){
                        echo '<li class="breadcrumb-item active">Projet terminé';
                    }
            
                    echo '</li>
                        </ol>';
                }
                
                echo '<div class="card mb-3">';

                if($donnees['Statut'] == 1){
                    echo '<a href="voir_projets.php?nomAlerte=' . $donnees['Nom_alerte'] . '&idAlerte=' . $donnees['Id_alerte'] . '&idEspece=' . $donnees['Id_espece'] . '">
                            <div class="text-center p-4">
                                <img class="image_livre" src="images/especes/' . $donnees['Photo'] . '" alt="' . $donnees['Nom_espece'] . '"/>
                            </div>
                        </a>';
                }else if($donnees['Statut'] == 2){
                    echo '<div class="text-center p-4">
                            <img class="image_livre" src="images/especes/' . $donnees['Photo'] . '" alt="' . $donnees['Nom_espece'] . '"/>
                        </div>';
                }
                
                echo '<div class="card-body">
                        <h6 class="card-title mb-1"><a href="#">' . $donnees['Titre'] . '</a></h6>
                        <p class="card-text small">' . $donnees['Narration'] . '</p>
                    </div>';
    
                    if(isset($_SESSION['Id_groupe']) && $_SESSION['Id_groupe'] == getIdGroupeNarrateur()){
                        echo '<hr class="my-0">
                            <div class="card-body py-2 small">
                                <a class="mr-3 d-inline-block" href="#">Modifier</a>
                            </div>';
                    }
    
                echo '<div class="card-footer small text-muted">
                        <span class="mr-3 d-inline-block">Posté le ' . dateFr($donnees['Date']) . '</span>
                        <span class="mr-3 d-inline-block">Ecrit par : ' . $donnees['Nom_utilisateur'] . ' ' . $donnees['Prenom_utilisateur'] . '
                    </div>
                </div>';
            }
        }else{
            echo '<ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="livres.php">Livre de sauvetage</a>
                    </li>
                    <li class="breadcrumb-item active">Aucun livre de sauvetage n\'a été écrit</li>
                    </ol>';
        }

        $livres->closeCursor();
    }