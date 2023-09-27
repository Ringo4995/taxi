<?php
include "../header.php";
require "../DB.php";

if (!empty($_GET)) {
    $requete2 = $pdo->prepare("SELECT * FROM vehicule where id_vehicule = :id");
    $requete2->execute([
        "id" => $_GET['id_vehicule']

    ]);
    $vehicule = $requete2->fetch();
}


if (isset($_POST['send'])) {
    $marque = strip_tags($_POST['marque']);
    $modele = strip_tags($_POST['modele']);
    $couleur = strip_tags($_POST['couleur']);
    $immatr = strip_tags($_POST['immatriculation']);
    $error = null;
    if (empty($marque)) {
        $error = '<li>Veuillez ajouter la marque du véhicule.</li>';
    } elseif (strlen($marque) < 2 || strlen($marque) > 45) {
        $error = '<li>Le nom de la marque doit faire entre 2 et 45 caractères.</li>';
    }
    if (empty($modele)) {
        $error .= '<li>Veuillez ajouter le modèle de votre véhicule.</li>';
    } elseif (strlen($modele) < 2 || strlen($modele) > 45) {
        $error .= '<li>Le nom du modèle doit faire entre 2 et 45 caractères.</li>';
    }
    if (empty($couleur)) {
        $error .= "<li>Veuillez renseignez la couleur du véhicule.</li>";
    } elseif (strlen($couleur) < 2 || strlen($couleur) > 45) {
        $error .= '<li>Le nom de la couleur doit faire entre 2 et 45 caractères.</li>';
    }
    if (empty($immatr)) {
        $error .= "<li>Veuillez ajouter la plaque d'immatricuation du véhicule.</li>";
    } elseif (strlen($immatr) < 2 || strlen($immatr) > 45) {
        $error .= "<li>La plaque d'immatriculation doit faire entre 2 et 45 caractères.</li>";
    }

    if (empty($error)) {

        $query = $pdo->prepare("UPDATE vehicule SET marque = :marque, modele = :modele, couleur = :couleur, immatriculation = :immatriculation where id_vehicule     = :id");
        $query->execute([
            "marque" => $marque,
            "modele" => $modele,
            "couleur" => $couleur,
            "immatriculation" => $immatr,
            "id" => $_GET['id_vehicule']
        ]);
        header("location:/taxi/afficherVehicule.php");
    }
}



?>


<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label class="form-label mt-4 text-success">Marque :</label>
            <input type="text" class="form-control" placeholder="La marque de votre véhicule" name="marque" value="<?php echo $vehicule['marque'] ?>">
        </div>
        <div class="form-group">
            <label class="form-label mt-4 text-success">Modèle :</label>
            <input type="text" class="form-control" placeholder="Le modèle de votre véhicule" name="modele" value="<?php echo $vehicule['modele'] ?>">
        </div>
        <div class="form-group">
            <label class="form-label mt-4 text-success">Couleur :</label>
            <input type="text" class="form-control" placeholder="La couleur de votre véhicule" name="couleur" value="<?php echo $vehicule['couleur'] ?>">
        </div>
        <div class="form-group">
            <label class="form-label mt-4 text-success">Immatriculation :</label>
            <input type="text" class="form-control" placeholder="La plaque d'immatriculation de votre véhicule" name="immatriculation" value="<?php echo $vehicule['immatriculation'] ?>">
        </div>
        <button type="submit" class="btn btn-primary" name="send">Envoyer</button>
    </form>
    <a href="/entreprise/index.php" class="text-success">Retour</a>
    <?php
    if (!empty($error)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Il manque des éléments pour modifier votre véhicule !</h4>
        <?php echo $error;
    } ?>
        </div>
</div>
<?php
include "../footer.php";

?>

<?php

include "../footer.php";
