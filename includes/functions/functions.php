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

function userExists($username) {
  $data = executeResult("SELECT `username` FROM `users` WHERE `username`=?", array($username));;
  if ($data[0] == $username) {
    return true;
  } else {
    return false;
  }
}

function passwordCorrect($username, $password) {
  $data = executeResult("SELECT `password` FROM `users` WHERE `username`=?", array($username));;
  if (password_verify($password, $data[0])) {
    return true;
  } else {
    return false;
  }
}

function getUsers() {
  $sql = "SELECT * FROM `users`";
  $args = array();
  return executeResults($sql, $args);
}

function getUser($id) {
  $sql = "SELECT * FROM `users` WHERE id=?";
  $args = array($id);
  return executeResult($sql, $args);
}

function getUserId($username) {
  $sql = "SELECT `id` FROM `users` WHERE username=?";
  $args = array($username);
  return executeResult($sql, $args)[0];
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
