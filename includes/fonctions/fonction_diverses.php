<?php
    function message(){
        $message = $_GET['message'];
        
        if(isset($_GET['nomGroupe']) && $message == 'succesConnexion'){
            messageBox('success', 'Vous êtes connecté en tant que ' . $_GET['nomGroupe']);
        }
        
        switch($message){
            case 'erreurConnexion':
                messageBox('danger', 'Veuillez réessayer.');
                break;

            case 'succesDeconnexion':
                messageBox('success', 'Déconnexion réussi');
                break;
            
            case 'succesInscription':
                messageBox('success', 'Inscription réussi.');
                break;

            case 'erreurInscription':
                messageBox('danger', 'Veuillez réessayer.');
                break;

            case 'erreurPage':
                messageBox('danger', 'Cette page n\'existe pas. Vous avez été redirigez vers la page d\'accueil.');
                break;

            case 'succesAlerte':
                messageBox('success', 'L\'alerte à été créée.');
                break;
            
            case 'erreurAlerte':
                messageBox('danger', 'L\'alerte n\'a pas été créée');
                break;
            
            case 'existeAlerte':
                messageBox('warning', 'Veuillez réessayer, ce nom existe déjà');
                break;
            
            case 'erreurPageAlerte':
                messageBox('warning', 'Cette page n\'existe pas. Vous avez été redirigez vers la page des alertes.');
                break;

            case 'succesApprouverAlerte':
                messageBox('success', 'L\'alerte à été approuvée.');
                break;

            case 'erreurApprouverAlerte':
                messageBox('danger', 'L\'alerte n\'a pas été approuver.');
                break;

            case 'succesArchiverAlerte':
                messageBox('success', 'L\'alerte à été archiver.');
                break;

            case 'erreurArchiverAlerte':
                messageBox('danger', 'L\'alerte n\'a pas été archiver.');
                break;
            
            case 'succesEspece':
                messageBox('success', 'L\'espèces à été créée.');
                break;
            
            case 'succesCandidature':
                messageBox('success', 'Votre demande de candidature va être prise en compte.');
                break;
            
            case 'erreurCandidature':
                messageBox('danger', 'Erreur lors de la demande de candidature.');
                break;

            case 'existeCandidature':
                messageBox('warning', 'Vous avez déjà candidater à cette alerte.');
                break;

            case 'ErreurProfile':
                messageBox('warning', 'Vous n\'avez aucun projet en cours.');
                break;

            default:
                break;
        }
    }
    
    function messageBox($class, $message){
        echo '<div class="alert alert-' . $class . ' alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            ';

        if($class == 'danger'){
            echo '<strong>Erreur : </strong>';
        }
            
        echo $message . '
        </div>';
    }

    function dateFr($var){
        $tab = explode("-",$var);
        $dateFr = $tab[2]."-".$tab[1]."-".$tab[0];

        return $dateFr;
    }

    function pagePrecedente(){
        define('pageprecedente', $_SERVER["HTTP_REFERER"], true);
	
        /*if(pageprecedente == "gestions_produits.php" || pageprecedente == "gestions_boutiques.php"){
            header('Location: index.php');
        }else{*/
            if(strpos(pageprecedente, '?')){
                header('Location: ' . pageprecedente . '&message=succesDeconnexion');
            }else{
                header('Location: ' . pageprecedente . '?message=succesDeconnexion');
            }
            
        //}
    }
?>