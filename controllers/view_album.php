<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/album.php');

class ViewAlbumController {
    private $model;

    public function __construct($db) {
        $this->model = new AlbumModel($db);
    }

    public function handle($get) {
        if (!isset($get['id'])) {
            header("Location: 404.php");
            return;
        }

        $album = $this->model->get($get['id']);
        if (!$album) {
            header("Location: 404.php");
            return;
        }

        $photos = $this->model->getPhotos($album['id']);

        include(__DIR__ . '/../views/view_album.php');
    }
}

?>
