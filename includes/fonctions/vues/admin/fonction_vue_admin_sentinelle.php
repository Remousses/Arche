<?php
    function creerAlerte(){
?>      <div class="card card-login mx-auto mt-5">
            <div class="card-header">Création d'une alerte</div>
            <div class="card-body">
                <form id="form" action="includes/fonctions/fonction_creation.php" method="post">
                    <div class="form-group">
                        <label for="nomAlerte">Nom de l'alerte</label>
                        <input class="form-control" type="text" name="nomAlerte" maxlength="30" value="<?php echo isset($_GET['nomAlerte']) ? $_GET['nomAlerte'] : ''; ?>" placeholder="Entrer un nom d'alerte" required/>
                    </div>
                    <div class="form-group">
                        <label for="informationsAlerte">Informations sur l'alerte</label>
                        <textarea class="form-control" type="text" name="informationsAlerte" cols="30" rows ="6" maxlength="1000" placeholder="Entrer des informations" required><?php echo isset($_GET['informationsAlerte']) ? $_GET['informationsAlerte'] : ''; ?></textarea>
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
                    <div id="modal" class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nouvelleEspeceLabel">Création d'un nouvelle espèce</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <?php
                                if(isset($_GET['message'])){
                                    $message = $_GET['message'];
                                    $script = '<script src="js/modal.js"></script>';

                                    if($message == 'erreurEspece'){
                                        messageBox('danger', 'L\'espece n\'a pas été créée, le nom d\'espèce ou la phohto existe déjà.');
                                        echo $script;
                                    }else if($message == 'erreurPhotoEspece'){
                                        messageBox('danger', 'Problème avec votre photo.');
                                        echo $script;
                                    }
                                }
                            ?>
                            <form id="form" action="includes/fonctions/fonction_creation.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="regne">Règne</label>
                                                    <input class="form-control" type="text" name="regne" maxlength="30" value="<?php echo isset($_GET['regne']) ? $_GET['regne'] : ''; ?>" placeholder="Entrer un nom de règne" required/>
                                                    <!--<select class="form-control" name="regne">
                                                        <?php //selectEspece('regne'); ?>
                                                    </select>-->
                                                </div>
                                                <div class="form-group">
                                                    <label for="embranchement">Embranchement</label>
                                                    <input class="form-control" type="text" name="embranchement" maxlength="30" value="<?php echo isset($_GET['embranchement']) ? $_GET['embranchement'] : ''; ?>" placeholder="Entrer un nom d'embranchement" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="classe">Classe</label>
                                                    <input class="form-control" type="text" name="classe" maxlength="30" value="<?php echo isset($_GET['classe']) ? $_GET['classe'] : ''; ?>" placeholder="Entrer un nom de classe" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ordre">Ordre</label>
                                                    <input class="form-control" type="text" name="ordre" maxlength="30" value="<?php echo isset($_GET['ordre']) ? $_GET['ordre'] : ''; ?>" placeholder="Entrer un nom d'ordre" required/>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="famille">Famille</label>
                                                    <input class="form-control" type="text" name="famille" maxlength="30" value="<?php echo isset($_GET['famille']) ? $_GET['famille'] : ''; ?>" placeholder="Entrer un nom de famille" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="genre">Genre</label>
                                                    <input class="form-control" type="text" name="genre" maxlength="30" value="<?php echo isset($_GET['genre']) ? $_GET['genre'] : ''; ?>" placeholder="Entrer un nom de genre" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="espece">Espèce</label>
                                                    <input class="form-control" type="text" name="espece" maxlength="30" value="<?php echo isset($_GET['espece']) ? $_GET['espece'] : ''; ?>" placeholder="Entrer un nom d'espece" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="espece">Photo</label>
                                                    <input class="form-control" type="file" name="photo" maxlength="30" value="<?php echo isset($_GET['photo']) ? $_GET['photo'] : ''; ?>" required/>
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
        $allEspece = DBConnexion()->prepare('SELECT Nom_' . $table . ' FROM ' . $table . ' ORDER BY Nom_' . $table . '');
        $allEspece->execute();
        // $i = 1;

        while($donnees = $allEspece->fetch()){
        //     $double = 0;
        //     if(isset($_GET['nomEspece']) && $i == 1){
        //         echo '<option value="' . $_GET['nomEspece'] . '">' . $_GET['nomEspece'] . '</option>';
        //         $double = 1;
        //     }
            
        //     if($double != 1){
                echo '<option value="' .  $donnees['Nom_' . $table . ''] . '">' . $donnees['Nom_' . $table . ''] . '</option>';
            
           
            // $i ++;
        }

        $allEspece->closeCursor();
    }
?>