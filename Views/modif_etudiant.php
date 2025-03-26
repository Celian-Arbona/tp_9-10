<?php
require '../Model/pdo.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = $dbPDO->prepare("SELECT * FROM etudiants WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();

    if ($query->rowCount() > 0) {
        $etudiant = $query->fetch();
    } else {
        echo "L'entrée n'est pas valide.";
    }

} else {
    echo "L'id entré n'est pas valide.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['classe'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $classe = intval($_POST['classe']);
    $updateQuery = $dbPDO->prepare("UPDATE etudiants SET nom = :nom, prenom = :prenom, classe_id = :classe WHERE id = :id");
    $updateQuery->bindParam(':nom', $nom);
    $updateQuery->bindParam(':prenom', $prenom);
    $updateQuery->bindParam(':classe', $classe);
    $updateQuery->bindParam(':id', $id);

    if ($updateQuery->execute()) {
        echo "L'étudiant a bien été modifié.";
    } else {
        echo "La modification n'a pas pu aboutir.";
    }
}
?>

<h1>Modifier l'étudiant</h1>

<form action="" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" required>

    <label for="classe">Classe :</label>
    <select id="classe" name="classe" required>
        <?php
        $classes = $dbPDO->query("SELECT * FROM classes");

        while ($classe = $classes->fetch()) {
            $selected = $classe['id'] == $etudiant['classe_id'] ? 'selected' : '';
            echo "<option value='".$classe['id']."' $selected>".$classe['libelle']."</option>";
        }
        ?>
    </select>
    <button type="submit">Modifier</button>
</form>
<br>
<a href="../index.php">Retour à l'accueil</a>