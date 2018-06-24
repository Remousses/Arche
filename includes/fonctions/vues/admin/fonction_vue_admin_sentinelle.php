<?php
    function creerAlerte(){
?>      <div class="card card-login mx-auto mt-5 mb-5">
            <div class="card-header">Création d'une alerte</div>
            <div class="card-body">
                <form action="includes/fonctions/fonction_creation.php" method="post">
                    <div class="form-group">
                        <label class="col-12" for="nomAlerte">Nom de l'alerte <span class="small float-right text-muted" id="nomAlerteTailleMax"></span></label>
                        <input class="form-control" type="text" name="nomAlerte" onkeypress="tailleInput('nomAlerte', event);" maxlength="100" value="<?php echo isset($_GET['nomAlerte']) ? $_GET['nomAlerte'] : ''; ?>" placeholder="Entrer un nom d'alerte" required/>
                    </div>
                    <div class="form-group">
                        <label class="col-12" for="informationsAlerte">Informations sur l'alerte <span class="small float-right text-muted" id="informationsAlerteTailleMax"></span></label>
                        <textarea class="form-control" type="text" name="informationsAlerte" onkeypress="tailleTextarea('informationsAlerte', event);" cols="30" rows="6" maxlength="1000" placeholder="Entrer des informations" required><?php echo isset($_GET['informationsAlerte']) ? $_GET['informationsAlerte'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nomEspece">Nom de l'espèce concernée</label>
                        <select class="form-control" name="nomEspece">
                            <?php selectEspece('espece'); ?>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary btn-block" type="submit" name="creerAlerte">Créer une alerte</button>
                    <a class="btn btn-secondary btn-block text-white" data-toggle="modal" data-target="#nouvelleEspece">Créer une nouvelle espèce</a>
                </form>
            </div>

            <!-- Modal nouvelle espèce -->
            <div class="modal fade" id="nouvelleEspece" tabindex="-1" role="dialog" aria-labelledby="nouvelleEspeceLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div id="modalCreerAlerte" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nouvelleEspeceLabel">Création d'un nouvelle espèce</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <?php
                                if(isset($_GET['message'])){
                                    $script = '<script src="js/modal.js"></script>';

                                    switch($_GET['message']){
                                        case 'existeEspece':
                                            messageBox('warning', 'Le nom de l\'espèce ou la photo existe déjà.');
                                            echo $script;
                                            break;
                                        
                                        case 'erreurEspece':
                                            messageBox('danger', 'L\'espèce n\'a pas été créée.');
                                            echo $script;
                                            break;

                                        case 'erreurPhotoEspece':
                                            messageBox('danger', 'Problème avec votre photo.');
                                            echo $script;
                                            break;
                                        
                                        default:
                                            break;
                                    }
                                }
                            ?>
                            <form action="includes/fonctions/fonction_creation.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="col-12" for="regne">Règne <span class="small float-right text-muted" id="regneTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="regne" onkeypress="tailleInput('regne', event);" maxlength="50" value="<?php echo isset($_GET['regne']) ? $_GET['regne'] : ''; ?>" placeholder="Entrer un nom de règne" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-12" for="embranchement">Embranchement <span class="small float-right text-muted" id="embranchementTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="embranchement" onkeypress="tailleInput('embranchement', event);" maxlength="50" value="<?php echo isset($_GET['embranchement']) ? $_GET['embranchement'] : ''; ?>" placeholder="Entrer un nom d'embranchement" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-12" for="classe">Classe <span class="small float-right text-muted" id="classeTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="classe" onkeypress="tailleInput('classe', event);" maxlength="50" value="<?php echo isset($_GET['classe']) ? $_GET['classe'] : ''; ?>" placeholder="Entrer un nom de classe" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-12" for="ordre">Ordre <span class="small float-right text-muted" id="ordreTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="ordre" onkeypress="tailleInput('ordre', event);" maxlength="50" value="<?php echo isset($_GET['ordre']) ? $_GET['ordre'] : ''; ?>" placeholder="Entrer un nom d'ordre" required/>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="col-12" for="famille">Famille <span class="small float-right text-muted" id="familleTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="famille" onkeypress="tailleInput('famille', event);" maxlength="50" value="<?php echo isset($_GET['famille']) ? $_GET['famille'] : ''; ?>" placeholder="Entrer un nom de famille" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-12" for="genre">Genre <span class="small float-right text-muted" id="genreTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="genre" onkeypress="tailleInput('genre', event);" maxlength="50" value="<?php echo isset($_GET['genre']) ? $_GET['genre'] : ''; ?>" placeholder="Entrer un nom de genre" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-12" for="espece">Espèce <span class="small float-right text-muted" id="especeTailleMax"></span></label>
                                                    <input class="form-control" type="text" name="espece" onkeypress="tailleInput('espece', event);" maxlength="50" value="<?php echo isset($_GET['espece']) ? $_GET['espece'] : ''; ?>" placeholder="Entrer un nom d'espece" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="espece">Photo</label>
                                                    <input class="form-control" type="file" name="photo" maxlength="50" value="<?php echo isset($_GET['photo']) ? $_GET['photo'] : ''; ?>" required/>
                                                </div>                                        
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary" type="submit" name="nouvelleEspece">Créer une nouvelle espèce</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php        
    }

    function selectEspece($table){
        $allEspece = $GLOBALS['connexion']->prepare('SELECT Nom_' . $table . ' FROM ' . $table . ' ORDER BY Nom_' . $table . '');
        $allEspece->execute();

        while($donnees = $allEspece->fetch()){
            echo '<option value="' .  $donnees['Nom_' . $table . ''] . '">' . $donnees['Nom_' . $table . ''] . '</option>';
        }

        $allEspece->closeCursor();
    }
?>