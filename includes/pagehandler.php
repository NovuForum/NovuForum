<?php

$URL = $_SERVER['QUERY_STRING'];
$URL_SPLIT = explode('/', $URL);
if ($URL == "") {
  $defaultpage = getDefaultPage();
  if ($defaultpage == false) {
    $PAGE = "../includes/pages/default.php";
  } else {
    $PAGE = "../plugins/".$defaultpage."/default.php";
  }
} else if ($URL == "login") {
  $PAGE = "../includes/pages/login.php";
} else if ($URL == "logout") {
  session_destroy();
  header('Location: /');
} else {
  foreach(getdir("../plugins/") as $plugin) {
    if (file_exists("../plugins/$plugin/pagehandler.php")) {
      include("../plugins/$plugin/pagehandler.php");
    }
  }
  if (is_null($PAGE)) {
    $PAGE = "../includes/pages/404.php":
    http_response_code(404);
  }
}
