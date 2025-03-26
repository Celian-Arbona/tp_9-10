<?php
require 'Model/pdo.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</head>
<body class="p-4">
    <div class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">Liste des étudiants</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Id</th>
                        <th scope="col" class="px-6 py-3">Prénom</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Classe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $etudiants = $dbPDO->query("
                        SELECT e.id, e.prenom, e.nom, c.libelle as classe 
                        FROM etudiants e 
                        JOIN classes c ON e.classe_id = c.id
                    ");
                    foreach ($etudiants as $etudiant): ?>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4"><?= htmlspecialchars($etudiant['id']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($etudiant['prenom']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($etudiant['nom']) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($etudiant['classe']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="auth.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Se connecter</a>
</body>
</html>