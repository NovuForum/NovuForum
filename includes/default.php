<?php

include("config.php");

// Global Variables
$textonly = ($URL_SPLIT[0] == "json") ? true : false ;
$loginrequired = (bool)getDataValue("loginrequired");
$loginrequired = ($loginrequired != false) ? true : false ;

// Dynamic Variables
if (!$textonly)
  $theme = getActiveTheme();

include("pagehandler.php");
include("libraries/Parsedown.php");

foreach (scandir("functions") as $value) {
  if ($value == "." || $value == "..") continue;
  include("functions/$value");
}
