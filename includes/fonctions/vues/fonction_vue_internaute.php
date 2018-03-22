<?php
    function inscriptionInternaute(){
?>
        <form action="includes/fonctions/fonction_creation.php" method="post">
            <label for="nomInternaute">Nom</label>
            <input type="text" name="nomInternaute" value="<?php echo isset($_GET['nomInternaute']) ? $_GET['nomInternaute'] : ''; ?>" required autofocus/><br>
            <label for="prenomInternaute">Prénom</label>
            <input type="text" name="prenomInternaute" value="<?php echo isset($_GET['prenomInternaute']) ? $_GET['prenomInternaute'] : ''; ?>" required/><br>
            <label for="mdpInternaute">Mot de passe</label>
            <input type="password" name="mdpInternaute" required/><br>

            <button type="submit" name="inscriptionInternaute">Inscription</button>
            <span id="inscription"></span>
        </form>
<?php   
    }

    function connectionInternaute(){
?>
        <form action="includes/fonctions/fonction_connection.php" method="post">
            <label for="nomInternauteConnection">Nom</label>
            <input type="text" name="nomInternauteConnection" value="<?php echo isset($_GET['nomInternauteConnection']) ? $_GET['nomInternauteConnection'] : ''; ?>" required autofocus/><br>
            <label for="mdpInternauteConnection">Mot de passe</label>
            <input type="password" name="mdpInternauteConnection" required/><br>

            <button type="submit" name="connectionInternaute">Connection</button>
            <span id="connection"></span>
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