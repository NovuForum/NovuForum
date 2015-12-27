<?php
function getDefaultPage() {
   $defaultpage = executeResult("SELECT `defaultpage` FROM `nf_plugins` ORDER BY `id` DESC LIMIT 0,1", array());
   if ($defaultpage != null) {
     return $defaultpage;
   } else {
     return false;
   }
}

function getCustomPage($URL) {
  foreach (scandir("../plugins") as $value) {
    if ($value == ".." || $value == ".") continue;
    if (file_exists("../plugins/$value/custompages/$URL")) {
      return "../plugins/$value/custompages/$URL";
    } else {
      continue;
    }
  }
  return false;
}
