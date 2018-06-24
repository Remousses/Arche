$(document).ready(function(){
    var options = {
      format: 'dd/mm/yyyy',
      autoclose: true,
    };
    var page = 'candidatures.php';
    // récupère l'ancre dans l'URL
    var pageCourante = $(location).attr('href');

    if (pageCourante.includes(page)) {
        getAncre();
    }
    
    // affine la recherche si # différent de celui de base pour la page en paramètre
    $(window).on('hashchange', function(){
        if (pageCourante.includes(page)) {
            getAncre();
        }
    });

    // adaptation des datapicker avec les options voulues
    $('#dateDebutProjet').datepicker(options);
    $('#dateFinProjet').datepicker(options);
    $('#dateDebutTache').datepicker(options);
    $('#dateFinTache').datepicker(options);

    // permet d'alterner la couleur du menu
    $('#toggleNavColor').click(function() {
        $('nav').toggleClass('navbar-dark navbar-light');
        $('nav').toggleClass('bg-dark bg-light');
        $('body').toggleClass('bg-dark bg-light');
    });

    // permet de voir le modal et de positionner le curseur
    $('#candidater').on('shown.bs.modal', function() {
        $(this).find('textarea:first').focus();
    });

    $('#nouvelleEspece').on('shown.bs.modal', function() {
        $(this).find('input:first').focus();
    });

    // permet de faire apparaitre les informations voulues et de cacher les autres
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

    // enleve le nombre de ligne du tableau
    $('#dataTableTaxinomie').DataTable({
        destroy: true,
        info: false
    });
});

// affine la recherche si # dans l'url
function getAncre(){
    var ancre = window.location.hash;
    ancre = ancre.substring(1, ancre.length); // enlève le #
    ancre = decodeURIComponent(ancre);
    $('#dataTableCandidature').DataTable().search(ancre).draw();
}

function tailleInput(name, event){
    var e = event || window.event;
    var tailleMax = $("input[name=" + name + "]").attr("maxlength");
    console.log('ok');
    if(e.keyCode == 8){
        var textLength = $("input[name=" + name + "]").val().length - 1;
    }else{
        var textLength = $("input[name=" + name + "]").val().length + 1;
    }
    
    if(textLength >= 0 && textLength <= tailleMax){
        $("#" + name + "TailleMax").text(textLength + "/" + tailleMax);
    }
}

function tailleTextarea(name, event){
    var e = event || window.event;
    
    var tailleMax = $("textarea[name=" + name + "]").attr("maxlength");
    
    if(e.keyCode == 8){
        var textLength = $("textarea[name=" + name + "]").val().length - 1;
    }else{
        var textLength = $("textarea[name=" + name + "]").val().length + 1;
    }
    
    if(textLength >= 0 && textLength <= tailleMax){
        $("#" + name + "TailleMax").text(textLength + "/" + tailleMax);
    }
}

// récupèration des valeurs en paramètre pour les afficher dans le modal
function candidater(idAlerte, idEspece){
    $('#idAlerteCandidater').val(idAlerte);
    $('#idEspeceCandidater').val(idEspece);
}

function ajouterTache(idProjet){
    $('#idProjet').val(idProjet);
}

// récupère la valeur en paramètre pour utiliser la fonction voirTaxinomie
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