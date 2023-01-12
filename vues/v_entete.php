<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Loup-garou</title>
</head>
<body class="default">
<nav class="navbar navbar-dark navbar-expand-lg bg-dark" style="margin-top:-25px;">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php?uc=accueil"><img src="images/icon.png" alt="logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link <?=$_REQUEST['uc'] == "accueil" ? "active" : ""?>" aria-current="page" href="index.php?uc=accueil" onclick="confirmation()" id="confirmationLeave">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?=$_REQUEST['uc'] == "partie" && $_REQUEST['action'] == "voirParties" ? "active" : ""?>" href="index.php?uc=partie&action=voirParties">Jouer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?uc=partie&action=PartieInProgress">Test</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Historique Partie</a>
              </li>
            </ul>
            <?php            
              if ($estConnecte == true) {
                ?>
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item ms-auto">
                      <a class="nav-link" href="index.php?uc=connexion&action=deconnexion">Deconnexion</a>
                    </li>
                  <li class="nav-item">
                  <a class="nav-link disabled">Connecté en tant que : <?=$_SESSION['joueur']->getPseudo()?></a>
              </li>
                  </ul>
                <?php
              } else {
                ?>
                 <ul class="navbar-nav ms-auto">
                  <li class="nav-item ms-auto">
                      <a class="nav-link" href="index.php?uc=connexion&action=connexion">Connexion</a>
                    </li>
                    <li class="nav-item ms-auto">
                      <a class="nav-link" href="index.php?uc=connexion&action=inscription">Inscription</a>
                    </li>
                  </ul>
                <?php
              }
            ?>
          </div>
        </div>
      </nav>