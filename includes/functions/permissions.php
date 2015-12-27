<?php

function listUserPermissions($userid) {
  if (is_double($userid)) {
    return json_decode(executeResult("SELECT `permissions` FROM `users` WHERE `id`=?", array($userid))[0], true);
  } else {
    return false;
  }
}

function grantUserPermissions($userid, $permissions) {
  if (is_double($userid) && is_array($permissions)) {
    $userpermissions = json_decode(executeResult("SELECT `permissions` FROM `nf_users` WHERE `id`=?", array($userid))[0], true);
    foreach($permissions as $value) {
      array_push($userpermissions, $value);
    }
    execute("UPDATE `nf_users` SET `permissions`=? WHERE `id`=?", array(json_encode($userpermissions), $userid));
  } else {
    return false;
  }
}

function removeUserPermissions($userid, $permissions) {
  if (is_double($userid) && is_array($permissions)) {
    $userpermissions = json_decode(executeResult("SELECT `permissions` FROM `nf_users` WHERE `id`=?", array($userid))[0], true);
    foreach($userpermissions as $key => $value) {
      if (in_array($value, $permissions)) {
        unset($userpermissions[$key]);
      }
    }
    execute("UPDATE `nf_users` SET `permissions`=? WHERE `id`=?", array(json_encode($userpermissions), $userid));
  } else {
    return false;
  }
}

function listGroupPermissions($groupid) {

}

function grantGroupPermissions($groupid, $permissions) {
  if (is_double($userid) && is_array($permissions)) {

  }
}

function removeGroupPermissions($groupid, $permissions) {
  if (is_double($userid) && is_array($permissions)) {

  }
}

function listAllAvailablePermissions() {

}
