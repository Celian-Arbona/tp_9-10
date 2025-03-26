<?php
require 'Model/pdo.php';
?>
<h1>Liste des étudiants</h1>
<ul>
    <?php
    $etudiants = $dbPDO->prepare("SELECT * FROM etudiants");
    $etudiants->execute();
    foreach ($etudiants as $etudiant) { ?>
        <li><?php echo htmlspecialchars($etudiant['prenom']) . " " . htmlspecialchars($etudiant['nom']); ?></li>
    <?php } ?>
</ul>
<br>
<h1>Liste des classes</h1>
<ul>
    <?php
    $classes = $dbPDO->prepare("SELECT * FROM classes");
    $classes->execute();
    foreach ($classes as $classe) { ?>
        <li><?php echo htmlspecialchars($classe['libelle']); ?></li>
    <?php } ?>
</ul>
<br>
<h1>Liste des professeurs</h1>
<ul>
    <?php
    $professeurs = $dbPDO->prepare("SELECT * FROM professeurs");
    $professeurs->execute();
    foreach ($professeurs as $professeur) { ?>
        <li><?php echo htmlspecialchars($professeur['prenom']) . " " . htmlspecialchars($professeur['nom']); ?></li>
    <?php } ?>
</ul>
<br>

<h1>Liste des matières</h1>
<ul>
    <?php
    $matieres = $dbPDO->prepare("SELECT * FROM matiere");
    $matieres->execute();
    foreach ($matieres as $matiere) { ?>
        <li><?php echo htmlspecialchars($matiere['lib']); ?></li>
    <?php } ?>
</ul>
<br>

<h1>Liste des etudiants, classes et professeurs</h1>
<ul>
    <?php
    $profs = $dbPDO->prepare("SELECT * FROM professeurs INNER JOIN classes ON professeurs.id_classe = classes.id INNER JOIN matiere ON professeurs.id_matiere = matiere.id");
    $profs->execute();
    foreach ($profs as $professeurs) { ?>
        <li><?php echo "Professeur : ".htmlspecialchars($professeurs['prenom'])." ".htmlspecialchars($professeurs['nom'])." | matière : ".htmlspecialchars($professeurs['lib']) . " | classe : " . htmlspecialchars($professeurs['libelle']); ?></li>
    <?php } ?>
</ul>

<h1>Ajouter une nouvelle matière</h1>
<form action="Views/nouvelle_matiere.php" method="post">
    <label for="libelle">Lib :</label>
    <input type="text" id="libelle" name="libelle" required>
    <button type="submit">Valider</button>
</form>

<h1>Ajouter un nouvel étudiant</h1>
<form action="Views/nouvel_etudiant.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="classe">Classe :</label>
    <select id="classe" name="classe" required>
        <?php
        $classes = $dbPDO->query("SELECT * FROM classes");
        while ($classe = $classes->fetch()) {
            echo "<option value='".$classe['id']."'>".$classe['libelle']."</option>";
        }
        ?>
    </select>
    <button type="submit">Ajouter</button>
</form>
