<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement003Test extends \PHPUnit_Framework_TestCase {
  private $fire;

  public function setUp() {
    $this->fire = new FireImpl();
  }

  public function test01() {
    $this->assertInstanceOf('Lesson001\Killing', $this->fire);
  }

  /**
   * @after test01
   * @expectedException Lesson001\LogicException
   */
  public function test02() {
    $this->fire->isDeadly();
  }

  /** @after test02 */
  public function test03() {
    $this->fire
      ->willHit(Hitting::AIR)
      ->willHit(Hitting::LEFT_HAND)
      ->willHit(Hitting::HEAD);
    $this->assertTrue($this->fire->isDeadly());
  }

}

