<?php

$pdo = new PDO("mysql:host = localhost; dbname=taxi; charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$error = null;
try{
    $statement = $pdo->query("SELECT * FROM vehicule");

    $requete = $pdo->prepare("INSERT INTO vehicule(marque,modele,couleur,immatriculation) values(:marque,:modele,:couleur,:immatriculation)");

    $statementConducteur = $pdo->query("SELECT * FROM conducteur");

    $requeteConducteur = $pdo->prepare("INSERT INTO conducteur(prenom,nom) values(:prenom,:nom)");

}catch(PDOException $exp){
    $error = $e->getMessage();
}
?>