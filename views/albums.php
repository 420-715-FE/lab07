<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader('Galerie de photos');

?>

<body>

<h1>Albums</h1>

<nav>
    <ul>
        <li><a href="?">Galerie</a></li>
        <li>Albums</li>
        <li><a href="?action=add_photo">Ajouter une photo</a></li>
    </ul>
</nav>

<ul id="gallery">
    <?php foreach ($albums as $album): ?>
        <li>
            <a href="?action=view_album&id=<?= $album['id'] ?>">
                <img src="<?= $album['featured_photo_filepath'] ?>" alt="<?= $album['name'] ?>">
                <p><?= $album["name"] ?></p>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
