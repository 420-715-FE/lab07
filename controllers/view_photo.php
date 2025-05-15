<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/photo.php');

class ViewPhotoController {
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

        include(__DIR__ . '/../views/view_photo.php');
    }
}

?>
