<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');
 ?>
<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nuit de l'info - Diprozone</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Nuit de l'info.</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#meteo">Meteo</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#trafic">Trafic</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#flux">Flux</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#equipe">Equipe</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
 

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" height="250" width="250" src="img/index.png" alt="">
        <h1 class="text-uppercase mb-0"><p id="lien"></p></h1>
        <script type="text/javascript">
          var chaine = "Nuit de l'info."; 
          var nb_car = chaine.length; 
          var tableau = chaine.split("");
          texte = new Array;
          var txt = '';
          var nb_msg = nb_car - 1;
          for (i=0; i<nb_car; i++) {
            texte[i] = txt+tableau[i];
            var txt = texte[i];
          }

          actual_texte = 0;
          function changeMessage()
          {
            document.getElementById("lien").innerHTML = texte[actual_texte];
            actual_texte++;
            if(actual_texte >= texte.length)
              actual_texte = nb_msg;
            }
            if(document.getElementById)

            setInterval("changeMessage()",200) /* la vitesse de defilement (plus on a une valeur faible plus 
          texte s'affiche rapidement) */
        </script>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Météo - Trafic - FLux RSS</h2>
      </div>
    </header>

    
   <!-- Meteo Section -->
    <section id="meteo">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Meteo </h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form action="index.php#meteoo" method="post">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <input class="form-control" name="ville" type="text" placeholder="Nom de la ville" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" name="sendMessageButton">Send</button>
                <?php if(isset($_SESSION['erreur'])){
                echo '<p><span class="label label-danger">'.$_SESSION['erreur'].'</span>';
                unset($_SESSION['erreur']);
            } ?>
            <?php if(isset($_SESSION['reussi'])){
                echo '<p><span class="label label-success">'.$_SESSION['reussi'].'</span>';
                unset($_SESSION['reussi']);
            } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <?php 
    if(isset($_POST['sendMessageButton'])){
        $ville = $_POST['ville'];
        $url = 'http://api.openweathermap.org/data/2.5/weather?q='.$ville.'&units=metric&lang=fr&appid=37a8b85b29df0784ad8d674bf98bf2d5'; // path to your JSON file
        
        $data = file_get_contents($url); // put the contents of the file into a variable
        $meteo = json_decode($data); // decode the JSON feed
        ?>
        <div class="container" id="meteoo">
          <div class="row">
            <div class="col-lg-8 mx-auto">
        <h2 class="font-weight-light mb-0"><?php echo "Ville : ". $meteo->name;?></h2><br/>
        <h2 class="font-weight-light mb-0"><?php echo "Température : ". $meteo->main->temp . "C"; ?></h2><br/>
        <h2 class="font-weight-light mb-0"><?php echo "Température min : ". $meteo->main->temp_min . "C";?></h2><br/>
        <h2 class="font-weight-light mb-0"><?php echo "Température max : ". $meteo->main->temp_max . "C";?></h2><br/>
        <h2 class="font-weight-light mb-0"><?php echo "Le temps : ". $meteo->weather[0]->description . " / " .$meteo->weather[1]->description;?></h2><br/>

      </div>
    </div>
      </div>
        <?php
        
        
        
    }
    else {
      //

    }
    
    
     ?>
   
   <!-- Trafic -->

    <section id="trafic" class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" height="250" width="250" src="img/voiture.png" alt="">
        <h1 class="text-uppercase mb-0">Trafic</h1>
        <hr class="star-light">
        
        <iframe 
        src="http://www.inforoute48.fr/"
        width="100%" height="500"
        sandbox>
          <p>
            <a href="http://www.inforoute48.fr/">
            Un lien à utiliser dans les cas où les navigateurs ne supportent
            pas les <i>iframes</i>.
            </a>
          </p>
        </iframe><br/>
        <br/>
        <br/>

        <h3 class="font-weight-light mb-0">Si la carte ne s'affiche pas cliquer -> <a style="color:white;" target="_blank" href="http://www.inforoute48.fr/">ici</a></h3>
      
      </div>
    </section>

    <!--Flux Section -->
    <section id="flux">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Flux RSS </h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <article>
              

      
            
              <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Actualité
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <?php
                  $rss_link = "http://www.48info.fr/rss.php?categorie=1";
                  $rss_load = simplexml_load_file($rss_link);
                  foreach ($rss_load->channel->item as $item) {
                    $PROPRE = utf8_decode($item->title); ?>
                    <a href="<?= $item->link ?>"><?php echo $PROPRE; ?></a><br/><br/>
                    <?php
                  }
               ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Sortir
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <?php
                  $rss_link = "http://www.48info.fr/rss.php?categorie=3";
                  $rss_load = simplexml_load_file($rss_link);
                  foreach ($rss_load->channel->item as $item) {
                    $PROPRE = utf8_decode($item->title); ?>
                    <a href="<?= $item->link ?>"><?php echo $PROPRE; ?></a><br/><br/>
                    <?php
                  }
               ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Sport
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <?php
                  $rss_link = "http://www.48info.fr/rss.php?categorie=2";
                  $rss_load = simplexml_load_file($rss_link);
                  foreach ($rss_load->channel->item as $item) {
                    $PROPRE = utf8_decode($item->title); ?>
                    <a href="<?= $item->link ?>"><?php echo $PROPRE; ?></a><br/><br/>
                    <?php
                  }
               ?>
      </div>
    </div>
  </div>
</div>
            </article>
           
            
          </div>
        </div>
      </div>
    </section>


      <!-- Portfolio Grid Section -->
    <section class="portfolio" id="equipe">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Equipe</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-1">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/1.jpg" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-2">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/2.jpg" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-3">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/3.jpg" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-4">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/4.jpg" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-5">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/5.jpg" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-6">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/6.jpg" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

    

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Nuit de l'info 2018</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-1">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Quentin PLA</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/1.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-2">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Axel AMGHAR</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/2.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-3">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Thomas MICELI</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/3.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-4">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Xavier MAISSE</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/4.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-5">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Grégory NAM</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/5.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-6">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Louis DUTTIER</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/6.jpg" alt="">
              <p class="mb-5">Equipe Diprozone</p>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
