<?php
include 'testConnexion.php';
function getFicheClient($NumClient) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM Client WHERE Numero_Client = $NumClient");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getGestionnaire() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Matricule, Nom_Employe, Prenom_Employe, Adresse_Employe, Date_Embauche FROM Employe WHERE Matricule NOT IN (SELECT Matricule FROM Technicien);");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function listeTechnicienMemeAgence($NumClient) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Technicien.Matricule, Technicien.Nom_Employe, Technicien.Prenom_Employe FROM Technicien WHERE Technicien.Numero_Agence in (SELECT Client.Numero_Agence FROM Client WHERE Client.Numero_Client = :NumClient);");
        $req->bindValue(':NumClient', $NumClient, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll();   
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getNombresInterventions($Matricule, $dateDebut, $dateFin) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT COUNT(Matricule) FROM Intervention WHERE Matricule IN (SELECT Matricule FROM Technicien WHERE Matricule = :Matricule) AND Date_Visite BETWEEN :dateDebut AND :dateFin;");
        $req->bindValue(':Matricule', $Matricule, PDO::PARAM_STR);
        $req->bindValue(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $req->bindValue(':dateFin', $dateFin, PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getDureeDeplacement($Matricule, $dateDebut, $dateFin) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare(" SELECT SUM(Duree_Deplacement) FROM Client WHERE Numero_Client IN (SELECT Numero_Client FROM Intervention WHERE Matricule = :Matricule AND Date_Visite BETWEEN :dateDebut AND :dateFin);");
        $req->bindValue(':Matricule', $Matricule, PDO::PARAM_STR);
        $req->bindValue(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $req->bindValue(':dateFin', $dateFin, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getDistanceKM($Matricule, $dateDebut, $dateFin) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT SUM(Distance_KM) FROM Client WHERE Numero_Client IN (SELECT Numero_Client FROM Intervention WHERE Matricule = :Matricule AND Date_Visite BETWEEN :dateDebut AND :dateFin);");
        $req->bindValue(':Matricule', $Matricule, PDO::PARAM_STR);
        $req->bindValue(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $req->bindValue(':dateFin', $dateFin, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function setFicheClient($NumClient, $RaisonSocial, $Siren, $CodeAPE, $Adresse, $Telephone_Client, $Emails, $Duree_Deplacement, $Distance_KM, $Numero_Agence) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE Client
        SET Raison_Sociale = :RaisonSocial,
        Siren = :Siren,
        Code_Ape = :CodeAPE,
        Adresse = :Adresse,
        Telephone_Client = :Telephone_Client,
        Emails = :Emails,
        Duree_Deplacement = :Duree_Deplacement,
        Distance_KM = :Distance_KM,
        Numero_Agence = :Numero_Agence
        WHERE Numero_Client = :NumClient");
        $req->bindValue(':NumClient', $NumClient, PDO::PARAM_STR);
        $req->bindValue(':RaisonSocial', $RaisonSocial, PDO::PARAM_STR);
        $req->bindValue(':Siren', $Siren, PDO::PARAM_STR);
        $req->bindValue(':CodeAPE', $CodeAPE, PDO::PARAM_STR);
        $req->bindValue(':Adresse', $Adresse, PDO::PARAM_STR);
        $req->bindValue(':Telephone_Client', $Telephone_Client, PDO::PARAM_STR);
        $req->bindValue(':Emails', $Emails, PDO::PARAM_STR);
        $req->bindValue(':Duree_Deplacement', $Duree_Deplacement, PDO::PARAM_STR);
        $req->bindValue(':Distance_KM', $Distance_KM, PDO::PARAM_STR);
        $req->bindValue(':Numero_Agence', $Numero_Agence, PDO::PARAM_STR);
        $result = $req->execute();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getFichesInterventions() {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Intervention.Numero_Intervention, Client.Numero_Client, Client.Raison_Sociale, Intervention.Matricule, Technicien.Nom_Employe, Technicien.Prenom_Employe, Intervention.Date_Visite, Intervention.Heure_Visite FROM Technicien RIGHT JOIN Intervention ON Intervention.Matricule = Technicien.Matricule, Client WHERE Intervention.Numero_Client = Client.Numero_Client;");
        $req->execute();

        $resultat = $req->fetchAll();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getFicheInterventionParId($id) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Intervention.Numero_Intervention, Client.Raison_Sociale, Technicien.Nom_Employe, Technicien.Matricule, Technicien.Prenom_Employe, Intervention.Date_Visite, Intervention.Heure_Visite FROM Intervention, Client, Technicien WHERE Intervention.Numero_Client = Client.Numero_Client AND Intervention.Matricule = Technicien.Matricule AND Numero_Intervention = :id;");
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getInterventionAAffecterParId($id) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT *  FROM Intervention WHERE Numero_Intervention = :id;");
        $req->bindValue(':id', $id, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function setFicheIntervention($Matricule, $intervention) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE Intervention 
        SET
        Intervention.Matricule = :Matricule
        WHERE Intervention.Numero_Intervention = :intervention");
        $req->bindValue(':Matricule', $Matricule, PDO::PARAM_STR);
        $req->bindValue(':intervention', $intervention, PDO::PARAM_STR);

        $result = $req->execute();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getFichesInterventionsSansTechnicien() {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM Intervention WHERE Matricule IS NULL;");
        $req->execute();

        $resultat = $req->fetchAll();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getMatricule($Nom) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Matricule FROM Technicien WHERE Nom_Employe = :Nom;");
        $req->bindValue(':Nom', $Nom, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getFichesInterventionsByMatricule($matricule) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Intervention.Numero_Intervention, Client.Numero_Client, Client.Raison_Sociale, Intervention.Matricule, Technicien.Nom_Employe, Technicien.Prenom_Employe, Intervention.Date_Visite, Intervention.Heure_Visite FROM Technicien RIGHT JOIN Intervention ON Intervention.Matricule = Technicien.Matricule, Client WHERE Intervention.Numero_Client = Client.Numero_Client AND Intervention.Matricule = :matricule;");
        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getFicheInterventionByDate($dateDebut, $dateFin) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Intervention.Numero_Intervention, Client.Numero_Client, Client.Raison_Sociale, Intervention.Matricule, Technicien.Nom_Employe, Technicien.Prenom_Employe, Intervention.Date_Visite, Intervention.Heure_Visite FROM Technicien RIGHT JOIN Intervention ON Intervention.Matricule = Technicien.Matricule, Client WHERE Intervention.Numero_Client = Client.Numero_Client AND Intervention.Date_Visite BETWEEN :dateInterventionDebut AND :dateInterventionFin;");
        $req->bindValue(':dateInterventionFin', $dateFin, PDO::PARAM_STR);
        $req->bindValue(':dateInterventionDebut', $dateDebut, PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetchAll();
        } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getFicheInterventionByDateAndMatricule($dateDebut, $dateFin, $matricule) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT Intervention.Numero_Intervention, Client.Numero_Client, Client.Raison_Sociale, Intervention.Matricule, Technicien.Nom_Employe, Technicien.Prenom_Employe, Intervention.Date_Visite, Intervention.Heure_Visite FROM Technicien RIGHT JOIN Intervention ON Intervention.Matricule = Technicien.Matricule, Client WHERE Intervention.Numero_Client = Client.Numero_Client AND Intervention.Date_Visite BETWEEN :dateInterventionDebut AND :dateInterventionFin AND Intervention.Matricule = :matricule;");
        $req->bindValue(':dateInterventionFin', $dateFin, PDO::PARAM_STR);
        $req->bindValue(':dateInterventionDebut', $dateDebut, PDO::PARAM_STR);
        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);

        $req->execute();

        $resultat = $req->fetchAll();
        } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function setFicheInterventionEntiere($intervention, $date, $heure, $NumClient) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE Intervention 
        SET Intervention.Numero_Intervention = :intervention, Intervention.Date_Visite =:dateIntervention, Intervention.Heure_Visite = :heure, Intervention.Numero_Client= :numero_client
        WHERE Intervention.Numero_Intervention = :intervention");
        $req->bindValue(':intervention', $intervention, PDO::PARAM_STR);
        $req->bindValue(':dateIntervention', $date, PDO::PARAM_STR);
        $req->bindValue(':heure', $heure, PDO::PARAM_STR);
        $req->bindValue(':numero_client', $NumClient, PDO::PARAM_STR);

        $result = $req->execute();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


function getFicheInterventionByPlusProche($matricule) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT *
        FROM Intervention i LEFT JOIN Technicien t ON i.Matricule=t.Matricule, Client c
        WHERE i.Numero_Client=c.Numero_Client AND i.Matricule = :matricule
        ORDER BY c.Distance_KM;");

        $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetchAll();
        } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function setCommentaireAndTime($intervention, $commentaire, $temps) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE Intervention 
        SET Intervention.commentaire = :commentaire, Intervention.temps_passer = :temps
        WHERE Intervention.Numero_Intervention =:intervention;");

        $req->bindValue(':intervention', $intervention, PDO::PARAM_STR);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':temps', $temps, PDO::PARAM_STR);

        $result = $req->execute();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
