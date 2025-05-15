<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader("Album « {$album['name']} »");

?>

<body>

<h1><?= "Album « {$album['name']} »" ?></h1>

<nav>
    <ul>
        <li><a href="?action=albums">Retour</a></li>
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
