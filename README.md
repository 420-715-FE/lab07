# Laboratoire 07

Dans le cadre de ce laboratoire, vous devez reprendre le code du Laboratoire 06-C et y intégrer une API REST permettant de gérer les albums de la galerie de photos. Vous utiliserez cette API dans le laboratoire 08.

Le dépôt contient présentement une copie de la solution du laboratoire 06-C. Vous pouvez remplacer des fichiers par ceux de votre propre laboratoire si vous préférez.

## Routes

L'API devra offrir les routes suivantes:

* `GET api/albums`
* `GET api/albums/{id}`
* `POST api/albums`
* `PUT api/albums/{id}`
* `DELETE api/albums/{id}`
* `GET api/albums/{idAlbum}/photos`
* `POST api/albums/{idAlbum}/photos`
* `DELETE api/albums/{idAlbum}/photos/{idPhoto}`

## Développement

Vous implémenterez l'API dans le fichier `api.php`. Celui-ci fera appel à votre modèle des albums pour effectuer les opérations **CRUD** *(**C**reate, **R**ead, **U**pdate, **D**elete)* sur la base de données. Éventuellement, nous voudrions sans doute revoir l'architecture de notre application afin d'intégrer plus fortement l'API à notre MVC, mais pour l'instant l'essentiel de la logique de l'API se trouvera dans `api.php`, et ce fichier ne fera pas appel à des contrôleurs. Un fichier *.htaccess* est déjà présent pour rediriger les requêtes commençant par `/api` vers `/api.php`.

Inspirez-vous des exemples vus en classe, et testez vos routes d'API au fur et à mesure que vous les implémentez, en utilisant une application telle que [Bruno](https://www.usebruno.com/). Vous pouvez aussi observer les résultats des requêtes de création, modification et suppression à même la galerie de photos.

## JSON

Voici les formats des objets JSON qui doivent être échangés avec chacune des routes:

La route `GET api/albums` doit retourner un tableau JSON contenant un objet pour chaque album dans la base de données. Les objets ont les mêmes clés que le tableau associatif retourné par la méthode `getAll` de votre modèle des albums.

```json
[
    {
        "id": 1,
        "name": "Zoo de Granby",
        "featured_photo_id": 2
    },
    {
        "id": 2,
        "name": "Plages",
        "featured_photo_id": 3
    }
]
```

La route `GET api/albums/{id}`, pour sa part, retourne un seul album:

```json
{
    "id": 2,
    "name": "Plages",
    "featured_photo_id": 3
}
```

Lorsqu'on appelle la route `POST api/albums` ou `PUT api/albums/{id}`, on lui transmet un objet JSON contenant les nouvelles données de l'album à ajouter ou modifier. On n'inclut cependant pas le champ `id`.

```json
{
    "name": "Plages de sable",
    "featured_photo_id": 3
}
```

La route `DELETE api/albums/{id}`, pour sa part, ne nécessite pas l'envoi d'un objet JSON.

> Pour toutes les routes `POST`, `PUT` et `DELETE`, nous ne retournerons aucun objet JSON si l'opération est valide et produit le code d'état `200 OK`. Dans le cas contraire, nous retournerons un objet JSON contenant la clé `error` dont la valeur sera un message d'erreur (ex: `{ "error": "Album not found." })`).

La route `GET api/albums/{idAlbum}/photos` retourne un tableau d'objets correspondant aux photos présentes dans l'album spécifié.

```json
[
    {
        "id": 1,
        "description": "Parc de la Pointe, Rivière-du-Loup.",
        "filepath": "images/01c2fe0d-6758-4f0a-945d-0dc44a95f973.jpg"
    },
    {
        "id": 3,
        "description": "Coucher de soleil à Parlee Beach.",
        "filepath": "images/38fec351-8f80-41e8-bc53-22cd0d02bdf5.jpg"
    }
]
```

La route `POST api/albums/{idAlbum}/photos` doit être appelée en lui passant un tableau des ID de photos à **ajouter** à l'album.

```json
[1, 3, 4, 5 10]
```

Finalement, la route `DELETE api/albums/{idAlbum}/photos/{idPhoto}` permet de retirer une photo d'un album. Il n'y a aucun objet JSON à passer à cette route.
