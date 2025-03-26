<?php
require '../Model/pdo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['classe'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $classe = intval($_POST['classe']);
    $query = $dbPDO->prepare("INSERT INTO etudiants (nom, prenom, classe_id) VALUES (:nom, :prenom, :classe)");
    $query->bindParam(':nom', $nom);
    $query->bindParam(':prenom', $prenom);
    $query->bindParam(':classe', $classe);
    
    if ($query->execute()) {
        echo "L'étudiant a été ajouté<br>";
    } else {
        echo "L'ajout de l'étudiant a échoué.<br>";
    }
}
?>
<a href="../index.php">Retour à l'acceuil</a>
