<?php 
    session_start();
	
	if(empty($_SESSION['gestion'])){
		$_SESSION['gestion'] = 'erreur';
	}
	
	if($_SESSION['gestion'] == 'boutiques'){
		header('Location: gestions_boutiques.php');
	}elseif($_SESSION['gestion'] == 'produits'){
		header('Location: gestions_produits.php');
	}elseif($_SESSION['gestion'] == 'erreur'){
?>
    <!DOCTYPE html>
    <html>
        <head>
            <?php require 'includes/head.php'; ?>
        </head>

        <body>
          <?php 
              require 'includes/btn_fixed.php';
              require 'includes/menu.php';
          ?>

          <div id="form_conn" class="form">
              <div class="tab-content">
                  <h1 class="titre_connexion">Espace Admin</h1>
                  <form action="includes/fonctions/fonction_conn" method="post">
                      <div class="field-wrap">
                          <label>
                              Pseudo<span class="req">*</span>
                          </label>
                          <input type="text" name="pseudoAdmin" required autocomplete="off" autofocus/>
                      </div>

                      <div class="field-wrap">
                          <label>
                              Mot de passe<span class="req">*</span>
                          </label>
                          <input type="password" name="passwordAdmin" required autocomplete="off"/>
                      </div>

                      <button class="button button-block" name="connexionAdmin">Connexion</button>
                  </form>
              </div><!-- tab-content -->
            </div> <!-- /form -->

            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script  src="js/index.js"></script>
        </body>
    </html>
<?php
	}
?>