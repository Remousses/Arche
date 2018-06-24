<?php
    function inscriptionUtilisateur(){
?>
        <div class="card-header">S'inscrire</div>
        <div class="card-body">
            <form action="includes/fonctions/fonction_creation.php" method="post">
                <div class="form-group">
                    <label class="col-12" for="nomUtilisateurInscription">Nom <span class="small float-right text-muted" id="nomUtilisateurInscriptionTailleMax"></span></label>
                    <input class="form-control" type="text" name="nomUtilisateurInscription" onkeypress="tailleInput('nomUtilisateurInscription', event);" maxlength="30" value="<?php echo isset($_GET['nomUtilisateurInscription']) ? $_GET['nomUtilisateurInscription'] : ''; ?>" placeholder="Entrer votre nom" required autofocus/>
                </div>
                <div class="form-group">
                    <label class="col-12" for="prenomUtilisateurInscription">Prénom <span class="small float-right text-muted" id="prenomUtilisateurInscriptionTailleMax"></span></label>
                    <input class="form-control" type="text" name="prenomUtilisateurInscription" onkeypress="tailleInput('prenomUtilisateurInscription', event);" maxlength="30" value="<?php echo isset($_GET['prenomUtilisateurInscription']) ? $_GET['prenomUtilisateurInscription'] : ''; ?>" placeholder="Entrer votre prénom" required/>
                </div>
                <div class="form-group">
                    <label class="col-12" for="mdpUtilisateurInscription">Mot de passe <span class="small float-right text-muted" id="mdpUtilisateurInscriptionTailleMax"></span></label>
                    <input class="form-control" type="password" name="mdpUtilisateurInscription" onkeypress="tailleInput('mdpUtilisateurInscription', event);" maxlength="30" placeholder="Entrer votre mot de passe" required/>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="inscriptionUtilisateur">S'inscrire</button>
            </form>
        </div>
<?php   
    }

    function connexionUtilisateur(){
?>
        <div class="card-header">Se connecter</div>
        <div class="card-body">
            <form action="includes/fonctions/fonction_connexion.php" method="post">
                <div class="form-group">
                    <label class="col-12" for="nom">Nom <span class="small float-right text-muted" id="nomTailleMax"></span></label>
                    <input class="form-control" type="text" name="nom" onkeypress="tailleInput('nom', event);" maxlength="30" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : ''; ?>" placeholder="Entrer votre nom" required autofocus/>
                </div>
                <div class="form-group">
                    <label class="col-12" for="mdp">Mot de passe <span class="small float-right text-muted" id="mdpTailleMax"></span></label>
                    <input class="form-control" type="password" name="mdp" onkeypress="tailleInput('mdp', event);" maxlength="30" placeholder="Entrer votre mot de passe" required/>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="connexion">Se connecter</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="inscription.php">S'inscrire</a>
            </div>
        </div>
<?php
    }

    function voirProjets($tabProjet, $idProjet, $idAlerte, $nomProjet, $dateDebutProjet, $dateFinProjet){
        $texteTache = getAllTacheParProjet($idProjet);

        if(!in_array($idProjet, $tabProjet)){
            array_push($tabProjet, $idProjet);
            echo '<div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title mb-1">' . $nomProjet . '</h6>
                        ' . $texteTache . '
                    </div>';
                    
            if($_SESSION['Id_groupe'] == getIdGroupeComite()){               

                echo '<hr class="my-0">
                    <div class="card-body py-2 small">
                        <a class="mr-3 d-inline-block" href="includes/fonctions/fonction_validation.php?archiverProjet=' . $idProjet . '">Archiver</a>
                        <a href="#" class="mr-3 d-inline-block" data-toggle="modal" onclick="ajouterTache(' . $idProjet . ');" data-target="#ajouterTache">Ajouter une nouvelle tâche</a>
                    </div>';
            }else if($_SESSION['Id_groupe'] == getIdGroupeParrainFinancier()){
                echo '<hr class="my-0">
                    <div class="card-body py-2 small">
                        <a href="#" class="mr-3 d-inline-block" data-toggle="modal" data-target="#don" disabled>Faire un don</a>
                    </div>';
            }

            echo '<div class="card-footer small text-muted">
                    <span class="mr-3 d-inline-block">Posté le ' . dateFr($dateDebutProjet) . '</span>
                    <span class="mr-3 d-inline-block">Fini le ' . dateFr($dateFinProjet) . '</span>
                </div>
            </div>';
        }


        return $tabProjet;
    }

    if (isset($_REQUEST['functionTaxinomie']) && $_REQUEST['functionTaxinomie'] != ''){
        $_REQUEST['functionTaxinomie']($_REQUEST);
    }

    function voirTaxinomie($data){
        require_once '../../fonctions/connexionDB.php';
        $idEspece = $data['param']['id'];
        
        $taxinomie = connexionDB()->prepare('SELECT Nom_regne, Nom_embranchement, Nom_classe, Nom_ordre, Nom_famille, Nom_genre, Id_espece, Nom_espece, Photo FROM espece
        LEFT JOIN regne ON espece.Id_regne = regne.Id_regne
        LEFT JOIN embranchement ON espece.Id_embranchement = embranchement.Id_embranchement
        LEFT JOIN classe ON espece.Id_classe = classe.Id_classe
        LEFT JOIN ordre ON espece.Id_ordre = ordre.Id_ordre
        LEFT JOIN famille ON espece.Id_famille = famille.Id_famille
        LEFT JOIN genre ON espece.Id_genre = genre.Id_genre
        WHERE espece.Id_espece = ' . $idEspece);

        $taxinomie->execute();
        $donnees = $taxinomie->fetch();
?>
        <div class="modal-header">
            <h5 class="modal-title" id="taxinomieLabel"><?php echo $donnees['Nom_espece']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                        <div class="text-center pb-3">
                            <img class="image_modal_taxinomie" src="images/especes/<?php echo $donnees['Photo']; ?>" alt="<?php echo $donnees['Nom_espece']; ?>">
                        </div>
                    <div class="row">
                        <div class="col-6">
                            <div>
                                Règne : <?php echo $donnees['Nom_regne']; ?>
                            </div>
                            <br>
                            <div>
                                Embranchement : <?php echo $donnees['Nom_embranchement']; ?>
                            </div>
                            <br>
                            <div>
                                Classe : <?php echo $donnees['Nom_classe']; ?>
                            </div>
                            <br>
                            <div>
                                Ordre : <?php echo $donnees['Nom_ordre']; ?>
                            </div>
                        </div>

                         <div class="col-6">
                            <div>
                                Famille : <?php echo $donnees['Nom_famille']; ?>
                            </div>
                            <br>
                            <div>
                                Genre : <?php echo $donnees['Nom_genre']; ?>
                            </div>
                            <br>
                            <div>
                                Espece : <?php echo $donnees['Nom_espece']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                         
        </div>
<?php
        $taxinomie ->closeCursor();
    }
?>