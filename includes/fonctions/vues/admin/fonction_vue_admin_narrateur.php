<?php
    function redigerLivreSauvetage(){
?>
        <form action="includes/fonctions/fonction_creation" method="post">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" maxlength="30" value="<?php echo isset($_GET['titre']) ? $_GET['titre'] : ''; ?>" required autofocus><br>
            <label for="narration">Narration</label>
            <textarea type="text" name="narration" id="narration" maxlength="30" cols="50" rows ="6" value="<?php echo isset($_GET['narration']) ? $_GET['narration'] : ''; ?>" required autofocus></textarea><br>
            <input type="hidden" name="narrateur" value="<?php echo isset($_SESSION['Id_groupe']) ? $_SESSION['Id_groupe'] : ''; ?>">
            <input type="hidden" name="id" value="<?php echo isset($_SESSION['Id_groupe']) ? $_SESSION['Id_groupe'] : ''; ?>">
            <input type="hidden" name="dateAlerte"  value="<?php echo date("d-m-Y"); ?>">
            
            <button type="submit" name="redigerLivreSauvetage">Envoyer</button>
        </form>
<?php
    }
?>