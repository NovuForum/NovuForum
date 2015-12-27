<?php

// Group functions

function addGroup() {

}

function delGroup() {

}

function listUsersInGroup($groupid) {

}

function listGroups() {
  return executeResults("SELECT * FROM `nf_groups`", array());
}

function getGroupIdByName($name) {
  return executeResult("SELECT `id` FROM `nf_groups` WHERE `name`=?", array($name))[0];
}

function getGroupTitleById($id) {
  return executeResult("SELECT `title` FROM `nf_groups` WHERE `id`=?", array($id))[0];
}

function getGroupNameById($id) {
  return executeResult("SELECT `name` FROM `nf_groups` WHERE `id`=?", array($id))[0];
}
