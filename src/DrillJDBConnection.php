<?php


namespace thedataist\Drill;
use function PHPUnit\Framework\returnArgument;

require "PJBridge.php";

class DrillJDBConnection extends DrillConnection
{
  /**
   * DrillJDBCConnection
   * @var PJBridge $db
   */
  protected PJBridge $db;



  public function __construct(string $host, int $dbPort, string $username, string $password) {
    $dbName = "";
    $dbUser = "";
    $dbPass = "";

    //$connStr = "jdbc:drill:zk=${host}:${dbPort}";

    $connStr = "jdbc:drill:drillbit=localhost";
//$host = "localhost", $port = ""31010, $jdbc_enc = "ascii", $app_enc = "ascii"
    $this->db = new PJBridge("localhost", 2181);
    $result = $this->db->connect($connStr, $username, $password);
    if(!$result){
      die("Failed to connect");
    }
  }

  /**
   * Checks if the connection is active.
   *
   * @return bool Returns true if the connection to Drill is active, false if not.
   */
  public function is_active(): bool {
    return true;
    //$protocol = $this->ssl ? 'https://' : 'http://';

    //$result = @get_headers($protocol.$this->hostname.':'.$this->port);

    //return isset($result[1]);
  }

  /**
   * Executes a Drill query.
   *
   * @param string $query The query to run/execute
   *
   * @return ?Result Returns Result object if the query executed successfully, null otherwise.
   */
  function query(string $query): ?Result {

    $cursor = $this->db->exec($query);

    while($row = $this->db->fetch_array($cursor)){
      print_r($row);
    }

    $this->db->free_result($cursor);
    return null;
    /*
    if (isset($response['errorMessage'])) {
      $this->error_message = $response['errorMessage'];
      return null;
    } else {
      return new namespace\Result($response, $query);
    }*/
  }


}