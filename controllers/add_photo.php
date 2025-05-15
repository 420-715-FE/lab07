<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/photo.php');
require_once(__DIR__ . '/../helpers.php');

// Source: https://www.usefulids.com/resources/generate-uuid-in-php
function uuid()
{
    // Generate 16 random bytes
    $data = random_bytes(16);

    // Set the version to 4 (0100 in binary)
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set the variant to 2 (10 in binary)
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Return the formatted UUID
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

class AddPhotoController {
    private $model;

    public function __construct($db) {
        $this->model = new PhotoModel($db);
    }

    public function handle($get) {
        include(__DIR__ . '/../views/add_photo.php');
    }

    public function handlePost($get, $post) {
        $erreur = null;

        if (isset($_FILES['photo'])) {
            if ($_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $filename = $_FILES['photo']['name'];
                $filetype = $_FILES['photo']['type'];
                $tempPath = $_FILES['photo']['tmp_name'];

                if (str_starts_with($filetype, 'image/')) {
                    $extension = pathinfo($filename, PATHINFO_EXTENSION);
                    $newFilename = uuid() . '.' . $extension;
                    $newPath = "images/$newFilename";

                    if (move_uploaded_file($tempPath, $newPath)) {
                        $photoId = $this->model->insert($newPath);
                        header("Location: ?action=edit_photo&id=$photoId");
                    } else {
                        $erreur = 'Une erreur est survenue sur le serveur.';
                    }
                } else {
                    $erreur = "Le fichier sélectionné n'est pas une image.";
                }
            } else {
                $erreur = 'Une erreur est survenue lors du téléversement.';
            }
        }

        if ($erreur) {
            include(__DIR__ . '/../views/add_photo.php');
        }
    }
}

?>
