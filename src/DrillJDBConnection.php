<?php


namespace thedataist\Drill;
require "PJBridge.php";

class DrillJDBConnection extends DrillConnection
{
  public function __construct(string $host, int $arg_port, string $username = 'cgivre', string $password = 'password') {
    $dbHost = "server";
    $dbName = "";
    $dbPort = "1990";
    $dbUser = "dharma";
    $dbPass = "";

    //$connStr = "jdbc:drill:T:${dbHost}:${dbName}:${dbPort}";

    $connStr = "jdbc:drill:zk=local:2181";

    $db = new PJBridge();
    $result = $db->connect($connStr, $dbUser, $dbPass);
    if(!$result){
      die("Failed to connect");
    }
  }
}