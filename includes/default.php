<?php

//include("functions/");
include("config.php");
include("pagehandler.php");
include("libraries/Parsedown.php");

foreach (scandir("functions") as $value) {
  if ($value == "." || $value == "..") continue;
  include("functions/$value");
}

// Global Variables
$textonly = ($URL_SPLIT[0] == "json") ? true : false ;
$loginrequired = (bool)getDataValue("loginrequired");

// Dynamic Variables
if (!$textonly)
  $theme = getActiveTheme();
