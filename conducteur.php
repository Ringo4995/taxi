<?php include "header.php";
require "DB.php";

if(!empty($_GET)){
    $query = $pdo->prepare("DELETE FROM conducteur where id_conducteur = :id");
    $query->execute([
        "id" => $_GET['id_conducteur']
    ]);
    header("location:/taxi/conducteur.php");
}

$conducteurs = $statementConducteur->fetchAll();

?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conducteurs as $conducteur) {
            ?>
                <tr class="table-warning">
                    <th scope="row"><?= $conducteur['prenom'] ?></th>
                    <td><?= $conducteur['nom'] ?></td>
                    <td scope="col"><a href="/taxi/crudtaxi/modifierConducteur.php?id_conducteur=<?= $conducteur['id_conducteur'] ?>" style="text-decoration:none">Modifier</a></td>
                    <td scope="col"><a href="/taxi/conducteur.php?id_conducteur=<?=  $conducteur['id_conducteur'] ?>" style="text-decoration:none">Supprimer</a></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>


<?php include "footer.php" ?>