<?php
session_start();
if (!file_exists("../includes/config.php") || $_SESSION['setup']) {
  include('../includes/setup.php');
} else {
  include('../includes/default.php');
}
?>
<!DOCTYPE html>
<html lang="en_US">
  <head>
    <meta charset="utf-8">
    <link href="/img/favicon.png" rel="shortcut icon">
    <title>NovuForum</title>
    <!-- CSS -->
    <link href="/css/global.css" rel="stylesheet">
    <link href="/css/bootstrap.css" rel="stylesheet">
<?php foreach(scandir("css/forums/") as $value) { if ($value == "." || $value == "..") continue; ?>
    <link href="/css/forums/<?= $value ?>" rel="stylesheet">
<?php } ?>
  </head>
  <body>
    <?php include($PAGE); ?>
    <!-- JS -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <!--<script src="/js/smartforumsview.js"></script> My Cool Test Thingy (TODO) -->
  </body>
</html>
