<?php
include '../script/fonctions.php';
if (isset($_POST['affecter'])) {
    setFicheIntervention($_POST['affecter'], $_GET["id"]);
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="intervention.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>CashCash</title>
    <script src="./script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:70px">
        <a href="../index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
        <a href="../recherche/choix_recherche.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i></a>
        <a href="../../deconnexion.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
    </div>
    <div id="padding-sidebar">
        <?php
        $intervention = getInterventionAAffecterParId($_GET['id']); ?>
        <div class="col-md-3 offset-5">
            <ul style="list-style: none;">
                <li class="d-flex"> Numero Intervention: <div class="modifierType"><?= $intervention["Numero_Intervention"] ?></div>
                </li>
                <li class="d-flex"> Raison Sociale: <div class="modifierType"><?= $intervention["Numero_Client"] ?></div>
                </li>
                <li class="d-flex"> Matricule: <div class=""><?= $intervention["Matricule"] ?></div>
                </li>
                <li class="d-flex"> Date Visite: <div class="modifierType"><?= $intervention["Date_Visite"] ?></div>
                </li>
                <li class="d-flex"> Heure Visite: <div class="modifierType"><?= $intervention["Heure_Visite"] ?></div>
                </li>
                <li class="d-flex"> Commentaire: <div class="modifierType"><?= $intervention["commentaire"] ?></div>
                </li>
                <li class="d-flex"> Temps passé: <div class="modifierType"><?= $intervention["temps_passer"] ?></div>
                </li>
            </ul>
        </div>


        <div class="col-md-3 offset-5">
            <form method="POST">
                Commentaire<input id="commentaire" type="text" name="commentaire" class="m-2"><br>
                Temps Passé<input id="temps_passer" type="time" name="temps_passer" class="m-2"><br>
                <button type="submit" class="m-2">envoyer</button>
            </form>
        </div>

        <?= setCommentaireAndTime($_GET["id"], $_POST['commentaire'], $_POST['temps_passer']);
        ?>


    </div>
</body>

</html>