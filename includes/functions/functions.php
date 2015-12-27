<?php

function grs($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function smail($to, $subject, $message) {
  $headers = "Content-Type: text/html;charset=UTF-8\r\nX-Mailer:PHP/".phpversion();
  mail($to, $subject, $message, $headers);
}

function getdir($dir) {
  $data = array();
  $i = 0;
  foreach (scandir($dir) as $key => $value) {
    if ($value == ".." || $value == ".") continue;
    $data[$i] = $value;
    $i++;
  }
  return $data;
}

// TODO: REUSE THIS CODE
function getPosts($page) {
  if ($page == -1) {
    $sql = "SELECT * FROM `blogg` ORDER BY id DESC";
    $args = array();
    return executeResults($sql, $args);
  }
  $pagelength = 10;
  if (is_numeric($page)) {
    if ($page == 1) {
      $sql = "SELECT * FROM `blogg` ORDER BY id DESC LIMIT 0,10 ";
      $args = array();
      return executeResults($sql, $args);
    } else {
      $page = $page * 10 - 10;
      $sql = "SELECT * FROM `blogg` ORDER BY `id` DESC LIMIT $page,10";
      $args = array();
      return executeResults($sql, $args);
    }
  } else {
    return array("title" => "Failed getting posts", "linkid" => "failed", "description" => "Failed getting posts, please review the code or contact joarc@joarc.se");
  }
}
