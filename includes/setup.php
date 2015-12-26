<?php
if ($_SERVER['QUERY_STRING'] != "")
  include("functions/mysql.php");

$PAGE = "setup";
$_SESSION['setup'] = true;

function populateDB($sitename, $sitedesc, $adminuser, $adminemail, $adminpass) {
  // Prepare SQL Statements...
  $sql = array(
    "CREATE TABLE `nf_users` ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `username` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(100) NOT NULL , `firstname` VARCHAR(30) NOT NULL , `lastname` VARCHAR(30) NOT NULL , `gender` INT NOT NULL DEFAULT '0' , `birthday` DATE NOT NULL , `status` VARCHAR(140) NOT NULL , `location` VARCHAR(100) NOT NULL , `occupation` VARCHAR(100) NOT NULL , `website` VARCHAR(255) NOT NULL , `about` TEXT NOT NULL , `avatar` VARCHAR(255) NOT NULL , `twitter` VARCHAR(15) NOT NULL , `postcount` DOUBLE NOT NULL , `groups` TEXT NOT NULL , `permissions` TEXT NOT NULL , PRIMARY KEY (`id`), INDEX (`gender`), UNIQUE (`username`), UNIQUE (`email`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_groups` ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `title` VARCHAR(20) NOT NULL , `description` TEXT NOT NULL , `color` VARCHAR(8) NOT NULL DEFAULT '#FFFFFF' , `permissions` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`name`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_posts` ( `forumid` DOUBLE NOT NULL , `topicid` DOUBLE NOT NULL , `postid` DOUBLE NOT NULL , `title` VARCHAR(100) NOT NULL , `content` TEXT NOT NULL , `date` DATETIME NOT NULL , `edited` BOOLEAN NOT NULL DEFAULT FALSE , `ownerid` DOUBLE NOT NULL , `locked` BOOLEAN NOT NULL DEFAULT FALSE , `rating` TEXT NOT NULL ) ENGINE = InnoDB;",
    "CREATE TABLE `nf_forums` ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `type` INT NOT NULL DEFAULT '0' , `title` VARCHAR(100) NOT NULL , `content` VARCHAR(255) NOT NULL , `url` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_data` ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `sitename` VARCHAR(255) NOT NULL , `sitedesc` TEXT NOT NULL , `canregister` BOOLEAN NOT NULL DEFAULT TRUE , `defaultgroup` DOUBLE NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "INSERT INTO `nf_groups`(`name`, `title`, `description`, `color`, `permissions`) VALUES ('admin', 'Admin', 'Default Admin Group', '#ab0013', '{\"permissions.all\"}');",
    "INSERT INTO `nf_users` (`username`, `email`, `password`) VALUES (?,?,?);",
    "INSERT INTO `nf_data` (`sitename`, `sitedesc`, `canregister`, `defaultgroup`) VALUES (?,?,0,0);"
  );

  // And arguments...
  $args = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array($adminuser, $adminemail, $adminpass),
    array($sitename, $sitedesc)
  );

  // And then execute everything.
  for ($i = 0; $i <= count($sql)-1; $i++) {
    $exec = execute($sql[$i], $args[$i]);
    if ($exec != null) {
      echo $exec;
    }
  }
}

function createConfig($mysql) {
  if (file_exists("../includes/config.php")) {
    unlink("../includes/config.php");
  }
  $config = '<?php ';
  foreach($mysql as $key => $value) {
    $config .= '$mysql["'.$key.'"] = "'.$value.'";';
  }
  /*$config .= '$sitename = "'.$sitename.'";';
  $config .= '$sitedesc = "'.$sitedesc.'";';*/
  file_put_contents("../includes/config.php", $config);
}

// Test stuff
/*createConfig(
  array("host" => "testaddr",
        "user" => "testuser",
        "daba" => "testdaba",
        "pass" => "testpass"));
*/
