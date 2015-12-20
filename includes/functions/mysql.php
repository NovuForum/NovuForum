<?php
  function connect() {
    global $mysql;
    $db = new PDO('mysql:host='.$mysql["host"].';dbname='.$mysql["daba"], $mysql["user"], $mysql["pass"]);
    return $db;
  }

  function execute($sql, $args) {
      $db = connect();
      $query = $db->prepare($sql);
      $query->execute($args);
  }

  function executeResult($sql, $args) {
    $db = connect();
    $query = $db->prepare($sql);
    $query->execute($args);
    $response = $query->fetch();
    return $response;
  }

  function executeResults($sql, $args) {
    $db = connect();
    $query = $db->prepare($sql);
    $query->execute($args);
    $response = $query->fetchAll();
    return $response;
  }
