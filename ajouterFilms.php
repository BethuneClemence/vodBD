<?php 
    if(isset($_POST['formEnvoyer'])){
      $nomFilm = $_POST['nomFilm'];
      $annee = $_POST['annee'];
      $realisateur = $_POST['realisateur'];


      // var_dump($_FILES);

      $ajouterOk = FALSE;
      $file_1 = $_FILES['afficheFilm'];
      $type_1 = explode("/", $file_1['type']);
      $path_1 = "style/images/" . basename($nomFilm.'.jpg');
      if (move_uploaded_file($file_1['tmp_name'], $path_1)) {
          
        $file_2 = $_FILES['photoRea'];
        $type_2 = explode("/", $file_2['type']);
        $path_2 = "style/images/" . basename($realisateur.'.jpg');

        if (move_uploaded_file($file_2['tmp_name'], $path_2)) {
          
          // TODO: Ajouter un film dans le fichier
          include("model/Model.php");
          $model = new Model();
          $films = $model->insererFilm($nomFilm,$annee,$realisateur);
          $ajouterOk = TRUE;
        }else{
          $erreur = True;
        }

      } else {
          $erreur = True;
      }
     
    }
    
?>


<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>VOD TV</title>
  <link rel="stylesheet" href="style/bulma-0.8.2/css/bulma.css">
  <link rel="stylesheet" href="style/style.css">
  <link rel="shortcut icon" href="style/images/logo-onglet.png" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/17dde9277d.js" crossorigin="anonymous"></script>
  <script src="script.js"></script>
  
</head>
<body>
 
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
      <a class="navbar-item" href="https://bulma.io">
        <img src="style/images/logo.png">
      </a>
  
      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
  
    <div id="navbarBasicExample" class="navbar-menu">
      <div class="navbar-start">
        <a href="vod.html" class="navbar-item">
          <i  id="iconNavbar" class="fas fa-home"></i>&nbsp;
          Accueil
        </a>
  
        <a href="consulterFilms.php" class="navbar-item">
          <i id="iconNavbar" class="fas fa-list"></i>&nbsp;
          Consulter
        </a>

        <a href="saisieTitreRecherche.html" class="navbar-item">
          <i id="iconNavbar" class="fas fa-search"></i>&nbsp;
          Rechercher
        </a>

        <a href="saisieFilms.html" class="navbar-item">
          <i id="iconNavbar" class="fas fa-plus"></i>&nbsp;
          Ajouter
        </a>

        <a href="saisieTitreSupression.html" class="navbar-item">
          <i id="iconNavbar" class="fas fa-trash-alt"></i>&nbsp;
          Supprimer
        </a>
  
        
      </div>
  
      
    </div>

  </nav>

  <br>
  <br>
  <br>
  <bR>

  
  <?php if($ajouterOk == TRUE){ ?> 
    <div class="columns">
      <div class="column"></div>
      <div class="column is-one-third">
        <div class="notification is-primary">
          <button class="delete"></button>
            Le film <b><?php echo $nomFilm;?></b> a été ajouté avec succès ! 😉 👏🏼
        </div>
        
      </div>
      <div class="column"></div>
    </div>
  <?php } else {?>
    <div class="columns">
      <div class="column"></div>
      <div class="column is-one-third">
        <div class="notification is-danger">
          <button class="delete"></button>
            Le film <b><?php echo $nomFilm;?></b> n'a pas pu etre ajouté! 😟 
        </div>
        
      </div>
      <div class="column"></div>
    </div>
  <?php }?>

  

</body>

<!-- Site footer -->
<footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <h6><b>A propos</b></h6>
          <p class="text-justify">Avec plus de <b>3,5 millions d'abonnés</b> et des productions exclusives
                                  régulièrement acclamées par la critique, <b>VOD TV</b> est incontestablement le leader du marché.
                                  Il s'agit donc d'une valeur sûre. N'hésitez plus, regardez vos films et séries ici !</p> 
        </div>

       

        <div class="col-xs-6 col-md-3">
          <h6><b>Quick Links</b></h6>
          <ul class="footer-links">
            <li><a href="vod.html">Accueil</a></li>
            <li><a href="ajouterFilms.php">Ajouter</a></li>
            <li><a href="supprimerFilms.php">Supprimer</a></li>
            
          </ul>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-6 col-xs-12">
          <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by 
       <a href="#">BETHUNE Clémence</a>.
          </p>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <ul class="social-icons">
            <li><a class="github" href="https://github.com/BethuneClemence"><i class="fab fa-github"></i></a></li>
            <li><a class="linkedin" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
            
          </ul>
        </div>
      </div>
    </div>
</footer>

</html>