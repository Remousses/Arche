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

    $(window).on('hashchange', function(){
        getAncre();
    });

    // on récupère l'ancre dans l'URL
    var pageCourante = $(location).attr('href');
    var pages = ['candidatures.php', 'salaries.php'];

    for (var i = 0; i < pages.length; i++) {
        if (pageCourante.includes(pages[i])) {
            getAncre();
            // $('#approuver').on('click',function(){
            //     document.location.href = pages[i] + "#" + $(".dataTables_filter input").val();
            //     console.log(pages[i] + "#" + $(".dataTables_filter input").val());
            // });
            break;
        }
    }

    // $('#datePicker') .datepicker({
    //     format: 'mm/dd/yyyy'
    // })
    // .on('changeDate', function(e) {
    //     // Revalidate the date field
    //     $('#eventForm').formValidation('revalidateField', 'date');
    // });
    
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

// function miseAJour() {
//     var currentTime = new Date();
//     var jour = currentTime.getDate();
//     var mois = currentTime.getMonth() + 1;
//     var annee = currentTime.getFullYear();
//     var heuFres = currentTime.getHours();
//     var minutes = currentTime.getMinutes();

//     if(minutes >= 0 && minutes <= 9){
//         minutes = "0" + minutes;
//     }

//     $("#date").append(jour + "/" + mois + "/" + annee + " à " + heures + ":" + minutes);
// }

// function tailleInput(id){
//     var id = id.getAttribute("id");
//     var textLength = document.getElementById(id).value.length;
//     var tailleMax = document.getElementById(id).getAttribute("maxlength");
//     document.getElementById("tailleMax").innerHTML = textLength + "/" + tailleMax;
// }