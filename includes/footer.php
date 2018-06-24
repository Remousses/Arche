<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small><span class="mr-3 d-inline-block">Copyright © Your Website 2018</span> <span class="mr-3 d-inline-block">Nous contacter Numero: <b>0143845656</b></span> <span class="mr-3 d-inline-block">Mail: <b>archedenoe@arche.com</b></span></small>
        </div>
    </div>
</footer>
<!-- Retour en haut de page -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- Modal déconnexion -->
<div class="modal fade" id="deconnexion" tabindex="-1" role="dialog" aria-labelledby="deconnexionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deconnexionLabel">Voulez-vous vraiment vous déconnecter ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                <a class="btn btn-primary" href="deconnexion.php">Oui</a>
            </div>
        </div>
    </div>
</div>
<?php
    $GLOBALS['connexion'] = null;
?>

<script src="js/sb-admin.min.js"></script>