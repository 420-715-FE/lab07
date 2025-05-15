<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader($photo['description']);

?>

<body>

<h1>Photo</h1>

<nav>
    <ul><li><a href="?">Retour</a></li></ul>
</nav>

<?php

if (isset($erreur)) {
    echo "<p>$erreur</p>";
}

?>

<img src="<?= $photo['filepath'] ?>" />
<form method="POST">
    <div>
        <label for="description"><strong>Description:</strong></label>
        <input type="text" id="description" name="description" value="<?= $photo['description'] ?>">
    </div>
    <div>
        <label for="timestamp"><strong>Date et heure:</strong></label>
        <input type="datetime-local" id="timestamp" name="timestamp" value="<?= $photo['timestamp'] ?>">
    </div>
    <div>
        <label for="latitude"><strong>Latitude:</strong></label>
        <input type="text" id="latitude" name="latitude" value="<?= $photo['latitude'] ?>">
    </div>
    <div>
        <label for="longitude"><strong>Longitude:</strong></label>
        <input type="text" id="longitude" name="longitude" value="<?= $photo['longitude'] ?>">
    </div>
    <div>
        <button type="submit">Soumettre</button>
    </div>
</form>

</body>
</html>
