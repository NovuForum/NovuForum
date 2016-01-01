<?php

// Group functions

function addGroup($name, $title, $permissions, $description = "", $color = "#FFF") {
  if (isset($name, $title, $permissions)) {
    execute("INSERT INTO `nf_groups`(`name`,`title`,`permissions`,`description`,`color`) VALUES (?,?,?,?,?)", array($name, $title, $permissions, $description, $color));
    return true;
  } else {
    return false;
  }
}

function delGroup($groupid) {
  return execute("DELETE FROM `nf_groups` WHERE `id`=?", array($groupid));
}

function listUsersInGroup($groupid) {
  $users = array();
  foreach (executeResults("SELECT `groups`,`id`,`username` FROM `nf_users`", array()) as $key => $value) {
    $groups = json_decode($value['groups'], true);
    if (in_array($groupid, $groups)) {
      $users[$value['id']] = array("username" => $value['username'], "id" => $value['id']);
    } else {
      continue;
    }
  }
  return $users;
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
