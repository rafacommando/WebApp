<?php

use Dompdf\Dompdf;
use Dompdf\Options;



if(!isset($_GET['id'])) {
    die();
}

require '../script/fonctions.php';

ob_start();

$intervention = getFicheInterventionParId($_GET['id']);
?>
<ul>
    <li> Numero Intervention: <?= $intervention["Numero_Intervention"] ?></li>
    <li> Raison Sociale: <?= $intervention["Raison_Sociale"] ?></li>
    <li> Nom Technicien: <?= $intervention["Nom_Employe"] ?></li>
    <li> Prenom Technicien: <?= $intervention["Prenom_Employe"] ?></li>
    <li> Date Visite: <?= $intervention["Date_Visite"] ?></li>
    <li> Heure Visite: <?= $intervention["Heure_Visite"] ?></li>
</ul>
<?php
$html = ob_get_contents();
ob_end_clean();

require '../interventions/dompdf/autoload.inc.php';

$option = new Options();
$option->set('defautFont', 'Courrier');

$dompdf = new Dompdf($option);


$dompdf->loadhtml($html);

$dompdf->setPaper('A4', 'Portrait');

$dompdf->render();

$fichier = 'intevention ' . $_GET['id'] . '.pdf';
$dompdf->stream($fichier);
