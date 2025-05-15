<?php

/*
  Modifier cette constante selon votre cas (doit correspondre à l'emplacement
  de ce fichier à partir de htdocs, avec `/api/` à la fin)
  *** Ne PAS omettre les barres obliques au début et à la fin ***
*/
const BASE_URL = "/lab07/api/";

require_once("db.php");
require_once("models/album.php");

$albumModel = new AlbumModel($db);

/*
  On crée une fonction pour nous aider à retourner une réponse
  avec le bon code d'état HTTP.
*/
function sendResponse($code, $body = null)
{
    $statusCodes = [
        200 => "200 OK",
        400 => "400 Bad Request",
        401 => "401 Unauthorized",
        403 => "403 Forbidden",
        404 => "404 Not found",
        500 => "500 Internal Server Error",
    ];

    header("HTTP/1.1 " . $statusCodes[$code]);
    header("Content-Type: application/json; charset=utf-8");

    if ($body) {
        $jsonBody = json_encode($body); // La fonction json_encode convertit un tableau ou un tableau associatif en JSON
        echo $jsonBody; // On utilise echo pour placer le JSON dans le corps de la réponse
    }

    // On arrête le script pour s'assurer de ne rien envoyer d'autre
    exit();
}

// Récupère la route utilisée et la sépare selon les '/'
$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); // Récupère l'URL incluant BASE_URL
$route = str_replace(BASE_URL, "", $url); // Récupère la route en retirant BASE_URL de l'URL
$routeParts = explode("/", $route); // Retourne un tableau contenant les parties de la route (ex: contacts/42 -> ['contacts', '42'])

// Récupère la méthode HTTP utilisée (GET, POST, etc)
$method = $_SERVER["REQUEST_METHOD"];

// Récupère le corps de la requête (s'il y a lieu)
$jsonBody = file_get_contents("php://input");
$body = json_decode($jsonBody, true); // Convertit le JSON en tableau PHP (associatif ou non)

if 

switch ($method) {
    case "GET":
        if ($contactId) {
            $contact = $model->get($contactId);
            if ($contact) {
                sendResponse(200, $contact);
            } else {
                // Le contact n'existe pas
                sendResponse(404);
            }
        } else {
            $contacts = $model->getAll();
            sendResponse(200, $contacts);
        }
        break;
    case "POST":
        if ($contactId) {
            sendResponse(404); // On ne veut pas d'ID avec POST (création)
        }

        if (
            !isset($body["first_name"]) ||
            !isset($body["last_name"]) ||
            !isset($body["phone_numbers"]) ||
            !is_array($body["phone_numbers"]) ||
            !isset($body["addresses"]) ||
            !is_array($body["addresses"]) ||
            !isset($body["email_addresses"]) ||
            !is_array($body["email_addresses"])
        ) {
            sendResponse(400);
        }

        $model->insert(
            $body["first_name"],
            $body["last_name"],
            $body["phone_numbers"],
            $body["addresses"],
            $body["email_addresses"]
        );
        break;
    case "PUT":
        if (!$contactId) {
            // On veut absolument un ID avec un PUT (mise à jour)
            sendResponse(404);
        }

        if (
            !isset($body["first_name"]) ||
            !isset($body["last_name"]) ||
            !isset($body["phone_numbers"]) ||
            !is_array($body["phone_numbers"]) ||
            !isset($body["addresses"]) ||
            !is_array($body["addresses"]) ||
            !isset($body["email_addresses"]) ||
            !isset($body["email_addresses"])
        ) {
            sendResponse(400);
        }

        $contact = $model->get($contactId);
        if (!$contact) {
            sendResponse(404);
        }

        $model->update(
            $contactId,
            $body["first_name"],
            $body["last_name"],
            $body["phone_numbers"],
            $body["addresses"],
            $body["email_addresses"]
        );
        break;
    case "DELETE":
        if (!$contactId) {
            // On veut absolument un ID avec un DELETE
            sendResponse(404);
        }
        $model->delete($contactId);
        break;
    default:
        sendResponse(404);
}

?>
