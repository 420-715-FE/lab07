<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader($photo['description']);

?>

<body>

<h1>Photo</h1>

<nav>
    <ul>
        <li><a href="?">Retour</a></li>
        <li><a href="?action=edit_photo&id=<?= $photo['id'] ?>">Modifier</a></li>
        <li>
            <a
                href="?action=delete_photo&id=<?= $photo['id'] ?>"
                onclick="return confirm('Voulez-vous vraiment supprimer cette photo?')"
            >
                Supprimer
            </a>
        </li>
    </ul>
</nav>

<img src="<?= $photo['filepath'] ?>" />
<p><strong>Description: </strong><?= $photo['description'] ?></p>
<p><strong>Date et heure: </strong><?= $photo['timestamp'] ?></p>
<p><strong>Latitude: </strong><?= $photo['latitude'] ?></p>
<p><strong>Longitude: </strong><?= $photo['longitude'] ?></p>
<p><strong>Étiquettes: </strong></p>
<ul>
    <?php foreach ($photo['tags'] as $tag): ?>
        <li><?= $tag ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
