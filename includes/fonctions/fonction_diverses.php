<?php
    function message(){
        $success = 'success';
        $warning = 'warning';
        $danger = 'danger';
        
        if(isset($_GET['nomGroupe']) && $_GET['message'] == 'succesConnexion'){
            messageBox($success, 'Vous êtes connecté en tant que ' . $_GET['nomGroupe']);
        }
        
        switch($_GET['message']){

            case 'erreurConnexion':
                messageBox($danger, 'Veuillez réessayer.');
                break;

            case 'succesDeconnexion':
                messageBox($success, 'Déconnexion réussi');
                break;
            
            case 'succesInscription':
                messageBox($success, 'Inscription réussi.');
                break;

            case 'erreurInscription':
                messageBox($danger, 'Veuillez réessayer.');
                break;

            case 'erreurPage':
                messageBox($danger, 'Cette page n\'existe pas. Vous avez été redirigez vers la page d\'accueil.');
                break;

            case 'succesAlerte':
                messageBox($success, 'L\'alerte a été créée.');
                break;
            
            case 'erreurAlerte':
                messageBox($danger, 'L\'alerte n\'a pas été créée');
                break;
            
            case 'existeAlerte':
                messageBox($warning, 'Veuillez réessayer, ce nom existe déjà');
                break;
            
            case 'erreurPageAlerte':
                messageBox($warning, 'Cette page n\'existe pas. Vous avez été redirigez vers la page des alertes.');
                break;

            case 'succesApprouverAlerte':
                messageBox($success, 'L\'alerte a été approuvée.');
                break;

            case 'erreurApprouverAlerte':
                messageBox($danger, 'L\'alerte n\'a pas été approuver.');
                break;

            case 'succesArchiverAlerte':
                messageBox($success, 'Tous les éléments de l\'alerte ont été archiver.');
                break;

            case 'erreurArchiverAlerte':
                messageBox($danger, 'L\'alerte n\'a pas été archiver.');
                break;
            
            case 'succesArchiverProjet':
                messageBox($success, 'Tous les éléments du projet ont été archiver.');
                break;

            case 'erreurArchiverProjet':
                messageBox($danger, 'Le projet n\'a pas été archiver.');
                break;

            case 'succesApprouverCandidature':
                messageBox($success, 'La candidature a été approuvée.');
                break;

            case 'erreurApprouverCandidature':
                messageBox($danger, 'La candidature n\'a pas été approuvée.');
                break;

            case 'succesArchiverCandidature':
                messageBox($success, 'La candidature a été archiver.');
                break;

            case 'erreurArchiverCandidature':
                messageBox($danger, 'La candidature n\'a pas été archiver.');
                break;
            
            case 'succesEspece':
                messageBox($success, 'L\'espèce a été créée.');
                break;
            
            case 'succesProjet':
                messageBox($success, 'Le projet a été créé.');
                break;
            
            case 'existeProjet':
                messageBox($warning, 'Ce nom de projet existe déjà pour cette alerte.');
                break;

            case 'erreurDateProjet':
                messageBox($danger, 'La date du projet n\'est pas valide.');
                break;

            case 'erreurProjet':
                messageBox($danger, 'Le projet n\'a pas été créé.');
                break;

            case 'succesTache':
                messageBox($success, 'La tâche a été ajoutée.');
                break;

            case 'erreurProfil':
                messageBox($warning, 'Vous n\'avez aucun projet en cours.');
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

    function dateEn($var){
        $dateEn = "";
        $tab = explode("/", $var);
        
        if(array_key_exists(0, $tab) && array_key_exists(1, $tab)  && array_key_exists(2, $tab)){
            if(strlen($tab[2]) == 4 && intval($tab[2]) > 0
                && strlen($tab[1]) == 2 && intval($tab[1]) > 0
                && strlen($tab[0]) == 2 && intval($tab[0]) > 0){
                
                $dateEn = date($tab[2]."-".$tab[1]."-".$tab[0]);
            }
        }

        return $dateEn;
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

    function verificationIdGroupe($page){
        if(isset($_SESSION['Id_utilisateur'])){
            $verificationIdGroupe = DBconnexion()->prepare('SELECT Id_groupe FROM utilisateur WHERE Id_utilisateur = ' . $_SESSION['Id_utilisateur']);
            $verificationIdGroupe->execute();
            $donnees = $verificationIdGroupe->fetch();

            if($verificationIdGroupe->rowCount() > 0){
                // Mise à jour de la session
                $_SESSION['Id_groupe'] = $donnees['Id_groupe']; // mise en session de l'id du groupe de l'utilisateur
                $verificationIdGroupe->closeCursor();
            }else{
                $verificationIdGroupe->closeCursor();
                echo '<script>document.location.href="' . $page . '?message=erreurVerificationIdGroupe";</script>';
            }
        }
    }

    function parametreUrl(){
        parse_str($_SERVER['HTTP_REFERER'], $parametreUrl);
        return array_values($parametreUrl);
    }
?>