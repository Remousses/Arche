$(document).ready(function(){
    // récupère l'ancre dans l'URL
    var pageCourante = $(location).attr('href');
    var pages = ['candidatures.php', 'salaries.php'];

    for (var i = 0; i < pages.length; i++) {
        if (pageCourante.includes(pages[i])) {
            getAncre();
            break;
        }
    }

    var options = {
      format: 'dd/mm/yyyy',
      autoclose: true,
    };

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

    $('#choixTache1').click(function(){
        $('#selectActiviteDiv').removeClass('d-none');
        $('#nouvelleActiviteDiv').addClass('d-none');
        $('#nouvelleActivite').removeAttr('required');
        $('#selectActivite').removeAttr('disabled');
        $('#nouvelleActivite').attr('disabled', 'true');
    });

    $('#choixTache2').click(function(){
        $('#nouvelleActiviteDiv').removeClass('d-none');
        $('#selectActiviteDiv').addClass('d-none');
        $('#nouvelleActivite').removeAttr('disabled');
        $('#selectActivite').attr('disabled', 'true');
        $('#nouvelleActivite').attr('required', 'true');
    });

    $(window).on('hashchange', function(){
        getAncre();
    });

    $('#dataTableTaxinomie').DataTable({
        destroy: true,
        info:     false
    });

    $('#dateDebutProjet').datepicker(options);
    $('#dateFinProjet').datepicker(options);
    $('#dateDebutTache').datepicker(options);
    $('#dateFinTache').datepicker(options);
});

function getAncre(){
    var ancre = window.location.hash;
    ancre = ancre.substring(1, ancre.length); // enlève le #
    ancre = decodeURIComponent(ancre);
    $('#dataTableCandidature').DataTable().search(ancre).draw();
}

function candidater(idAlerte, idEspece){
    $('#idAlerteCandidater').val(idAlerte);
    $('#idEspeceCandidater').val(idEspece);
}

function ajouterTache(idProjet){
    $('#idProjet').val(idProjet);
}

function taxinomie(idEspece){
    $.ajax({
        url: 'includes/fonctions/vues/fonction_vue_all.php',
        data: {
            functionTaxinomie:'voirTaxinomie',
            param: {
                id: idEspece
            }
        },
        success: function(data){
            $('#modalTaxinomie').html(data);
        },
        dataType: 'html'
    });
}