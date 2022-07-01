<?php
require('../lib/db.php');
require('../lib/curl.php');
require('../constants.php');

// Get the Query POST (It could be a get, but oh well)
$query = htmlspecialchars($_POST['query']);

// -----------------------------------------------
// @IMPORTANT - SKIP DATABASE,  STARTS here
// -----------------------------------------------
// Track the user search record
$sth = $db->prepare('
  INSERT INTO analytics
  (
    `query`,
    `ip_address`,
    `browser`,
    `languages`,
    `timestamp`
  )
  VALUES
  (
    :query,
    :ip_address,
    :browser,
    :languages,
    :timestamp
  )
');
$time = time();
$sth->bindParam(':query', $query);
$sth->bindParam(':ip_address', $_SERVER['REMOTE_ADDR']);
$sth->bindParam(':browser', $_SERVER['HTTP_USER_AGENT']);
$sth->bindParam(':languages', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
$sth->bindParam(':timestamp', $time);

$result = $sth->execute();
if (!$result) {
  header('Content-type: application/json');
  header('Cache-Control: no-cache, must-revalidate');
  echo json_encode(['error' => 'Database Error.']);
  exit;
}
// -----------------------------------------------
// @IMPORTANT - SKIP DATABASE,  ENDS here
// -----------------------------------------------

// Make the API call which outputs JSON HEADERS
curl("$API_ENDPOINT/search/movie?query=$query&page=1", $API_KEY);
