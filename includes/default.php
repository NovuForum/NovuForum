<?php

//include("functions/");
include("config.php");
include("pagehandler.php");
include("libraries/Parsedown.php");

foreach (scandir("functions") as $value) {
  if ($value == "." || $value == "..") continue;
  include("functions/$value");
}
