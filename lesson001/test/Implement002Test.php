<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement002Test extends \PHPUnit_Framework_TestCase {
  private $soldier;

  public function setUp() {
    $this->soldier = new SoldierImpl();
  }

  public function test01() {
    $this->assertInstanceOf('Lesson001\Living', $this->soldier);
  }
  
  public function test02() {
    $this->assertTrue($this->soldier->isAlive());
  }

  public function test03() {
    $this->soldier->dieNow();
    $this->assertFalse($this->soldier->isAlive());
  }
}

