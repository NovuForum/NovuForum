<?php
function populateDB($sitename, $sitedesc, $adminuser, $adminemail, $adminpass) {
  // Prepare SQL Statements...
  $sql = array(
    "CREATE TABLE `nf_users` ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `username` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(100) NOT NULL , `firstname` VARCHAR(30) NOT NULL , `lastname` VARCHAR(30) NOT NULL , `gender` INT NOT NULL DEFAULT '0' , `birthday` DATE NOT NULL , `status` VARCHAR(140) NOT NULL , `location` VARCHAR(100) NOT NULL , `occupation` VARCHAR(100) NOT NULL , `website` VARCHAR(255) NOT NULL , `about` TEXT NOT NULL , `avatar` VARCHAR(255) NOT NULL , `twitter` VARCHAR(15) NOT NULL , `postcount` DOUBLE NOT NULL , `groups` TEXT NOT NULL , `permissions` TEXT NOT NULL , PRIMARY KEY (`id`), INDEX (`gender`), UNIQUE (`username`), UNIQUE (`email`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_groups`( `id` DOUBLE NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `title` VARCHAR(20) NOT NULL , `description` TEXT NOT NULL , `color` VARCHAR(8) NOT NULL DEFAULT '#FFFFFF' , `permissions` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`name`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_posts` ( `forumid` DOUBLE NOT NULL , `topicid` DOUBLE NOT NULL AUTO_INCREMENT , `postid` DOUBLE NOT NULL , `title` VARCHAR(100) NOT NULL , `content` TEXT NOT NULL , `date` DATETIME NOT NULL , `edited` BOOLEAN NOT NULL DEFAULT FALSE , `ownerid` DOUBLE NOT NULL , `locked` BOOLEAN NOT NULL DEFAULT FALSE , `rating` TEXT NOT NULL ) ENGINE = InnoDB;",
    "CREATE TABLE `nf_forums`( `id` DOUBLE NOT NULL AUTO_INCREMENT , `type` INT NOT NULL DEFAULT '0' , `title` VARCHAR(100) NOT NULL , `content` VARCHAR(255) NOT NULL , `url` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_site`  ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `sitename` VARCHAR(255) NOT NULL , `sitedesc` TEXT NOT NULL , `canregister` BOOLEAN NOT NULL DEFAULT TRUE , `defaultgroup` DOUBLE NOT NULL DEFAULT '0' , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "CREATE TABLE `nf_data`  ( `id` DOUBLE NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `value` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;",
    "INSERT INTO `nf_groups`(`name`, `title`, `description`, `color`, `permissions`) VALUES ('admin', 'Admin', 'Default Admin Group', '#ab0013', '{\"permissions.all\"}');",
    "INSERT INTO `nf_users` (`username`, `email`, `password`) VALUES (?,?,?);",
    "INSERT INTO `nf_site` (`sitename`, `sitedesc`, `canregister`, `defaultgroup`) VALUES (?,?,0,0);",
    "INSERT INTO `nf_data` (`name`, `value`) VALUES (?,?); ",
    "INSERT INTO `nf_data` (`name`, `value`) VALUES (?,?); "
  );

  // And arguments...
  $args = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array($adminuser, $adminemail, $adminpass),
    array($sitename, $sitedesc),
    array("activetheme", "default"),
    array("loginrequired", "false")
  );

  // And then execute everything.
  for ($i = 0; $i < count($sql); $i++) {
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

if ($_GET['mysql'] == 1) {
  try {
    $db = new PDO('mysql:host='.$_SESSION['setup_mysqldata']["host"].';dbname='.$_SESSION['setup_mysqldata']["daba"], $_SESSION['setup_mysqldata']["user"], $_SESSION['setup_mysqldata']["pass"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch(PDOException $ex) {
    $_SESSION['setup_mysql'] = true;
    $_SESSION['setup_mysql_error'] = $ex->getMessage();
    header('Location: /');
    exit();
  }

  require("functions/mysql.php");

  if (isset($_POST['sitename'], $_POST['sitedesc'], $_POST['adminuser'], $_POST['adminemail'], $_POST['adminpass'], $_POST['adminpassconf'])) {
    if (strlen($_POST['sitename']) < 100) {
      if ($_POST['adminpass'] == $_POST['adminpassconf']) {
        $password = password_hash($_POST['adminpass'], PASSWORD_BCRYPT);
        populateDB($_POST['sitename'], $_POST['sitedesc'], $_POST['adminuser'], $_POST['adminemail'], $password);
        header('Location: /?final=1');
      }
    }
  }
?>
<div class="container">
  <h1 class="page-header text-center">Setup <s>---</s> NovuForum</h1>
  <div class="panel panel-default panel-fullpage">
    <div class="panel-body">
      <form method="post">
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="sitename">Site Name</label>
              <input type="text" name="sitename" id="sitename" class="form-control" placeholder="Site Name" required>
            </div>
            <div class="col-md-6">
              <span class="help-block">The sites name, ex: Lorem Ipsum Forum</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="sitedesc">Site Description</label>
              <textarea rows="5" name="sitedesc" id="sitedesc" class="form-control" placeholder="Site Description" required></textarea>
            </div>
            <div class="col-md-6">
              <span class="help-block">The sites description, shown in google searches and other sources.<br>A short and simple description is often the best.</span>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="adminuser">Admin Username</label>
              <input type="text" name="adminuser" id="adminuser" class="form-control" placeholder="Admin Username" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="adminemail">Admin Email</label>
              <input type="email" name="adminemail" id="adminemail" class="form-control" placeholder="Admin Email" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="adminpass">Admin Password</label>
              <input type="password" name="adminpass" id="adminpass" class="form-control" placeholder="Admin Password" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label for="adminpassconf">Confirm Password</label>
              <input type="password" name="adminpassconf" id="adminpassconf" class="form-control" placeholder="Confirm Password" required>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Initalize NovuForum</button>
      </form>
    </div>
  </div>
</div>
<?php } else if ($_GET['final'] == 1) {
if (isset($_POST['setup']) && $_POST['setup'] == "complete") {
  session_destroy();
  header('Location: /');
  exit();
}
?>
<div class="container">
  <h1 class="page-header text-center">Setup <s>---</s> NovuForum</h1>
  <div class="panel panel-default panel-fullpage">
    <div class="panel-body">
      <form method="post">
        <div class="form-group">
          <input type="hidden" name="setup" value="complete">
          <button type="submit" class="btn btn-block btn-success">Start NovuForum</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } else { ?>
  <?php
    if (isset($_POST['mysqlhost'], $_POST['mysqldaba'], $_POST['mysqluser'], $_POST['mysqlpass'])) {
      //error_log(getcwd(), 0);
      $mysql = array("host" => $_POST['mysqlhost'], "daba" => $_POST['mysqldaba'], "user" => $_POST['mysqluser'], "pass" => $_POST['mysqlpass']);
      $_SESSION['setup_mysqldata'] = $mysql;
      createConfig($mysql);
      header('Location: /?mysql=1');
    }
  ?>
  <div class="container">
    <div class="panel panel-default panel-fullpage">
      <div class="panel-body">
        <h1 class="page-header text-center">Setup <s>---</s> NovuForum</h1>
        <?php if ($_SESSION['setup_mysql']) { ?><div class="alert alert-danger">Could not connect to MySQL Host<br><?= $_SESSION['setup_mysql_error'] ?></div><?php $_SESSION['setup_mysql'] = false; $_SESSION['setup_mysql_debug'] = "";} ?>
        <form method="post">
          <div class="form-group">
            <?php if (file_exists("../includes/config.php")) { ?>
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <a href="/?mysql=1" class="btn btn-block btn-primary">Config Exists! Go to next step?</a>
              </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-6">
                <label for="mysqlhost">MySQL Host</label>
                <input type="text" name="mysqlhost" id="mysqlhost" class="form-control" placeholder="MySQL Host" required>
              </div>
              <div class="col-md-6">
                <span class="help-block">Please NOTE: Everything is saved in plaintext, so make sure nobody has access to <code>includes/config.php</code>!</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="mysqldaba">MySQL Database</label>
                <input type="text" name="mysqldaba" id="mysqldaba" class="form-control" placeholder="MySQL Database" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="mysqluser">MySQL Username</label>
                <input type="text" name="mysqluser" id="mysqluser" class="form-control" placeholder="MySQL Username" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label for="mysqlpass">MySQL Password</label>
                <input type="password" name="mysqlpass" id="mysqlpass" class="form-control" placeholder="MySQL Password" required>
              </div>
            </div>
          </div>
          <hr>
          <button type="submit" class="btn btn-lg btn-block btn-default">Save and prepare NovuForum</button>
        </form>
      </div>
    </div>
  </div>
  <script>
  </script>
<?php } ?>
