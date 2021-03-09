<?php


namespace thedataist\Drill;


use PHPUnit\Framework\TestCase;

class DrillJDBCTest extends TestCase
{
  public function testConnection() {
    $this->drill = new DrillJDBConnection("localhost", 8047, "", "");
    $active = $this->drill->is_active();
    $this->assertEquals(true, $active);
  }
}