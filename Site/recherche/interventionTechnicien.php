<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link href="../interventions/intervention.css" rel="stylesheet">
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

        <div class="col-md-12 d-flex justify-content-center mb-40">
            <form method="POST">
                <label for="date">saisissez votre matricule de technicien</label>
                <input type="text" name="numeroTechnicien">
                <button type="submit">envoyer</button>
            </form>
        </div>


        <div class="mt-40">
            <?php include '../script/fonctions.php';
            if (!empty($_POST['numeroTechnicien'])) : ?>
                <?php foreach (getFichesInterventionsByMatricule($_POST['numeroTechnicien']) as $ligne) : ?>
                    <ul class='list-unstyled' style='text-align: center;'>
                            <li> Numero Intervention: <?= $ligne["Numero_Intervention"] ?></li>
                            <li> Raison Sociale: <?= $ligne["Raison_Sociale"] ?></li>
                            <li> Maticule: <?= $ligne["Matricule"] ?></li>
                            <li> Nom Employe: <?= $ligne["Nom_Employe"] ?></li>
                            <li> Prenom Employe: <?= $ligne["Prenom_Employe"] ?></li>
                            <li> Date Visite: <?= $ligne["Date_Visite"] ?></li>
                            <li> Heure Visite: <?= $ligne["Heure_Visite"] ?></li>
                    </ul>
                <?php endforeach; ?>
        </div>
    </div>

<?php endif; ?>
</div>
</body>

</html>