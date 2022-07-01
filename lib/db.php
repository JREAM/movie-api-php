<?php

try {
  $db = new \PDO('mysql:host=localhost;dbname=bit9', 'root', 'root');
  $db->setAttribute(
    PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_CLASS | PDO::FETCH_NAMED
  );

} catch (PDOException $e) {
  die($e->getMessage());
}

