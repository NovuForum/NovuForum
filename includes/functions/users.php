<?php
function userExists($username) {
  $data = executeResult("SELECT `username` FROM `nf_users` WHERE `username`=?", array($username));;
  if ($data[0] == $username) {
    return true;
  } else {
    return false;
  }
}

function passwordCorrect($username, $password) {
  $data = executeResult("SELECT `password` FROM `nf_users` WHERE `username`=?", array($username));;
  if (password_verify($password, $data[0])) {
    return true;
  } else {
    return false;
  }
}

function getUsers() {
  $sql = "SELECT * FROM `nf_users`";
  $args = array();
  return executeResults($sql, $args);
}

function getUser($id) {
  $sql = "SELECT * FROM `nf_users` WHERE id=?";
  $args = array($id);
  return executeResult($sql, $args);
}

function getUserId($username) {
  $sql = "SELECT `id` FROM `nf_users` WHERE username=?";
  $args = array($username);
  return executeResult($sql, $args)[0];
}
