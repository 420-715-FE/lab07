<?php

class AlbumModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = $this->db->query("
            SELECT album.id, album.name, featured_photo_id, photo.filepath AS featured_photo_filepath
                FROM album
                LEFT JOIN photo
                    ON photo.id = album.featured_photo_id
        ");
        return $query->fetchAll();
    }

    public function get($id) {
        $query = $this->db->prepare("
            SELECT album.id, album.name, featured_photo_id, photo.filepath AS featured_photo_filepath
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
            SELECT photo.id, description, filepath
                FROM photo
                JOIN album_photo
                    ON photo_id = photo.id AND album_id = ?
        ");
        $query->execute([$albumID]);
        return $query->fetchAll();
    }

    public function create($name, $featured_photo_id) {
        $query = $this->db->prepare("
            INSERT INTO album(name, featured_photo_id) VALUES(?, ?)
        ");

        $this->db->beginTransaction();
        $query->execute([$name, $featured_photo_id]);
        $id = $this->db->lastInsertId();
        $this->db->commit();

        return $id;
    }

    public function update($id, $name, $featured_photo_id) {
        $query = $this->db->prepare("
            UPDATE album
                SET name = ?, featured_photo_id = ?
                WHERE id = ?
        ");
        $query->execute([$name, $featured_photo_id, $id]);
    }

    public function delete($id) {
        $query = $this->db->prepare("DELETE FROM album WHERE id = ?");
        $query->execute([$id]);
    }

    public function addPhotos($id, $photoIds) {
        $this->db->beginTransaction();
        foreach ($photoIds as $photoId) {
            $query = $this->db->prepare('INSERT INTO album_photo(album_id, photo_id) VALUES(?, ?)');
            $query->execute([$id, $photoId]);
        }
        $this->db->commit();
    }

    public function removePhoto($id, $photoId) {
        $query = $this->db->prepare("DELETE FROM album_photo WHERE album_id = ? AND photo_id = ?");
        $query->execute([$id, $photoId]);
    }
}

?>
