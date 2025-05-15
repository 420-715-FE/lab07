<?php

require_once(__DIR__ . '/../helpers.php');

generateHTMLHeader('Ajouter une photo');

?>

<body>

<h1>Ajouter une photo</h1>

<nav>
    <ul><li><a href="?">Retour</a></li></ul>
</nav>

<?php

if (isset($erreur)) {
    echo "<p>$erreur</p>";
}

?>

<form method="POST" enctype="multipart/form-data">
    <label for="photo">Choisissez une photo :</label>
    <input type="file" id="photo" name="photo" accept="image/*">
    <input type="submit" value="Téléverser">
    <label for=""></label>
</form>

</body>
</html>
