<?php
require '../Model/pdo.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = intval($_GET['id']);
    $checkQuery = $dbPDO->prepare("SELECT * FROM etudiants WHERE id = :id");
    $checkQuery->bindParam(':id', $id);
    $checkQuery->execute();

    if ($checkQuery->rowCount() > 0) {
        $deleteQuery = $dbPDO->prepare("DELETE FROM etudiants WHERE id = :id");
        $deleteQuery->bindParam(':id', $id);

        if ($deleteQuery->execute()) {
            echo "L'étudiant a bien été supprimer.";

        } else {
            echo "La suppression n'a pas pu aboutir.";
        }

    } else {
        echo "L'entrée n'est pas valide.";
    }

} else {
    echo "L'id entré n'est pas valide.";
}
?>
<br>
<a href="../index.php">Retour à l'accueil</a>
