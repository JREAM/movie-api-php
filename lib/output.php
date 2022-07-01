<?php

/**
 * Outputs JSON Headers and Data
 *
 * @param mixed $payload JSON Data
 *
 * @return void
 */
function json($payload): void
{
  header('Content-type: application/json');
  header('Cache-Control: no-cache, must-revalidate');
  echo json_encode($payload);
  exit;
}
