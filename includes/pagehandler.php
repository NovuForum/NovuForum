<?php

$URL = $_SERVER['QUERY_STRING'];
$URL_SPLIT = explode('/', $URL);

if ($URL_SPLIT[0] == "login") {
  $PAGE = "../includes/pages/login.php";
} else if ($URL_SPLIT[0] == "logout") {
  session_destroy();
  header('Location: /');
} else {
  if ($URL_SPLIT[0] == "") {
    foreach (scandir("../plugins/") as $value) {
      if ($value == "." || $value == "..") continue;
      if (file_exists("../plugins/$value/pages/default.php")) {
        $PAGE = "../plugins/$value/pages/default.php";
        break;
      }
    }
    if ($PAGE == null)
      $PAGE = "../includes/pages/default.php";
  } else {
    http_response_code(404);
    $PAGE = "../includes/pages/404.php";
  }
}
