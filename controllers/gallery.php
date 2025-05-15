<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/photo.php');

class GalleryController {
    private $model;

    public function __construct($db) {
        $this->model = new PhotoModel($db);
    }

    public function handle($get) {
        $photos = $this->model->getAll();
        include(__DIR__ . '/../views/gallery.php');
    }
}

?>
