<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/photo.php');

function isValidTimestamp($timestamp) {
    $dateTime = DateTime::createFromFormat('Y-m-d\TH:i', $timestamp);    
    return $dateTime && $dateTime->format('Y-m-d\TH:i') === $timestamp;
}

class EditPhotoController {
    private $model;

    public function __construct($db) {
        $this->model = new PhotoModel($db);
    }

    public function handle($get) {
        if (!isset($get['id'])) {
            header("Location: 404.php");
            return;
        }

        $photo = $this->model->get($get['id']);
        if (!$photo) {
            header("Location: 404.php");
            return;
        }

        include(__DIR__ . '/../views/edit_photo.php');
    }

    public function handlePost($get, $post) {
        $erreur = false;

        if (
            !isset($post['description'])
            || !isset($post['timestamp'])
            || !isset($post['longitude'])
            || !isset($post['latitude'])
        ) {
            $erreur = "Certains champs sont manquants.";
        }
        $description = htmlspecialchars(trim($post['description']));
        $timestamp = htmlspecialchars(trim($post['timestamp']));
        $longitude = htmlspecialchars(trim($post['longitude']));
        $latitude = htmlspecialchars(trim($post['latitude']));

        if (!empty($timestamp) && !isValidTimestamp($timestamp)) {
            $erreur = 'Le format de la date et heure est invalide.';
        }

        if (!empty($longitude) && doubleval($longitude) != $longitude) {
            $erreur = 'La longitude doit être un nombre décimal.';
        }

        if (!empty($latitude) && doubleval($latitude) != $latitude) {
            $erreur = 'La latitude doit être un nombre décimal.';
        }

        if ($erreur) {
            $photo = $this->model->get($get['id']);
            if (!$photo) {
                header("Location: 404.php");
            } else {
                include(__DIR__ . '/../views/edit_photo.php');
            }
        } else {
            $this->model->update(
                $get['id'],
                $description,
                empty($timestamp) ? null : $timestamp,
                empty($longitude) ? null : $longitude,
                empty($latitude) ? null : $latitude
            );
            header("Location: ?action=view_photo&id=" . $get['id']);
        }
    }
}

?>
