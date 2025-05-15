<?php

require_once('db.php');
require_once('controllers/gallery.php');
require_once('controllers/albums.php');
require_once('controllers/view_photo.php');
require_once('controllers/add_photo.php');
require_once('controllers/edit_photo.php');
require_once('controllers/delete_photo.php');
require_once('controllers/view_album.php');

$controller = new GalleryController($db);

$action = $_GET['action'] ?? 'gallery';

$controller = null;
switch ($action) {
    case 'albums':
        $controller = new AlbumsController($db);
        break;
    case 'view_photo':
        $controller = new ViewPhotoController($db);
        break;
    case 'add_photo':
        $controller = new AddPhotoController($db);
        break;
    case 'edit_photo':
        $controller = new EditPhotoController($db);
        break;
    case 'delete_photo':
        $controller = new DeletePhotoController($db);
        break;
    case 'view_album':
        $controller = new ViewAlbumController($db);
        break;
    case 'gallery':
    default:
        $controller = new GalleryController($db);
        break;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->handlePost($_GET, $_POST);
} else {
    $controller->handle($_GET);
}

?>
