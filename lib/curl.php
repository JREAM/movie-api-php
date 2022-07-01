<?php
require_once('../constants.php');

/**
 * Outputs JSON Headers and Data
 *
 * @param string $endpoint
 * @param string $apiKey
 * @param array $postData
 *
 * @return void (Prints JSON)
 */
function curl(string $endpoint, string $apiKey, array $postData = [])
{

  $ch = curl_init($endpoint);

  // Optional Post Data
  if (is_array($postData) && count($postData) > 0) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
  }

  // Set Headers (With API Key)
  $headers = [
    'Accept: application/json',
    'Content-Type: application/json',
    "Authorization: Bearer $apiKey"
  ];
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  // Execute on Endpoint
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);

  // Close Connection (Before Return Statement)
  curl_close($ch);

  if ($result === false) {
    throw new \UnexpectedValueException(curl_error($ch));
  }

  return $result;
}
