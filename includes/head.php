<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>L'arche de Noé</title>
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin.css" rel="stylesheet" type="text/css">

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="js/sb-admin-datatables.min.js"></script>
<script src="js/sb-admin-charts.min.js"></script>
<script>
    $(document).ready(function(){
        $('#toggleNavColor').click(function() {
            $('nav').toggleClass('navbar-dark navbar-light');
            $('nav').toggleClass('bg-dark bg-light');
            $('body').toggleClass('bg-dark bg-light');
        });

        $('#candidater').on('shown.bs.modal', function() {
            $(this).find('textarea:first').focus();
        });

        $('#nouvelleEspece').on('shown.bs.modal', function() {
            $(this).find('input:first').focus();
        });
    });
    
    function candidater(idAlerte, idEspece){
        $('#idAlerteCandidater').val(idAlerte);
        $('#idEspeceCandidater').val(idEspece);
    }   
</script>

<?php
    require_once 'param/infos_id_groupe.php';
    require_once 'includes/fonctions/fonction_diverses.php';
    require_once 'includes/fonctions/upload.inc.php';
    require_once 'includes/fonctions/vues/fonction_vue_all.php';
    require_once 'includes/fonctions/vues/admin/fonction_vue_admin_comite.php';
    require_once 'includes/fonctions/vues/admin/fonction_vue_admin_narrateur.php';
    require_once 'includes/fonctions/vues/admin/fonction_vue_admin_sentinelle.php';
    require_once 'includes/fonctions/gestions/fonction_gestions_alertes.php';
    require_once 'includes/fonctions/gestions/fonction_gestions_projets.php';
?>