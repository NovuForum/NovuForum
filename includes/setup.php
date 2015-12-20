<?php

if ($_SERVER['QUERY_STRING'] == "") {
  $PAGE = "setup";
} else {
  header('Location: /');
}

function populateDB() {

}

function createConfig($mysql, $sitename) {
  $config = '<?php ';
  foreach($mysql as $key => $value) {
    $config .= '$mysql["'.$key.'"] = "'.$value.'";';
  }
  $config .= '$sitename = "'.$sitename.'";';
  file_put_contents("../includes/config.php", $config);
}

// Test stuff
/*createConfig(
  array("host" => "testaddr",
        "user" => "testuser",
        "daba" => "testdaba",
        "pass" => "testpass"));
*/
