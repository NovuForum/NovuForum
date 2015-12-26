<?php if ($_GET['mysql'] == 1) {
  try {
    $mysql = $_SESSION['setup_mysqldata'];
    //var_dump($mysql);
    $db = new PDO('mysql:host='.$mysql["host"].';dbname='.$mysql["daba"], $mysql["user"], $mysql["pass"], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch(PDOException $ex) {
    $_SESSION['setup_mysql'] = true;
    $_SESSION['setup_mysql_error'] = $ex->getMessage();
    header('Location: /');
    exit();
  }
?>
<?php
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
<?php } else if ($_GET['final'] == 1) { ?>
<?php
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
