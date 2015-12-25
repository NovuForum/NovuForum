<?php

include("functions/mysql.php");

$PAGE = "setup";
$_SESSION['setup'] = true;

function populateDB() {
  //
  $sql = array(
    "",
    "",
    "",
    "",
    "",
    ""
  );
  $args = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
  );
  for ($i = 0; $i <= 6; $i++) {
    execute($sql[$i], $args[$i]);
  }
}

function createConfig($mysql, $sitename, $sitedesc) {
  if (file_exists("../includes/config.php")) {
    unlink("../includes/config.php");
  }
  $config = '<?php ';
  foreach($mysql as $key => $value) {
    $config .= '$mysql["'.$key.'"] = "'.$value.'";';
  }
  $config .= '$sitename = "'.$sitename.'";';
  $config .= '$sitedesc = "'.$sitedesc.'";';
  file_put_contents("../includes/config.php", $config);
}

// Test stuff
/*createConfig(
  array("host" => "testaddr",
        "user" => "testuser",
        "daba" => "testdaba",
        "pass" => "testpass"));
*/
