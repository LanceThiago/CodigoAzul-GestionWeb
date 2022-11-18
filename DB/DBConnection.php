<?php
  function DbHandler  () {
    $dbHost = 'localhost';
    $dbName = 'codigo_azul';
    $dbUser = 'root';
    $dbPass = '';
    $Dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    try {
      $Connection = new PDO($Dsn, $dbUser, $dbPass, $options);
      return $Connection;
    } catch (Exception $e) {
      var_dump('Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage());
    }
  }
?>
