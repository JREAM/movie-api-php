<?php
require_once '../constants.php';
require_once '../lib/curl.php';
require_once '../lib/output.php';

$movieId = (int) $_GET['id'];

try {
  $result = curl(API_ENDPOINT . "/movie/$movieId", API_KEY);
  json($result);
} catch (Exception $error) {
  json($error);
}
