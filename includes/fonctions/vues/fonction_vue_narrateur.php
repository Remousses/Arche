<?php
    function redigerLivreSauvetage(){
?>
        <div class="card card-login mx-auto mt-5 mb-5">
            <div class="card-header">Ajouter un livre</div>
                <div class="card-body">
                <form action="includes/fonctions/fonction_creation.php" method="post">
                    <div class="form-group">
                        <label classe="col-12" for="titre">Titre du livre <span class="small float-right text-muted" id="titreTailleMax"></span></label>
                        <input class="form-control" type="text" name="titre" onkeypress="tailleInput('titre', event);" maxlength="50" value="<?php echo isset($_GET['titre']) ? $_GET['titre'] : ''; ?>" placeholder="Entrer le titre" required>
                    </div>
                    <div class="form-group">
                        <label classe="col-12" for="narration">Narration <span class="small float-right text-muted" id="narrationTailleMax"></span></label>
                        <textarea class="form-control" type="text" name="narration" onkeypress="tailleTextarea('narration', event);" maxlength="30" cols="1000" rows ="6" placeholder="Entrer votre témoignage" required><?php echo isset($_GET['narration']) ? $_GET['narration'] : ''; ?></textarea>
                    </div>
                    
                    <button class="btn btn-primary btn-block" type="submit" name="enregistrerLivre">Enregistrer</button>
                </form>
            </div>
        </div>
<?php
    }
?>