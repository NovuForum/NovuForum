<?php
$PAGE = "";
if (!$_SESSION['setup']) {
  if ($URL == "") {
    if ($loginrequired && $_SESSION['logged_in'] == false && false) {
      header('Location: /login');
      exit();
    }
    $PAGE = "../public_html/themes/$theme/start.phtml";
  } else if ($URL_SPLIT[0] == "json") {
    if ($URL_SPLIT[1] == "forumslist" || $URL_SPLIT[1] == "forumlist" || $URL_SPLIT[1] == "forumslist.json" || $URL_SPLIT[1] == "forumlist.json") {
      $forums = executeResults("SELECT * FROM `nf_forums`", array());
      $output = array();
      foreach($forums as $key => $value) {
        $output[$key] = removeNumbers($value);
      }
      echo json_encode($output);
    }
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
    if ($URL_SPLIT[0] == "forum") {
      if (file_exists("../public_html/themes/$theme/forum.phtml")) {
        $PAGE = "../public_html/themes/$theme/forum.phtml";
      }
    } else if ($URL_SPLIT[0] == "topic") {
      if (file_exists("../public_html/themes/$theme/topic.phtml")) {
        $PAGE = "../public_html/themes/$theme/topic.phtml";
      }
    } else if ($URL_SPLIT[0] == "post") {
      if (file_exists("../public_html/themes/$theme/post.phtml")) {
        $PAGE = "../public_html/themes/$theme/post.phtml";
      }
    } else {
      if (file_exists("../public_html/themes/$theme/$URL")) {
        $PAGE = "../public_html/themes/$theme/$URL.phtml";
      }
    }
    if ($PAGE == "") {
      $PAGE = "../includes/pages/404.php";
      http_response_code(404);
    }
  }
}
