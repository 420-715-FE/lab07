<?php

require_once(__DIR__ . '/../controller.php');
require_once(__DIR__ . '/../models/album.php');

class AlbumsController {
    private $model;

    public function __construct($db) {
        $this->model = new AlbumModel($db);
    }

    public function handle($get) {
        $albums = $this->model->getAll();
        foreach ($albums as $idx => $album) {
            if (!$album['featured_photo_filepath']) {
                $albums[$idx]['featured_photo_filepath'] = 'image_placeholder.png';
            }
        }
        include(__DIR__ . '/../views/albums.php');
    }
}

?>
