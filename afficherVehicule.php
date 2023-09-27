<?php include "header.php";
require "DB.php";

if(!empty($_GET)){
    $query = $pdo->prepare("DELETE FROM vehicule where id_vehicule = :id");
    $query->execute([
        "id" => $_GET['id_vehicule']
    ]);
    header("location:/taxi/afficherVehicule.php");
}

$vehicules = $statement->fetchAll();

?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Marque</th>
                <th scope="col">Modèle</th>
                <th scope="col">Couleur</th>
                <th scope="col">Véhicule</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicules as $vehicule) {
            ?>
                <tr class="table-warning">
                    <th scope="row"><?= $vehicule['marque'] ?></th>
                    <td><?= $vehicule['modele'] ?></td>
                    <td><?= $vehicule['couleur'] ?></td>
                    <td><?= $vehicule['immatriculation'] ?></td>
                    <td scope="col"><a href="/taxi/crudtaxi/modifier.php?id_vehicule=<?= $vehicule['id_vehicule'] ?>" style="text-decoration:none">Modifier</a></td>
                    <td scope="col"><a href="/taxi/afficherVehicule.php?id_vehicule=<?= $vehicule['id_vehicule'] ?>" style="text-decoration:none">Supprimer</a></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>


<?php include "footer.php" ?>