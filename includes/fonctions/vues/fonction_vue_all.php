<?php
    function inscriptionInternaute(){
?>
        <form action="includes/fonctions/fonction_creation.php" method="post">
            <label for="nomInternauteInscription">Nom</label>
            <input type="text" name="nomInternauteInscription" value="<?php echo isset($_GET['nomInternauteInscription']) ? $_GET['nomInternauteInscription'] : ''; ?>" required autofocus/><br>
            <label for="prenomInternauteInscription">Prénom</label>
            <input type="text" name="prenomInternauteInscription" value="<?php echo isset($_GET['prenomInternauteInscription']) ? $_GET['prenomInternauteInscription'] : ''; ?>" required/><br>
            <label for="mdpInternautInscriptione">Mot de passe</label>
            <input type="password" name="mdpInternauteInscription" required/><br>

            <button type="submit" name="inscriptionInternaute">Inscription</button>
            <span id="inscription"></span>
        </form>
<?php   
    }

    function connectionInternaute(){
?>
        <form action="includes/fonctions/fonction_connection.php" method="post">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : ''; ?>" required autofocus/><br>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" required/><br>

            <button type="submit" name="connection">Connection</button>
        </form>
<?php
    }

    function participationProjet(){
        echo 'participationProjet';
?>
        <!-- <form action="includes/fonctions/fonction_conn" method="post">
        <label></label>
        <input type="text" name="pseudoUser" required autofocus/>

        <button type="submit" name="creerAlerte">Participer à ce projet</button>
    </form> -->
<?php
    }
?>