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

  /**
   * The JDBC connection string to Drill
   * @var string $connectionString
   */
  protected string $connectionString;


  public function __construct(string $host, int $dbPort, string $username, string $password) {
    //$connStr = "jdbc:drill:zk=${host}:${dbPort}";
    $this->username = $username;
    $this->password = $password;
    $this->connectionString = "jdbc:drill:drillbit=localhost";

    $this->db = new PJBridge("localhost", 2181);
    $result = $this->db->connect($this->connectionString, $this->username, $this->password);
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
    return $this->db->connect($this->connectionString, $this->username, $this->password);
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
    $result = new namespace\Result(null, $query, true, $this->db, $cursor);
    $this->db->free_result($cursor);
    return $result;
  }
}