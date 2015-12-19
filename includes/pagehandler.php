<?php

$URL = $_SERVER['QUERY_STRING'];
$URL_SPLIT = explode('/', $URL);

if ($URL_SPLIT[0] == "login") {
  if ($URL_SPLIT[1] == "register") {
    $page = "register.php";
  } else {
    $page = "login.php";
  }
} else if ($URL_SPLIT[0] == "topplista") {
  $page = "topplista.php";
} else if ($URL_SPLIT[0] == "resturang") {
  if (resturangExists($URL_SPLIT[1])) {
    $page = "resturang.php";
  } else {
    $page = "404.resturang.php";
  }
} else if ($URL_SPLIT[0] == "resturanger") {
  $page = "resturanger.php";
} else if ($URL_SPLIT[0] == "karta") {
  $page = "karta.php";
} else if ($URL_SPLIT[0] == "blogg") {
  if (is_numeric($URL_SPLIT[1])) {
    $page = "blogg/start.php";
  } else if ($URL_SPLIT[1] == "") {
    $page = "blogg/start.php";
  } else if ($URL_SPLIT[1] == "new") {
    $page = "blogg/new.php";
  } else if ($URL_SPLIT[1] == "post") {
    if (postExists($URL_SPLIT[2])) {
      $page = "blogg/post.php";
    } else {
      header('Location: /blogg');
    }
  } else {
    $page = "blogg/start.php";
  }
} else if ($URL_SPLIT[0] == "admin") {
  if ($URL_SPLIT[1] == "users") {
    $page = "admin/users.php";
  } else if ($URL_SPLIT[1] == "posts") {
    $page = "admin/posts.php";
  } else {
    $page = "admin/start.php";
  }
} else if ($URL_SPLIT[0] == "logout") {
  session_destroy();
  header('Location: /');
} else if ($URL_SPLIT[0] == "r" && resturangExists($URL_SPLIT[1])) {
  header('Location: /resturang/'.$URL_SPLIT[1]);
} else {
  if ($URL_SPLIT[0] == "") {
    $page = "start.php";
  } else {
    http_response_code(404);
    $page = "404.php";
  }
}
