<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link href="recherche.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>CashCash</title>
</head>

<body>
  <div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:70px">
    <a href="../index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
    <a href="../recherche/choix_recherche.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i></a>
    <a href="../../deconnexion.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>

  </div>
  <div class="col-md-12 d-flex justify-content-center pt-40">
    <form method="post" class="text-center">
      Numero Client: <input id="textBox" type="text" name="numeroClient">
      <input id="boutton" type="submit">
    </form>
  </div>
  <?php
  include '../script/fonctions.php';
  if (!empty($_POST['numeroClient'])) : ?>
    <?php foreach (getFicheClient($_POST['numeroClient']) as $ligne) : ?>
      <ul class='list-unstyled' style='text-align: center;'>
        <li> Numéro client: <?= $ligne["Numero_Client"] ?></li>
        <li> Raison sociale: <?= $ligne["Raison_Sociale"] ?></li>
        <li> Siren: <?= $ligne["Siren"] ?></li>
        <li> Code Ape: <?= $ligne["Code_Ape"] ?></li>
        <li> Adresse: <?= $ligne["Adresse"] ?></li>
        <li> Téléphone client: <?= $ligne["Telephone_Client"] ?></li>
        <li> Emails: <?= $ligne["Emails"] ?></li>
        <li> Durée Deplacement: <?= $ligne["Duree_Deplacement"] ?></li>
        <li> Distance KM: <?= $ligne["Distance_KM"] ?></li>
        <li> Numéro Agence: <?= $ligne["Numero_Agence"] ?></li>
      </ul>
      <div style="text-align: center;"><a href="modif.php?client=<?= $ligne["Numero_Client"] ?>"><button>Modifier</button></a></div>

    <?php endforeach; ?>
    </div>
    </div>

  <?php endif; ?>
</body>