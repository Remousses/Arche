<?php
    function creerAlerte(){
?>
        <form action="includes/fonctions/fonction_creation" method="post">
            <label for="nomAlerte">Nom de l'alerte</label>
            <input type="text" name="nomAlerte" id="nomAlerte" value="<?php echo isset($_GET['nomAlerte']) ? $_GET['nomAlerte'] : ''; ?>" required autofocus><br>
            <label for="informationsAlerte">Informations sur l'alerte</label>
            <input type="text" name="informationsAlerte" value="<?php echo isset($_GET['informationsAlerte']) ? $_GET['informationsAlerte'] : ''; ?>" required>
            <input type="hidden" name="dateAlerte" id="dateAlerte">
            <button type="submit" name="creerAlerte">Créer une alerte</button>
        </form>

        <script>
			var maintenant = new Date();
			var jour = maintenant.getDate();
			var mois = maintenant.getMonth() + 1;
			var an = maintenant.getFullYear();
			
			document.getElementById('dateAlerte').value = an + "-" + mois + "-" + jour;
        
            document.getElementById("nomAlerte").addEventListener("onkeydown", function(

            )};
        </script>
<?php        
    }
?>