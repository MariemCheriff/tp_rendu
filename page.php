<?php
require "index.php";

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM film
        WHERE Titre LIKE :search
        OR An LIKE :search
        OR Rang LIKE :search
        OR Fid LIKE :search";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'search' => "%$search%"
]);

$films = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des films</title>

    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Liste des films</h2>

<form method="GET">
    <input type="text"
           name="search"
           placeholder="Titre, année ou rang..."
           value="<?= htmlspecialchars($search) ?>">

    <button type="submit">Rechercher</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Année</th>
        <th>Durée</th>
        <th>Rang</th>
    </tr>

    <?php foreach ($films as $film): ?>
    <tr>
        <td><?= htmlspecialchars($film['Fid']) ?></td>
        <td><?= htmlspecialchars($film['Titre']) ?></td>
        <td><?= htmlspecialchars($film['An']) ?></td>
        <td><?= htmlspecialchars($film['Dur']) ?></td>
        <td><?= htmlspecialchars($film['Rang']) ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>