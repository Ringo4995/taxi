<?php

include "../header.php";
require "../DB.php";

if (isset($_POST['envoi'])) {
    $prenom = strip_tags($_POST['prenom']);
    $nom = strip_tags($_POST['nom']);
    $errorPilote = null;
    if (empty($prenom)) {
        $errorPilote = '<li>Veuillez renseigner le prénom du pilote.</li>';
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 45) {
        $errorPilote = '<li>Le prénom du pilote doit faire entre 2 et 45 caractères.</li>';
    }
    if (empty($nom)) {
        $errorPilote .= '<li>Veuillez renseigner le nom du pilote.</li>';
    } elseif (strlen($nom) < 2 || strlen($nom) > 45) {
        $errorPilote .= '<li>Le nom du pilote doit faire entre 2 et 45 caractères.</li>';
    }

    if (empty($errorPilote)) {

        $requeteConducteur->execute([
            "prenom" => $prenom,
            "nom" => $nom
        ]);
        header("location:/taxi/conducteur.php");
    }
}

?>

<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label class="form-label mt-4 text-success">Prénom :</label>
            <input type="text" class="form-control" placeholder="Le prénom de votre pilote" name="prenom">
        </div>
        <div class="form-group">
            <label class="form-label mt-4 text-success">Nom :</label>
            <input type="text" class="form-control" placeholder="Le nom de votre pilote" name="nom">
        </div>
        <button type="submit" class="btn btn-primary" name="envoi">Envoyer</button>
    </form>
    <a href="/entreprise/index.php" class="text-success">Retour</a>
    <?php
    if (!empty($errorPilote)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Il manque des éléments pour ajouter votre pilote !</h4>
        <?php echo $errorPilote;
    } ?>
        </div>
</div>
<?php
include "../footer.php";
