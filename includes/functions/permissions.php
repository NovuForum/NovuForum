<?php

// User Permission Management
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

// Group Permission Management
function listGroupPermissions($groupid) {
  if (is_double($groupid)) {
    return json_decode(executeResult("SELECT `permissions` FROM `nf_groups` WHERE `id`=?", array($groupid))[0], true);
  } else {
    return false;
  }
}

function grantGroupPermissions($groupid, $permissions) {
  if (is_double($groupid) && is_array($permissions)) {
    $grouppermissions = json_decode(executeResult("SELECT `permissions` FROM `nf_groups` WHERE `id`=?", array($groupid))[0], true);
    foreach($permissions as $value) {
      array_push($grouppermissions, $value);
    }
    execute("UPDATE `nf_groups` SET `permissions`=? WHERE `id`=?", array(json_encode($grouppermissions), $groupid));
  } else {
    return false;
  }
}

function removeGroupPermissions($groupid, $permissions) {
  if (is_double($groupid) && is_array($permissions)) {
    $grouppermissions = json_decode(executeResult("SELECT `permissions` FROM `nf_groups` WHERE `id`=?", array($groupid))[0], true);
    foreach($grouppermissions as $key => $value) {
      if (in_array($value, $permissions)) {
        unset($grouppermissions[$key]);
      }
    }
    execute("UPDATE `nf_groups` SET `permissions`=? WHERE `id`=?", array(json_encode($grouppermissions), $groupid));
  } else {
    return false;
  }
}

// Permission Management
$globalpermlist = array("permissions.");
function listAllAvailablePermissions() {
  global $globalpermlist;
  return $globalpermlist;
}

function addAvailablePermission($permission) {
  global $globalpermlist;
  $globalpermlist[] = $permission;
}

function loadPermissions($userid) {
  $permissions = array();
  $permissions['user'] = listUserPermissions($userid);
  $groups = json_decode(executeResult("SELECT `groups` FROM `nf_users` WHERE `id`=?", array($userid))[0], true);
  $permissions['groups'] = array();
  foreach ($groups as $value) {
    $permissions['groups'][$value] = listGroupPermissions($value);
  }
  return $permissions;
}

if (isset($_SESSION['logged_in_permissions'])) {
  $userpermissions = $_SESSION['logged_in_permissions'];
} else {
  $userpermissions = array("permissions.none");
}
function requirePermission($permission) {
  global $userpermissions;
  if (in_array("permissions.all", $userpermissions['user'])) return true;
  if (in_array($permission, $userpermissions['user'])) {
    return true;
  } else {
    if (is_null($userpermissions['groups'])) return false;
    foreach ($userpermissions['groups'] as $key => $value)
      if (in_array($permission, $value))
        return true;
    return false;
  }
}
