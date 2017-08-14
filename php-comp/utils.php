<?php
/**
 * Escape strings.
 */
function escapechars($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>