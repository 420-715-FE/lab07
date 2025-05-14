# Laboratoire 07

Dans le cadre de ce laboratoire, vous devez reprendre votre code du laboratoire 06-C (ou celui du corrigé) et y intégrer une API REST permettant de gérer les albums et les étiquettes (*tags*). Vous utiliserez cette API dans le laboratoire 08.

L'API devra offrir les routes suivantes:

*Entité **albums***

* `GET albums`
* `POST albums`
* `PUT albums/{id}`
* `DELETE albums/{id}`

*Entité **tags***

* `GET tags`
* `POST tags`
* `PUT tags/{id}`
* `DELETE tags/{id}`

*Tags d'une photo*

* `GET photos/{idPhoto}/tags`
* `POST photos/{idPhoto}/tags`
* `DELETE photos/{idPhoto}/tags/{idTag}`

Vous implémenterez l'API dans le fichier `api.php`. Celui-ci fera appel aux modèles de votre architecture MVC pour effectuer les opérations **CRUD** (*Create, read, update, delete*) sur la base de données. Éventuellement, nous voudrions sans doute revoir l'architecture de notre application afin d'intégrer plus fortement l'API à notre MVC, mais pour l'instant l'essentiel de la logique de l'API se trouvera dans `api.php`, et ce fichier ne fera pas appel à des contrôleurs.