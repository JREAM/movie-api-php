<?php
require '../constants.php';
require '../lib/curl.php';

$movieId = (int) $_GET['id'];

curl("$API_ENDPOINT/movie/$movieId", $API_KEY);

