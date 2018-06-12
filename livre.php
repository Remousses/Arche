<?php
  session_start();
?>
<!DOCTYPE html>
  <html lang="fr">
    <head>
        <?php
            require_once 'includes/head.php';
            verificationIdGroupe('livre.php');
        ?>
    </head>
    
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <?php 
            require_once 'includes/menu.php';
        ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Accueil</a>
        </li>
        <li class="breadcrumb-item active">Livre de sauvetage</li>
      </ol>
        <div class="card mb-3">
              <a href="#">
                <div class="center"><img src="images/especes/Partula Clara.jpg" /></div><br>
              </a>
              <div class="card-body">
                <h6 class="card-title mb-1"><a href="#">Les escargots victimes de la lutte biologique</a></h6>
                <p class="card-text small">

Circa hos dies Lollianus primae lanuginis adulescens, Lampadi filius ex praefecto, exploratius causam Maximino spectante, convictus codicem noxiarum artium nondum per aetatem firmato consilio descripsisse, exulque mittendus, ut sperabatur, patris inpulsu provocavit ad principem, et iussus ad eius comitatum duci, de fumo, ut aiunt, in flammam traditus Phalangio Baeticae consulari cecidit funesti carnificis manu.

Quibus occurrere bene pertinax miles explicatis ordinibus parans hastisque feriens scuta qui habitus iram pugnantium concitat et dolorem proximos iam gestu terrebat sed eum in certamen alacriter consurgentem revocavere ductores rati intempestivum anceps subire certamen cum haut longe muri distarent, quorum tutela securitas poterat in solido locari cunctorum.

Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus: eosque ut heiulans baiolorum praecentor ad expediendum quod orsi sunt incitans vocibus crebris. qui haut longe postea ideo vivus exustus est.

                </p>
              </div>
              <hr class="my-0">
                <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">Modifier</a>
                </div>
              <div class="card-footer small text-muted">Postée le 3/01/2018</div>
            </div>
            <div class="card-header">Ajouter un livre</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nom du livre</label>
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Entrer informations">
              </div>
		 <div class="col-md-6">
                <label for="exampleInputImage">Image</label>
                <input class="form-control" id="exampleInputInformation" type="file" aria-describedby="nameHelp">
              </div>

            </div>
          </div>
          <a class="btn btn-primary btn-block" href="login.html">Enregistrer</a>
        </form>
      </div>
      </div>
			<?php 
				require_once 'includes/footer.php';
			?>
		</div>
	</body>
</html>