<?php
    function statuerAlerte($idAlerte){
        echo'<a href="includes/fonctions/fonction_validation.php?confirmerAlerte=' . $idAlerte . '">V</a>
            <a href="includes/fonctions/fonction_validation.php?supprimerAlerte=' . $idAlerte . '">X</a><br>';
    }
?>