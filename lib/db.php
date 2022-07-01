<?php
require_once '../constants.php';

/**
 * Get a Database Instance
 *
 * @return PDO $db
 */
function getDatabase(): PDO
{
  try {
    $connectionString = sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME);

    $db = new \PDO($connectionString, DB_USER, DB_PASS);

    // Fetch Array [key => value] sets.
    $db->setAttribute(
      PDO::ATTR_DEFAULT_FETCH_MODE,
      PDO::FETCH_CLASS | PDO::FETCH_NAMED
    );

    return $db;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
