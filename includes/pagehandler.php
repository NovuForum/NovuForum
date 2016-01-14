<?php

$URL = $_SERVER['QUERY_STRING'];
$URL_SPLIT = explode('/', $URL);

if (!$_SESSION['setup']) {
  if ($URL == "") {
    if ($loginrequired) {
      header('Location: /login');
      exit();
    }
    $PAGE = "../themes/$theme/start.phtml";
  } else if ($URL_SPLIT[0] == "json") {

  } else if ($URL == "login") {
    $PAGE = "../includes/pages/login.php";
  } else if ($URL == "logout") {
    session_destroy();
    header('Location: /');
  } else {
    /*foreach(getdir("../plugins/") as $plugin) {
      if (file_exists("../plugins/$plugin/pagehandler.data")) {
        $ph = file_get_contents("../plugins/$plugin/pagehandler.data");
        $phrows = explode('\n', $ph);
        foreach($phrows as $value) {
          if ($value != "") {
            $phrow = explode(' ', $value);
            if ($phrow[0] == "NEWPAGE") {
              if ($URL == $phrow[1]) {
                if ($phrow[2] != null) {
                  $PAGE = "../plugins/$plugin/".$phrow[2];
                }
              }
            } else if ($phrow[0] == "ALIAS") {
              if ($URL == $phrow[1]) {
                if ($phrow[2] != null) {
                  header('Location: /'.$phrow[2]);
                  exit();
                }
              }
            }
          }
        }
      }
    }*/
    if (file_exists("../themes/$theme/$URL")) {
      
    }
    if (is_null($PAGE)) {
      $PAGE = "../includes/pages/404.php":
      http_response_code(404);
    }
  }
}
