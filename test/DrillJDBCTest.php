<?php


namespace thedataist\Drill;


use PHPUnit\Framework\TestCase;

class DrillJDBCTest extends TestCase
{

  protected DrillJDBConnection $drill;


  public function testConnection() {
    $this->drill = new DrillJDBConnection("localhost", 31010, "cgivre", "admin");
    $active = $this->drill->is_active();

    $this->assertEquals(true, $active);

    $this->drill->query("SELECT * FROM cp.`employee.json` LIMIT 20");
  }
}