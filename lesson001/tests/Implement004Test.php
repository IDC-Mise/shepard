<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement004Test extends \PHPUnit_Framework_TestCase {
  private $soldier;
  private $fire;

  public function setUp() {
    if (
        !class_exists('Lesson001\SoldierImpl') ||
        !class_exists('Lesson001\FireImpl')) {
      $this->markTestSkipped();
    }
    $this->soldier = new SoldierImpl();
    $this->fire = new FireImpl();
  }

  public function test01() {
    $this->assertInstanceOf('Lesson001\Hitable', $this->soldier);
    $this->assertInstanceOf('Lesson001\ContinuousFire', $this->fire);
  }

  /** @depends test01 */
  public function test02() {
    $this->fire->willHit(Hitting::AIR);
    $this->soldier->hitBy($this->fire);
    $this->assertTrue($this->soldier->isAlive());
  }

  /** @depends test02 */
  public function test03() {
    $this->fire->willHit(Hitting::HEAD);
    $this->soldier->hitBy($this->fire);
    $this->assertFalse($this->soldier->isAlive());
  }

  /** @depends test03 */
  public function test04() {
    $this->fire
      ->willHit(Hitting::AIR)
      ->willHit(Hitting::HEAD);
    $this->assertSame(0, $this->fire->shotsFired());
    $this->assertFalse($this->fire->isDeadlyNow());
    $this->assertSame(1, $this->fire->shotsFired());
    $this->assertTrue($this->fire->isDeadlyNow());
    $this->assertSame(2, $this->fire->shotsFired());
  }

  /** @depends test04 */
  public function test05() {
    $fire = $this->getMock('Lesson001\FireImpl', ['isDeadlyNow']);
    $fire->expects($this->atLeastOnce())
      ->method('isDeadlyNow')
      ->will($this->returnCallback([$fire, 'parent::isDeadlyNow']));

    $fire
      ->willHit(Hitting::AIR)
      ->willHit(Hitting::HEAD)
      ->willHit(Hitting::AIR);
    $this->soldier->hitBy($fire);

    $this->assertFalse($this->soldier->isAlive());
    return $fire;
  }

  /** @depends test05 */
  public function test06(ContinuousFire $fire) {
    $this->assertSame(3, $fire->shotsFired());
    return $fire;
  }

  /** @depends test06 */
  public function test07(ContinuousFire $fire) {
    $fire->expects($this->atLeastOnce())
      ->method('isDeadlyNow')
      ->will($this->returnCallback([$fire, 'parent::isDeadlyNow']));
    $this->assertTrue($fire->isDeadly());
    $this->assertSame(3, $fire->shotsFired());
  }

}

