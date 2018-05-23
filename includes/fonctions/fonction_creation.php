<?php 
    require_once 'connexionDB.php';

    if(isset($_POST['inscriptionUtilisateur'])){
        if(!empty($_POST['nomUtilisateurInscription']) && !empty($_POST['prenomUtilisateurInscription']) 
        && !empty($_POST['mdpUtilisateurInscription'])) {
            
            $nomUtilisateur = htmlentities($_POST['nomUtilisateurInscription'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $prenomUtilisateur = htmlentities($_POST['prenomUtilisateurInscription'], ENT_QUOTES, "UTF-8");
            $mdpUtilisateur = htmlentities($_POST['mdpUtilisateurInscription'], ENT_QUOTES, "UTF-8");
            
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
            $nomAlerte = htmlentities($_POST['nomAlerte'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $informationsAlerte = htmlentities($_POST['informationsAlerte'], ENT_QUOTES, "UTF-8");
            $nomEspece = htmlentities($_POST['nomEspece'], ENT_QUOTES, "UTF-8");
            $date = date("Y-m-d");
            $connexion = DBconnexion();
            $tabNomAlerte = array();
            
            $rechercheNomAlerte = $connexion->prepare('SELECT Nom_alerte FROM alerte WHERE Statut BETWEEN 0 AND 1');
            $rechercheNomAlerte->execute();
            
            while($donnee = $rechercheNomAlerte->fetch()){
                if(!in_array($donnee['Nom_alerte'], $tabNomAlerte)){
                    array_push($tabNomAlerte, $donnee['Nom_alerte']);
                }
            }
            
            $rechercheNomAlerte->closeCursor();
            
            if(!in_array($nomAlerte, $tabNomAlerte)){
                $creerAlerte = $connexion->prepare('INSERT INTO alerte SET Nom_alerte = "' . $nomAlerte . '", 
                Informations_alerte = "' . $informationsAlerte . '", Date_alerte = "' . $date . '", Statut = 0, 
                Id_espece = (SELECT Id_espece FROM espece WHERE Nom_espece = "' . $nomEspece . '")');
                
                if($creerAlerte->execute()){
                    $creerAlerte->closeCursor();
                    if($creerAlerte->rowCount() > 0){
                        header('Location: ../../all_alertes.php?message=succesAlerte');
                    }else{
                        header('Location: ../../all_alertes.php?message=erreurAlerte');
                    }
                }else{
                    $creerAlerte->closeCursor();
                    header('Location: ../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informationsAlerte=' . $informationsAlerte . '&nomEspece=' . $nomEspece . '&message=erreurAlerte');
                }
            }else{
                header('Location: ../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informationsAlerte=' . $informationsAlerte . '&nomEspece=' . $nomEspece . '&message=existeAlerte');
            }
        }else{
            header('Location: ../../all_alertes.php?nomAlerte=' . $nomAlerte . '&informationsAlerte=' . $informationsAlerte . '&nomEspece=' . $nomEspece . '&message=existeAlerte');
        }        
    }

    if(isset($_POST['nouvelleEspece'])){
        if(!empty($_POST['regne']) && !empty($_POST['embranchement']) && !empty($_POST['classe']) && !empty($_POST['ordre']) && !empty($_POST['famille']) && !empty($_POST['genre']) && !empty($_POST['espece']) && !empty($_FILES['photo'])){
            $listExt = array ('png', 'jpg', 'jpeg', 'gif');
            $photo = $_FILES['photo'];

            if (!(upload($photo, '10000000', $listExt, '../../images/especes/'))){
                echo '<h1>Erreur, vous n\'avez pas saisi tous les champs</h1>';
            }
            
            $regne = htmlentities($_POST['regne'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $embranchement = htmlentities($_POST['embranchement'], ENT_QUOTES, "UTF-8");
            $classe = htmlentities($_POST['classe'], ENT_QUOTES, "UTF-8");
            $ordre = htmlentities($_POST['ordre'], ENT_QUOTES, "UTF-8");
            $famille = htmlentities($_POST['famille'], ENT_QUOTES, "UTF-8");
            $genre = htmlentities($_POST['genre'], ENT_QUOTES, "UTF-8");
            $espece = htmlentities($_POST['espece'], ENT_QUOTES, "UTF-8");
            $lienErreur = 'Location: ../../all_alertes.php?regne=' . $regne . '&embranchement=' . $embranchement . '&classe=' . $classe . '&ordre=' . $ordre . '&famille=' . $famille . '&genre=' . $genre . '&espece=' . $espece . '&message=erreurEspece';
            $connexion = DBconnexion();
            // $tabNomEspece = array();
            
            // $rechercheNomEspece = $connexion->prepare('SELECT Nom_espece FROM espece');
            // $rechercheNomEspece->execute();
            
            // while($donnee = $rechercheNomEspece->fetch()){
            //     if(!in_array($donnee['Nom_espece'], $tabNomEspece)){
            //         array_push($tabNomEspece, $donnee['Nom_espece']);
            //     }
            // }
            
            // $rechercheNomEspece->closeCursor();
            
            //if(!in_array($espece, $tabNomEspece)){
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
            // }else{
            //     header($lienErreur);
            // }
        }
    }

    if(isset($_POST['candidaterAlerte'])){
        if(!empty($_POST['informationsCandidater']) && !empty($_POST['roleCandidater'])){
            $informationsCandidater = htmlentities($_POST['informationsCandidater'], ENT_QUOTES, "UTF-8"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $roleCandidater = htmlentities($_POST['roleCandidater'], ENT_QUOTES, "UTF-8");
            $date = date("Y-m-d");
            $idAlerte = $_POST['idAlerteCandidater'];
            $idEspece = $_POST['idEspeceCandidater'];
            
            $candidatureExiste = DBconnexion()->prepare('SELECT * FROM candidater_alerte, alerte WHERE Id_utilisateur = ' . $_SESSION['Id_utilisateur'] . ' AND candidater_alerte.Id_alerte = ' . $idAlerte . ' AND alerte.Id_alerte = candidater_alerte.Id_alerte');

            if($candidatureExiste->execute()){
                $candidatureExiste->closeCursor();
                
                if($candidatureExiste->rowCount() == 0){
                    $candidaterAlerte = DBconnexion()->prepare('INSERT INTO candidater_alerte (Informations_candidater, Role, Statut, Date_candidater, Id_alerte, Id_espece, Id_utilisateur) 
                    VALUE ("' . $informationsCandidater . '", "' . $roleCandidater . '", 0, "' . $date . '", ' . $idAlerte . ', ' . $idEspece . ', ' . $_SESSION['Id_utilisateur'] . ')');
                    var_dump($candidaterAlerte);
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