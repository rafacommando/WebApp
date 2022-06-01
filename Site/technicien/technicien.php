<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="intervention.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
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
    <div id="padding-sidebar">
        <?php include '../script/fonctions.php'; ?>
        <section class="container col-md-12 d-flex justify-content-around pt-150">
            <?php foreach (getFichesInterventionsSansTechnicien() as $ligne) : ?>
                <div id="intevention-box" onclick="window.location = 'affecterTechnicien.php?Intervention=<?= $ligne['Numero_Intervention'] ?>&client=<?= $ligne['Numero_Client'] ?>'" class="intervention-card">
                    <ul>
                        <li> Numero Intervention: <?= $ligne["Numero_Intervention"] ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</body>

</html>