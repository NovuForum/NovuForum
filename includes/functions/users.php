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
  return password_verify($password, executeResult("SELECT `password` FROM `nf_users` WHERE `username`=?", array($username)[0]);
}

function getUsers() {
  return executeResults("SELECT * FROM `nf_users`", array());
}

function getUserById($id) {
  return executeResult("SELECT * FROM `nf_users` WHERE `id`=?", array($id));
}

function getUserIdByName($username) {
  return executeResult("SELECT `id` FROM `nf_users` WHERE `username`=?", array($username))[0];
}

function addUser() {

}

function delUser() {

}

function
