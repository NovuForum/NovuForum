<?php
session_start();
if (!file_exists("../includes/config.php")) $_SESSION['setup'] = true;
if (is_null($_SESSION['setup'])) $_SESSION['setup'] = false;
if ($_SESSION['setup']) {
  //include('../includes/setup.php');
  $PAGE = "../includes/setup.php";
  $textonly = false;
} else {
  include('../includes/default.php');
}

if (!$textonly) {
?>
<!DOCTYPE html>
<html lang="en_US">
  <head>
    <meta charset="utf-8">
    <link href="/img/favicon.png" rel="shortcut icon">
    <title>NovuForum</title>
    <!-- GLOBAL CSS -->
    <link href="/css/global.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
<?php
if (isset($theme)) {
  if (dir_exists("../themes/$theme/") && dir_exists("../themes/$theme/css/")) {
    foreach (scandir("../themes/$theme/css/") as $value) {
?>
    <style><?= file_get_contents("../themes/$theme/css/$value") ?></style>
<?php
    }
  }
}
?>
  </head>
  <body>
    <?php include($PAGE); ?>
    <!-- JS -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <!--<script src="/js/smartforumsview.js"></script> My Cool Test Thingy (TODO) -->
  </body>
</html>
<?php } ?>
