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
if ($textonly) header('Content-Type: application/json');
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
    <?php if ($URL_SPLIT[0] == "admin") { ?>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <?php } ?>
<?php
if (isset($theme)) {
  if (dir_exists("themes/$theme/") && dir_exists("themes/$theme/css/")) {
    foreach (getdir("themes/$theme/css/") as $value) {
?>
    <link rel="stylesheet" type="text/css" href="/themes/<?= $theme ?>/css/<?= $value ?>">
<?php
    }
  }
}
?>
<!-- <?= $PAGE ?> | <?= getcwd() ?> | /<?= $URL ?> -->
  </head>
  <body>
    <div class="main-container">
<?= parseVariables(file_get_contents($PAGE)); ?>
    </div>
    <!-- JS -->
    <script src="/js/jquery.js"></script>
    <?php if ($URL_SPLIT[0] == "admin") { ?>
    <script src="/js/bootstrap.js"></script>
    <?php } ?>
    <!--<script src="/js/smartforumsview.js"></script> My Cool Test Thingy (TODO) -->
  </body>
</html>
<?php } ?>
