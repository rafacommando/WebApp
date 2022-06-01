<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link href="css/index.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>CashCash</title>
</head>

<body>
  <div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:70px">
    <a href="index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
    <a href="recherche/choix_recherche.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i></a>
    <a href="../deconnexion.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
  </div>
  <?php
  include 'script/fonctions.php';

  ?>
  <div class="d-flex justify-content-center">
    <form method="post" style="padding:2%;">
      <input class="textBox" type="text" name="matriculeTechnicien">
      <input class="textBox" type="date" name="dateDebut" value="2010-01-01">
      <input class="textBox" type="date" name="dateFin" value="2022-01-01">
      <input class="textBox" type="submit">
    </form>
  </div>

  <?php
  $DistanceKM = 0;
  $DureeDeplacement = 0;
  $NombresInterventions = 0;
  if (empty($_POST['matriculeTechnicien'])) {
  } else {
    foreach (getNombresInterventions($_POST['matriculeTechnicien'], $_POST['dateDebut'], $_POST['dateFin']) as $ligne) {
      $NombresInterventions = $ligne;
    }
  }
  if (empty($_POST['matriculeTechnicien'])) {
  } else {
    foreach (getDureeDeplacement($_POST['matriculeTechnicien'], $_POST['dateDebut'], $_POST['dateFin']) as $ligne) {
      $DureeDeplacement = $ligne;
    }
  }
  if (empty($_POST['matriculeTechnicien'])) {
  } else {
    foreach (getDistanceKM($_POST['matriculeTechnicien'], $_POST['dateDebut'], $_POST['dateFin']) as $ligne) {
      $DistanceKM = $ligne;
    }
  }
  ?>
  <div>
    <p class='col-md-5 offset-md-4'>Durée de déplacement:<?= $DureeDeplacement ?> </p>
    <p class='col-md-5 offset-md-4'>Distance Effectuée en KM: <?= $DistanceKM ?> </p>
    <p class='col-md-5 offset-md-4'>Nombres d'interventions: <?= $NombresInterventions ?></p>
  </div>


</body>

</html>