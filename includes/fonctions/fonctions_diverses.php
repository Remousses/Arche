<?php
    function alerteBox($message, $page){
        echo '<script>alert("' . $message . '");location="' . $page . '"</script>';
    }

    function message($id, $message, $page){
        echo '<script>location="' . $page . '"; document.getElementById("' . $id . '").value = "' . $message . '";</script>';
    }

    function pagePrecedente(){
        define('pageprecedente', $_SERVER["HTTP_REFERER"], true);
	
        /*if(pageprecedente == "gestions_produits.php" || pageprecedente == "gestions_boutiques.php"){
            header('Location: index.php');
        }else{*/
            header('Location: ' . pageprecedente);
        //}
    }
?>