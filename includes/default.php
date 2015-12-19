<?php
$files = array("config.php", "pagehandler.php", "libraries/Parsedown.php");
$dirs = array("functions");

foreach($dirs as $dir) {
  foreach(scandir($dir) as $files) {
    include($dir."/".$files);
  }
}

foreach($files as $file) {
  include($file);
}
