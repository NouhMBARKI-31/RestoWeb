<?php

  // Functions to connect to "restoweb" database
  function connect_db(){
    
    $dsn = 'mysql:host=localhost;dbname=restoweb';  // SQL server name and database name
    $user = 'root'; // Name of the SQL user
    $password = ''; // Password of the SQL user
    try {
      $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); // Connection to the database with user and password
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
      die("Erreur lors de la connexion SQL : " . $ex->getMessage());
    }
    // Return the database connection status
    return $dbh;
  }
?>