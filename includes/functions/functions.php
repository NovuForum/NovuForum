<?php

function grs($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function resturangExists($resturang) {
  $data = executeResult("SELECT `linkid` FROM `resturanger` WHERE `linkid`=?", array($resturang));;
  if ($data[0] == $resturang) {
    return true;
  } else {
    return false;
  }
}

function getResturanger() {
  return executeResults("SELECT * FROM `resturanger`",array());
}

function getResturang($resturang) {
  return executeResult("SELECT * FROM `resturanger` WHERE linkid=?",array($resturang));
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

function addUser($username, $password) {
  $sql = "INSERT INTO `users` (`username`, `password`) VALUES (?,?);";
  $args = array($username, password_hash($password, PASSWORD_BCRYPT));
  execute($sql, $args);
}

function isAdmin($username) {
  $data = executeResult("SELECT `admin` FROM `users` WHERE `username`=?", array($username));;
  if ($data[0]) {
    return true;
  } else {
    return false;
  }
}

function addPost($title, $content, $linkid, $user) {
  $pub = date('Y:m:d H:i:s');
  $user = getUserId($user);
  $sql = "INSERT INTO `blogg`(`title`, `linkid`, `content`, `writer`, `published`) VALUES (?,?,?,?,?);";
  $args = array($title, $linkid, $content, $user, $pub);
  execute($sql, $args);
}

function getPostsRows() {
  $sql = "SELECT * FROM `blogg`";
  $args = array();
  return count(executeResults($sql, $args));
}

function getPages() {
  $rows = getPostsRows();
  $pages = 0;
  while ($rows > 0 ) {
    $rows = $rows - 10;
    $pages++;
  }
  return $pages;
}

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

function getPost($linkid) {
  $sql = "SELECT * FROM `blogg` WHERE linkid=?";
  $args = array($linkid);
  return executeResult($sql, $args);
}

function postExists($linkid) {
  return true;
}
