<?php
    if(isset($_SESSION['pseudoAdmin'])){
        if($_SESSION['gestion'] == "boutiques"){

        echo '<div class="bouton" style="margin-top: 35px;">
            <a class="btn" href="gestions_boutiques.php">Gestions des boutiques</a>
        </div>';


        }elseif($_SESSION['gestion'] == "produits" && $_SERVER["REQUEST_URI"] != "/GeekZone/gestions_prod_cat.php"){

            echo '<div class="bouton" style="margin-top: 35px;">
                <a class="btn" href="gestions_produits.php">Gestions des produits</a>
            </div>';
        }

        echo '<div class="bouton">
            <a class="btn" href="deconnexion.php">D&eacute;connexion</a>
        </div>';
        
    }else if (isset($_SESSION['pseudoUser'])){

        echo '<div class="bouton">
            <a class="btn" href="deconnexion.php">D&eacute;connexion</a>
        </div>
        <div class="bouton" style="padding: 5px; margin-top: 35px; background-color: #c3c3c3;">
            <a href="panier.php"><img class="image_panier" alt="Panier" src="img/img_logo/Logo_Panier.png"/></a>
        </div>';
    }else{
        echo '<div class="bouton">
            <a class="btn" href="connexion.php">Connexion</a>
        </div>
        <div class="bouton" style="margin-top: 35px;">
            <a class="btn" href="admin.php">Espace admin</a>
        </div>';
    }
?>