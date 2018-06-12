<?php 
    require_once 'connexionDB.php';
    require_once 'fonction_diverses.php';
    require_once 'upload.inc.php';

    if(isset($_POST['inscriptionUtilisateur'])){
        if(!empty($_POST['nomUtilisateurInscription']) && !empty($_POST['prenomUtilisateurInscription']) 
        && !empty($_POST['mdpUtilisateurInscription'])) {
            
            $nomUtilisateur = htmlspecialchars($_POST['nomUtilisateurInscription'], ENT_QUOTES, "UTF-8"); // le htmlspecialchars() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $prenomUtilisateur = htmlspecialchars($_POST['prenomUtilisateurInscription'], ENT_QUOTES, "UTF-8");
            $mdpUtilisateur = htmlspecialchars($_POST['mdpUtilisateurInscription'], ENT_QUOTES, "UTF-8");
            
            $inscription = DBconnexion()->prepare('INSERT INTO utilisateur (Nom_utilisateur, Prenom_utilisateur, Mdp_utilisateur, Id_groupe) 
            VALUES ("' . $nomUtilisateur . '", "' . $prenomUtilisateur . '", "' . $mdpUtilisateur . '", 1)');
            
            if($inscription->execute()){
                $inscription->closeCursor();
                header('Location: ../../connexion.php?message=succesInscription');
            }else{
                $inscription->closeCursor();
                header('Location: ../../inscription.php?nomUtilisateurInscription=' . $nomUtilisateur . '&prenomUtilisateurInscription=' . $prenomUtilisateur . '&message=erreurInscription');
            }
        }else{
            $inscription->closeCursor();
            header('Location: ../../inscription.php?message=erreurInscription');
        }
    }

    if(isset($_POST['creerAlerte'])){
        if(!empty($_POST['nomAlerte']) && !empty($_POST['informationsAlerte']) && !empty($_POST['nomEspece'])) {
            $nomAlerte = htmlspecialchars($_POST['nomAlerte'], ENT_QUOTES, "UTF-8"); // le htmlspecialchars() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $informationsAlerte = htmlspecialchars($_POST['informationsAlerte'], ENT_QUOTES, "UTF-8");
            $nomEspece = htmlspecialchars($_POST['nomEspece'], ENT_QUOTES, "UTF-8");
            $date = date("Y-m-d");
            $connexion = DBconnexion();
            $tabNomAlerte = array();
            
            $rechercheNomAlerte = $connexion->prepare('SELECT Nom_alerte FROM alerte WHERE Statut BETWEEN 0 AND 1 AND Nom_alerte = "' . $nomAlerte . '"');

            if($rechercheNomAlerte->execute() && $rechercheNomAlerte->rowCount() == 0){
                $rechercheNomAlerte->closeCursor();
                $creerAlerte = $connexion->prepare('INSERT INTO alerte SET Nom_alerte = "' . $nomAlerte . '", 
                Informations_alerte = "' . $informationsAlerte . '", Date_alerte = "' . $date . '", Statut = 0, 
                Id_espece = (SELECT Id_espece FROM espece WHERE Nom_espece = "' . $nomEspece . '")');
                var_dump($creerAlerte);
                if($creerAlerte->execute()){
                    $creerAlerte->closeCursor();
                    if($creerAlerte->rowCount() > 0){
                        header('Location: ../../all_alertes.php?message=succesAlerte');
                    }else{
                        header('Location: ../../all_alertes.php?message=erreurAlerte');
                    }
                }else{
                    $creerAlerte->closeCursor();
                    header('Location: ../../all_alertes.php?nomAlerte=' . urlencode($nomAlerte) . '&informationsAlerte=' . urlencode($informationsAlerte) . '&nomEspece=' . $nomEspece . '&message=erreurAlerte');
                }
            }else{
                $rechercheNomAlerte->closeCursor();
                header('Location: ../../all_alertes.php?nomAlerte=' . urlencode($nomAlerte) . '&informationsAlerte=' . urlencode($informationsAlerte) . '&nomEspece=' . $nomEspece . '&message=existeAlerte');
            }
        }       
    }

    if(isset($_POST['nouvelleEspece'])){
        if(!empty($_POST['regne']) && !empty($_POST['embranchement']) && !empty($_POST['classe']) && !empty($_POST['ordre']) && !empty($_POST['famille']) && !empty($_POST['genre']) && !empty($_POST['espece']) && !empty($_FILES['photo'])){
            $listExt = array ('png', 'jpg', 'jpeg', 'gif');
            $photo = $_FILES['photo'];

            if (!(upload($photo, '10000000', $listExt, '../../images/especes/'))){
                echo '<h1>Erreur, vous n\'avez pas saisi tous les champs</h1>';
            }
            
            $regne = htmlspecialchars($_POST['regne'], ENT_QUOTES, "UTF-8"); // le htmlspecialchars() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $embranchement = htmlspecialchars($_POST['embranchement'], ENT_QUOTES, "UTF-8");
            $classe = htmlspecialchars($_POST['classe'], ENT_QUOTES, "UTF-8");
            $ordre = htmlspecialchars($_POST['ordre'], ENT_QUOTES, "UTF-8");
            $famille = htmlspecialchars($_POST['famille'], ENT_QUOTES, "UTF-8");
            $genre = htmlspecialchars($_POST['genre'], ENT_QUOTES, "UTF-8");
            $espece = htmlspecialchars($_POST['espece'], ENT_QUOTES, "UTF-8");
            $lienErreur = 'Location: ../../all_alertes.php?regne=' . urlencode($regne) . '&embranchement=' . urlencode($embranchement) . '&classe=' . urlencode($classe) . '&ordre=' . urlencode($ordre) . '&famille=' . urlencode($famille) . '&genre=' . urlencode($genre) . '&espece=' . urlencode($espece) . '&message=erreurEspece';
            $connexion = DBconnexion();

            $rechercheEspece = $connexion->prepare('SELECT Nom_espece FROM espece WHERE Nom_espece = "' . $espece . '"');

            if($rechercheEspece->execute() && $rechercheEspece->rowCount() == 0){
                $rechercheEspece->closeCursor();
                $selectRegne = '(SELECT Id_regne FROM regne WHERE Nom_regne = "' . $regne . '")';
                $selectEmbranchement = '(SELECT Id_embranchement FROM embranchement WHERE Nom_embranchement = "' . $embranchement . '")';
                $selectClasse = '(SELECT Id_classe FROM classe WHERE Nom_classe = "' . $classe . '")';
                $selectOrdre = '(SELECT Id_ordre FROM ordre WHERE Nom_ordre = "' . $ordre . '")';
                $selectFamille = '(SELECT Id_famille FROM famille WHERE Nom_famille = "' . $famille . '")';
                $selectGenre = '(SELECT Id_genre FROM genre WHERE Nom_genre = "' . $genre . '")';
                
                $nouveauRegne = $connexion->prepare('INSERT IGNORE INTO regne SET Nom_regne = "' . $regne . '"');

                if($nouveauRegne->execute()){
                    $nouveauRegne->closeCursor();
                    $nouvelleEmbranchement = $connexion->prepare('INSERT IGNORE INTO embranchement SET Nom_embranchement = "' . $embranchement . '", Id_regne = ' . $selectRegne);
                    
                    if($nouvelleEmbranchement->execute()){
                        $nouvelleEmbranchement->closeCursor();
                        $nouvelleClasse = $connexion->prepare('INSERT IGNORE INTO classe SET Nom_classe = "' . $classe . '", Id_regne = ' . $selectRegne . ', Id_embranchement = ' . $selectEmbranchement);
                        
                        if($nouvelleClasse->execute()){
                            $nouvelleClasse->closeCursor();
                            $nouveauOrdre = $connexion->prepare('INSERT IGNORE INTO ordre SET Nom_ordre = "' . $ordre . '", Id_regne = ' . $selectRegne . ', Id_embranchement = ' . $selectEmbranchement . ', Id_classe = ' . $selectClasse);
                            
                            if($nouveauOrdre->execute()){
                                $nouveauOrdre->closeCursor();
                                $nouvelleFamille = $connexion->prepare('INSERT IGNORE INTO famille SET Nom_famille = "' . $famille . '", Id_regne = ' . $selectRegne . ', Id_embranchement = ' . $selectEmbranchement . ', Id_classe = ' . $selectClasse . ', Id_ordre = ' . $selectOrdre);
                                
                                if($nouvelleFamille->execute()){
                                    $nouvelleFamille->closeCursor();
                                    $nouveauGenre = $connexion->prepare('INSERT IGNORE INTO genre SET Nom_genre = "' . $genre . '", Id_regne = ' . $selectRegne . ', Id_embranchement = ' . $selectEmbranchement . ', Id_classe = ' . $selectClasse . ', Id_ordre = ' . $selectOrdre . ', Id_famille = ' . $selectFamille);
                                    
                                    if($nouveauGenre->execute()){
                                        $nouveauGenre->closeCursor();
                                        $nouvelleEspece = $connexion->prepare('INSERT INTO espece SET Nom_espece = "' . $espece . '", Photo = "' . $photo['name'] . '", Id_regne = ' . $selectRegne . ', Id_embranchement = ' . $selectEmbranchement . ', Id_classe = ' . $selectClasse . ', Id_ordre = ' . $selectOrdre . ', Id_famille = ' . $selectFamille . ', Id_genre = ' . $selectGenre);
                                        
                                        if($nouvelleEspece->execute()){
                                            $nouvelleEspece->closeCursor();
                    
                                            if($nouvelleEspece->rowCount() > 0){
                                                header('Location: ../../all_alertes.php?message=succesEspece');
                                            }else{
                                                header($lienErreur);
                                            }
                                        }else{
                                            $nouvelleEspece->closeCursor();
                                            header($lienErreur);
                                        }
                                    }else{
                                        $nouveauGenre->closeCursor();
                                        header($lienErreur);
                                    }
                                }else{
                                    $nouvelleFamille->closeCursor();
                                    header($lienErreur);
                                }
                            }else{
                                $nouveauOrdre->closeCursor();
                                header($lienErreur);
                            }
                        }else{
                            $nouvelleClasse->closeCursor();
                            header($lienErreur);
                        }
                    }else{
                        $nouvelleEmbranchement->closeCursor();
                        header($lienErreur);
                    }
                }else{
                    $nouveauRegne->closeCursor();
                    header($lienErreur);
                }
            }else{
                $rechercheEspece->closeCursor();
                header('Location: ../../all_alertes.php?regne=' . urlencode($regne) . '&embranchement=' . urlencode($embranchement) . '&classe=' . urlencode($classe) . '&ordre=' . urlencode($ordre) . '&famille=' . urlencode($famille) . '&genre=' . urlencode($genre) . '&espece=' . urlencode($espece) . '&message=existeEspece');
            }
        }
    }

    if(isset($_POST['creerProjet'])){
        if(!empty($_POST['nomProjet']) && !empty($_POST['dateDebutProjet']) && !empty($_POST['dateFinProjet'])  && !empty($_POST['activite'])){
            $nomProjet = htmlspecialchars($_POST['nomProjet'], ENT_QUOTES, "UTF-8"); // le htmlspecialchars() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $dateDebut = htmlspecialchars($_POST['dateDebutProjet'], ENT_QUOTES, "UTF-8");
            $dateFin = htmlspecialchars($_POST['dateFinProjet'], ENT_QUOTES, "UTF-8");
            $activite = htmlspecialchars($_POST['activite'], ENT_QUOTES, "UTF-8");
            $idAlerte = htmlspecialchars($_POST['idAlerte'], ENT_QUOTES, "UTF-8");
            $idEspece = htmlspecialchars($_POST['idEspece'], ENT_QUOTES, "UTF-8");
            $connexion = DBconnexion();
            $rechercherNomProjet = $connexion->prepare('SELECT Nom_projet FROM projet WHERE Nom_projet = "' . $nomProjet . '" AND Id_alerte = ' . $idAlerte);
            $parametreUrl = parametreUrl();

            if(dateEn($dateDebut) != "" && dateEn($dateFin) != "" && intval($idAlerte) > 0 && intval($idEspece) > 0){
                if($rechercherNomProjet->execute() && $rechercherNomProjet->rowCount() == 0){
                    $rechercherNomProjet->closeCursor();
                    
                    $creerProjet = $connexion->prepare('INSERT INTO projet (Nom_projet, Date_debut, Date_fin, Statut, Id_alerte, Id_utilisateur)
                        VALUES ("' . $nomProjet . '", "' . dateEn($dateDebut) . '", "' . dateEn($dateFin) . '", 1, ' . $idAlerte . ', "")');
                    $creerTache = $connexion->prepare('INSERT INTO tache SET Activite = "' . $activite . '", Realisation = "Début", Date_debut = "' . dateEn($dateDebut) . '", Date_fin = "' . dateEn($dateFin) . '", Id_projet = (SELECT Id_projet FROM projet WHERE Nom_projet = "' . $nomProjet . '" AND Id_alerte = ' . $idAlerte . ')');
                    
                    if($creerProjet->execute() && $creerProjet->rowCount() > 0 && $creerTache->execute() && $creerTache->rowCount() > 0 ){
                        $creerTache->closeCursor();
                        $creerProjet->closeCursor();
                        header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&message=succesProjet');
                    }else{
                        $creerTache->closeCursor();
                        $creerProjet->closeCursor();
                        header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&nomProjet=' . urlencode($nomProjet) . '&dateDebutProjet=' . $dateDebut . '&dateFinProjet=' . $dateFin . '&message=erreurProjet');
                    }                
                }else{
                    $rechercherNomProjet->closeCursor();
                    header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&nomProjet=' . urlencode($nomProjet) . '&dateDebutProjet=' . $dateDebut . '&dateFinProjet=' . $dateFin . '&message=existeProjet');
                }
            }else{
                header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&nomProjet=' . urlencode($nomProjet) . '&dateDebutProjet=' . $dateDebut . '&dateFinProjet=' . $dateFin . '&message=erreurDateProjet');
            }
        }
    }

    if(isset($_POST['creerTache'])){
        $activite = '';

        if(!empty($_POST['selectActivite'])){
            $activite = htmlspecialchars($_POST['selectActivite'], ENT_QUOTES, "UTF-8");
        } else if(!empty($_POST['nouvelleActivite'])){
            $activite = htmlspecialchars($_POST['nouvelleActivite'], ENT_QUOTES, "UTF-8");
        }

        if($activite != '' && !empty($_POST['dateDebutTache']) && !empty($_POST['dateFinTache'])){
            $dateDebut = htmlspecialchars($_POST['dateDebutTache'], ENT_QUOTES, "UTF-8");
            $dateFin = htmlspecialchars($_POST['dateFinTache'], ENT_QUOTES, "UTF-8");
            $idAlerte = $_POST['idAlerte'];
            $idEspece = $_POST['idEspece'];
            $idProjet = $_POST['idProjet'];
            $connexion = DBconnexion();

            $rechercherNomProjet = $connexion->prepare('SELECT Nom_projet FROM projet, tache WHERE tache.Id_projet = ' . $idProjet . ' AND Activite = "' . $activite . '" AND tache.Id_projet = projet.Id_projet');
            $parametreUrl = parametreUrl();

            if(dateEn($dateDebut) != "" && dateEn($dateFin) != "" && intval($idAlerte) > 0 && intval($idEspece) > 0){
                if($rechercherNomProjet->execute() && $rechercherNomProjet->rowCount() == 0){
                    $rechercherNomProjet->closeCursor();
                    $creerTache = $connexion->prepare('INSERT INTO tache (Activite, Realisation, Date_debut, Date_fin, Id_projet) VALUES ("' . $activite . '", "Début", "' . dateEn($dateDebut) . '", "' . dateEn($dateFin) . '", ' . $idProjet . ')');
                   
                    if($creerTache->execute() && $creerTache->rowCount() > 0){
                        $creerTache->closeCursor();
                        header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&message=succesTache');
                    }else{
                        $creerTache->closeCursor();
                        header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&idProjet=' . $idProjet . '&nouvelleActivite=' . urlencode($activite) . '&dateDebutTache=' . $dateDebut . '&dateFinTache=' . $dateFin . '&message=erreurTache');
                    }
                }else{
                    $rechercherNomProjet->closeCursor();
                    header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&idProjet=' . $idProjet . '&nouvelleActivite=' . urlencode($activite) . '&dateDebutTache=' . $dateDebut . '&dateFinTache=' . $dateFin . '&message=existeTache');
                }
            }else{
                header('Location: ../../voir_projets.php?nomAlerte=' . $parametreUrl[0] . '&idAlerte=' . $idAlerte . '&idEspece=' . $idEspece . '&idProjet=' . $idProjet . '&nouvelleActivite=' . urlencode($activite) . '&dateDebutTache=' . $dateDebut . '&dateFinTache=' . $dateFin . '&message=erreurDateTache');
            }
        }
    }

    if(isset($_POST['candidaterAlerte'])){
        if(!empty($_POST['informationsCandidater']) && !empty($_POST['roleCandidater'])){
            $informationsCandidater = htmlspecialchars($_POST['informationsCandidater'], ENT_QUOTES, "UTF-8"); // le htmlspecialchars() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $roleCandidater = htmlspecialchars($_POST['roleCandidater'], ENT_QUOTES, "UTF-8");
            $date = date("Y-m-d");
            $idAlerte = $_POST['idAlerteCandidater'];
            $idEspece = $_POST['idEspeceCandidater'];
            
            $candidatureExiste = DBconnexion()->prepare('SELECT * FROM candidater_alerte, alerte WHERE Id_utilisateur = ' . $_SESSION['Id_utilisateur'] . ' AND candidater_alerte.Id_alerte = ' . $idAlerte . ' AND alerte.Id_alerte = candidater_alerte.Id_alerte');

            if($candidatureExiste->execute()){
                $candidatureExiste->closeCursor();
                
                if($candidatureExiste->rowCount() == 0){
                    $candidaterAlerte = DBconnexion()->prepare('INSERT INTO candidater_alerte (Informations_candidater, Role, Statut, Date_candidater, Id_alerte, Id_espece, Id_utilisateur) 
                    VALUE ("' . $informationsCandidater . '", "' . $roleCandidater . '", 0, "' . $date . '", ' . $idAlerte . ', ' . $idEspece . ', ' . $_SESSION['Id_utilisateur'] . ')');
                    
                    if($candidaterAlerte->execute()){
                        $candidaterAlerte->closeCursor();
                        header('Location: ../../all_alertes.php?message=succesCandidature_' . $idAlerte . '#alerte' . $idAlerte);
                    }else{
                        $candidaterAlerte->closeCursor();
                        header('Location: ../../all_alertes.php?message=erreurCandidature_' . $idAlerte . '#alerte' . $idAlerte);
                    }
                }else{
                    header('Location: ../../all_alertes.php?message=existeCandidature_' . $idAlerte . '#alerte' . $idAlerte);
                }
            }else{
                $candidatureExiste->closeCursor();
            }
        }else{
            header('Location: ../../all_alertes.php?message=erreurCandidature_' . $idAlerte . '#alerte' . $idAlerte);
        }
    }
?>