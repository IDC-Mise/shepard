<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement001Test extends \PHPUnit_Framework_TestCase {
  
  public function test01() {
    $this->assertTrue(true);
  }

  /** @depends test01 */
  public function test02() {
    $this->assertTrue(class_exists('Lesson001\SoldierImpl'));
  }
}

