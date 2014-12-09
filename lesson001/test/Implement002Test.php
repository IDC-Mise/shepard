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
  
  /** @after test01 **/
  public function test02() {
    $this->assertTrue($this->soldier->isAlive());
  }

  /** @after test02 **/
  public function test03() {
    $this->soldier->dieNow();
    $this->assertFalse($this->soldier->isAlive());
  }

  /** @after test03 */
  public function test04() {
    $this->assertTrue(class_exists('Lesson001\FireImpl'));
  }

  /** @after test04 */
  public function test05() {
    $this->assertTrue(defined('Lesson001\Hitting::AIR'));
    $this->assertTrue(defined('Lesson001\Hitting::LEFT_HAND'));
    $this->assertTrue(defined('Lesson001\Hitting::HEAD'));
  }

}

