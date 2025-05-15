<?php

abstract class Controller {
  protected $db; 

  function __construct($db) {
    $this->db = $db;
  }

  abstract function handle($get);

  function handlePost($get, $post) {}
}

?>
