<?php

class PhotoModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $query = $this->db->query("SELECT id, description, timestamp, latitude, longitude, filepath FROM photo");
        return $query->fetchAll();
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT id, description, timestamp, latitude, longitude, filepath FROM photo WHERE id = ?");
        $query->execute([$id]);
        $photo = $query->fetch();

        if (!$photo) {
            return null;
        }

        $query = $this->db->prepare("SELECT name FROM tag INNER JOIN photo_tag ON tag.id = photo_tag.tag_id WHERE photo_tag.photo_id = ?");
        $query->execute([$id]);
        $tags = $query->fetchAll();

        $photo['tags'] = [];
        foreach ($tags as $tag) {
            $photo['tags'][] = $tag['name'];
        }

        return $photo;
    }

    public function insert($filepath) {
        $query = $this->db->prepare('INSERT INTO photo(filepath) VALUES(?)');
        $query->execute([$filepath]);
        return $this->db->lastInsertId();
    }

    public function update($id, $description, $timestamp, $latitude, $longitude) {
        $query = $this->db->prepare('UPDATE photo SET description=?, timestamp=?, latitude=?, longitude=? WHERE id=?');
        $query->execute([$description, $timestamp, $latitude, $longitude, $id]);
    }

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM photo WHERE id=?');
        $query->execute([$id]);
    }
}

?>
