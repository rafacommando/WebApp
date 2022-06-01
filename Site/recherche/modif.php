<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>CashCash</title>
</head>

<body>
  <?php include '../script/fonctions.php'; ?>
  <?php if (isset($_POST["Raison_Sociale"])) {
    $success = setFicheClient($_GET["client"], $_POST["Raison_Sociale"], $_POST["Siren"], $_POST["Code_Ape"], $_POST["Adresse"], $_POST["Telephone_Client"], $_POST["Emails"], $_POST["Duree_Deplacement"], $_POST["Distance_KM"], $_POST["Numero_Agence"]);
  } ?>
  <?php if (isset($_POST["Raison_Sociale"]) && $success) : ?>
    <script>
      alert("Modification effectuée");
      window.location.href = 'index.php';
    </script>
  <?php endif; ?>
  <div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:70px">
    <a href="../index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
    <a href="../recherche/choix_recherche.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i></a>
    <a href="../../deconnexion.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
    
  </div>
  <?php if (empty($_GET['client'])) : ?>
    <p class='text-center' style='font-size: 40px;'>Entrez un numéro client</p>
  <?php else : ?>
    <?php foreach (getFicheClient($_GET['client']) as $ligne) : ?>
      <form method="post">
        <ul class="list-unstyled" style="text-align: center;">
          <li> Numéro client: <?= $ligne["Numero_Client"] ?></li>
          <li> Raison sociale: <input id="textBox" type="text" name="Raison_Sociale" value="<?= $ligne["Raison_Sociale"] ?>"></li>
          <li> Siren: <input id="textBox" type="text" name="Siren" value="<?= $ligne["Siren"] ?>"></li>
          <li> Code Ape: <input id="textBox" type="text" name="Code_Ape" value="<?= $ligne["Code_Ape"] ?>"></li>
          <li> Adresse: <input id="textBox" type="text" name="Adresse" value="<?= $ligne["Adresse"] ?>"></li>
          <li> Téléphone client: <input id="textBox" type="text" name="Telephone_Client" value="<?= $ligne["Telephone_Client"] ?>"></li>
          <li> Emails: <input id="textBox" type="text" name="Emails" value="<?= $ligne["Emails"] ?>"></li>
          <li> Durée Deplacement: <input id="textBox" type="text" name="Duree_Deplacement" value="<?= $ligne["Duree_Deplacement"] ?>"></li>
          <li> Distance KM: <input id="textBox" type="text" name="Distance_KM" value="<?= $ligne["Distance_KM"] ?>"></li>
          <li> Numéro Agence: <input id="textBox" type="text" name="Numero_Agence" value="<?= $ligne["Numero_Agence"] ?>"></li>
        </ul>
        <div style="text-align:center;">
          <button type="submit">Modifier</button>
        </div>
      </form>
    <?php endforeach; ?>
  <?php endif; ?>
</body>

</html>