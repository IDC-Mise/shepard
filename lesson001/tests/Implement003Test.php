<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement003Test extends \PHPUnit_Framework_TestCase {
  private $fire;

  public function setUp() {
    if (!class_exists('Lesson001\FireImpl')) {
      $this->markTestSkipped();
    }
    $this->fire = new FireImpl();
  }

  public function test01() {
    $this->assertInstanceOf('Lesson001\Killing', $this->fire);
  }

  /**
   * @depends test01
   * @expectedException Lesson001\LogicException
   */
  public function test02() {
    $this->fire->isDeadly();
  }

  /** @depends test02 */
  public function test03() {
    $this->fire
      ->willHit(Hitting::AIR)
      ->willHit(Hitting::LEFT_HAND)
      ->willHit(Hitting::HEAD);
    $this->assertTrue($this->fire->isDeadly());
  }

}

