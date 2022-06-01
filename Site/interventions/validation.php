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
</head>

<body>
    <div class="w3-sidebar w3-bar-block w3-black w3-xxlarge" style="width:70px">
        <a href="../index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
        <a href="../recherche/choix_recherche.html" class="w3-bar-item w3-button"><i class="fa fa-search"></i></a>
        <a href="../../deconnexion.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>

    </div>
    <div id="padding-sidebar">

        <div class="col-md-2 offset-4"> 
            <form method="POST" class="d-flex">
                <label for="Matricule" class="d-flex align-items-center">Matricule</label>
                <input id="Matricule" type="text" name="Matricule" class="m-5"><br>
                <button type="submit" class="m-5">envoyer</button>
            </form>
        </div>

        <?php include '../script/fonctions.php'; ?>
            <section class="container">
                <?php foreach (getFichesInterventionsByMatricule($_POST['Matricule']) as $ligne) : ?>
                    <div id="intevention-box" onclick="window.location = 'CommentaireTmps.php?id=<?= $ligne['Numero_Intervention']?>&matricule=<?= $ligne['Matricule']?>'" class="intervention-card">
                        <ul>
                            <li> Numero Intervention: <?= $ligne["Numero_Intervention"] ?></li>
                            <li> Raison Sociale: <?= $ligne["Raison_Sociale"] ?></li>
                            <li> Maticule: <?= $ligne["Matricule"] ?></li>
                            <li> Nom Employe: <?= $ligne["Nom_Employe"] ?></li>
                            <li> Prenom Employe: <?= $ligne["Prenom_Employe"] ?></li>
                            <li> Date Visite: <?= $ligne["Date_Visite"] ?></li>
                            <li> Heure Visite: <?= $ligne["Heure_Visite"] ?></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </section>

    </div>
</body>

</html>