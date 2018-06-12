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

    $('#retourCreerTache').click(function(){
        $('#nouvelleTache').modal('toggle');
    });

    $('#choixTache1').click(function(){
        $('#selectActiviteDiv').removeClass("d-none");
        $('#nouvelleActiviteDiv').addClass("d-none");
        $('#nouvelleActivite').removeAttr('required');
        $('#selectActivite').removeAttr('disabled');
        $('#nouvelleActivite').attr('disabled', 'true');
    });

    // active 
    $('#choixTache2').click(function(){
        $('#nouvelleActiviteDiv').removeClass("d-none");
        $('#selectActiviteDiv').addClass("d-none");
        $('#nouvelleActivite').removeAttr('disabled');
        $('#selectActivite').attr('disabled', 'true');
        $('#nouvelleActivite').attr('required', 'true');
    });

    $(window).on('hashchange', function(){
        getAncre();
    });

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

    $('#dateDebutProjet').datepicker(options);
    $('#dateFinProjet').datepicker(options);
    $('#dateDebutTache').datepicker(options);
    $('#dateFinTache').datepicker(options);
});

function getAncre(){
    var ancre = window.location.hash;
    ancre = ancre.substring(1, ancre.length); // enlève le #
    ancre = decodeURIComponent(ancre);
    $("#dataTable").DataTable().search(ancre).draw();
}

function recherche(){
    $(window).bind('hashchange', function(){
        getAncre();
    });
    location.hash.replace('#', $(".dataTables_filter input").val());
    document.location.replace = "candidatures.php#" + $(".dataTables_filter input").val();
}

function candidater(idAlerte, idEspece){
    $('#idAlerteCandidater').val(idAlerte);
    $('#idEspeceCandidater').val(idEspece);
}

function ajouterTache(idProjet){
    $('#idProjet').val(idProjet);
}