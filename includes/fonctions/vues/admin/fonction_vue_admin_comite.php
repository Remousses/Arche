<?php
    function statuerAlerte($idAlerte){
        echo'<a href="includes/fonctions/fonction_gestions_alertes.php?confirmerAlerte=' . $idAlerte . '">V</a><br>
            <a href="includes/fonctions/fonction_gestions_alertes.php?supprimerAlerte=' . $idAlerte . '">V</a>';
    }
?>