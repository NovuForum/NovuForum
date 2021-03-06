<?php

require("../includes/config.php");
foreach (scandir("../includes/functions") as $value) {
  if ($value == "." || $value == "..") continue;
  include("functions/$value");
}

// Global Variables
$URL = $_SERVER['QUERY_STRING'];
$URL_SPLIT = explode('/', $URL);
$textonly = ($URL_SPLIT[0] == "json") ? true : false ;
$loginrequired = (bool)getDataValue("loginrequired");
$loginrequired = ($loginrequired != false) ? true : false ;
$parser = array();

// Dynamic Variables
if (!$textonly)
  $theme = getActiveTheme();
if ($URL_SPLIT[0] == "forum" && is_numeric($URL_SPLIT[1]))
  $forumid = $URL_SPLIT[1];

include("pagehandler.php");

// Libraries
include("libraries/Parsedown.php");

// Parser Variables
