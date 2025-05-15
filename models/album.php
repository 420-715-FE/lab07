<?php

class AlbumModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = $this->db->query("
            SELECT album.id, album.name, photo.filepath AS featured_photo_filepath
                FROM album
                LEFT JOIN photo
                    ON photo.id = album.featured_photo_id
        ");
        return $query->fetchAll();
    }

    public function get($id) {
        $query = $this->db->prepare("
            SELECT album.id, album.name, photo.filepath AS featured_photo_filepath
                FROM album
                LEFT JOIN photo
                    ON photo.id = album.featured_photo_id
                WHERE album.id = ?
        ");
        $query->execute([$id]);
        return $query->fetch();
    }

    public function getPhotos($albumID) {
        $query = $this->db->prepare("
            SELECT photo.id, description, timestamp, latitude, longitude, filepath
                FROM photo
                JOIN album_photo
                    ON photo_id = photo.id AND album_id = ?
        ");
        $query->execute([$albumID]);
        return $query->fetchAll();
    }
}

?>
