<?php
  function connect() {
    global $mysql;
    $db = new PDO('mysql:host='.$mysql["host"].';dbname='.$mysql["daba"], $mysql["user"], $mysql["pass"]);
    return $db;
  }

  if (!$_SESSION['setup'])
    $db = connect();

  function execute($sql, $args) {
      //$db = connect();
      global $db;
      try {
        $query = $db->prepare($sql);
        $query->execute($args);
      } catch (PDOException $ex) {
        return $ex->getMessage();
      }
      return null;
  }

  function executeResult($sql, $args) {
    //$db = connect();
    global $db;
    try {
      $query = $db->prepare($sql);
      $query->execute($args);
      $response = $query->fetch();
    } catch (PDOException $ex) {
      $response = $ex->getMessage();
    }
    return $response;
  }

  function executeResults($sql, $args) {
    //$db = connect();
    global $db;
    try {
      $query = $db->prepare($sql);
      $query->execute($args);
      $response = $query->fetchAll();
    } catch (PDOException $ex) {
      $response = $ex->getMessage();
    }
    return $response;
  }
