<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader('Galerie de photos');

?>

<body>

<h1>Galerie de photos</h1>

<nav>
    <ul>
        <li>Galerie</li>
        <li><a href="?action=albums">Albums</a></li>
        <li><a href="?action=add_photo">Ajouter une photo</a></li>
    </ul>
</nav>

<ul id="gallery">
    <?php foreach ($photos as $photo): ?>
        <li>
            <a href="?action=view_photo&id=<?= $photo['id'] ?>">
                <img src="<?= $photo['filepath'] ?>" alt="<?= $photo['description'] ?>">
                <p><?= $photo["description"] ?></p>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
