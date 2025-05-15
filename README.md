# Laboratoire 07

Dans le cadre de ce laboratoire, vous devez reprendre votre code du laboratoire 06-C (ou celui du corrigé) et y intégrer une API REST permettant de gérer les albums et les étiquettes (*tags*). Vous utiliserez cette API dans le laboratoire 08.

## Routes

L'API devra offrir les routes suivantes:

*Entité **albums***

* `GET api/albums`
* `POST api/albums`
* `PUT api/albums/{id}`
* `DELETE api/albums/{id}`

*Photos d'un album*

* `GET api/albums/{idAlbum}/photos`
* `POST api/albums/{idAlbum}/photos`
* `DELETE api/albums/{idAlbum}/photos/{idPhoto}`

*Entité **tags***

* `GET api/tags`
* `POST api/tags`
* `PUT api/tags/{id}`
* `DELETE api/tags/{id}`

*Tags d'une photo*

* `GET api/photos/{idPhoto}/tags`
* `POST api/photos/{idPhoto}/tags`
* `DELETE api/photos/{idPhoto}/tags/{idTag}`

## JSON

Voici les formats des objets JSON qui doivent être échangés avec chacune des routes:

## Développement

Vous implémenterez l'API dans le fichier `api.php`. Celui-ci fera appel aux modèles de votre architecture MVC pour effectuer les opérations **CRUD** (*Create, read, update, delete*) sur la base de données. Éventuellement, nous voudrions sans doute revoir l'architecture de notre application afin d'intégrer plus fortement l'API à notre MVC, mais pour l'instant l'essentiel de la logique de l'API se trouvera dans `api.php`, et ce fichier ne fera pas appel à des contrôleurs. Un fichier *.htaccess* est déjà présent pour rediriger les requêtes commençant par `/api` vers `/api.php`.

Testez vos routes d'API au fur et à mesure que vous les implémentez, en utilisant une application telle que [Bruno](https://www.usebruno.com/).
