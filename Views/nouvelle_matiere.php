<?php
require '../Model/pdo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['libelle'])) {
    $libelle = htmlspecialchars($_POST['libelle']);
    $query = $dbPDO->prepare("INSERT INTO matiere (lib) VALUES (:libelle)");
    $query->bindParam(':libelle', $libelle);
    
    if ($query->execute()) {
        echo "La matière a été ajouté<br>";
    } else {
        echo "L'ajout de la matière a échoué.<br>";
    }
}
?>
<a href="../index.php">Retour à l'acceuil</a>
