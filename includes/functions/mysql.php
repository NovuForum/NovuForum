<?php
  function connect() {
    $host = "dhd.joarc.ovh";
    $dbname = "matkollen";
    $username = "matkollen";
    $password = "matkollen";
    $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
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
