<?php

namespace Lesson001;

require_once __DIR__ .'/../../init.loader.php';

class Implement005Test extends \PHPUnit_Framework_TestCase {
  private $soldier;
  private $fire;
  private $random;
  private $builder;

  public function setUp() {
    if (
        !class_exists('Lesson001\SoldierImpl') ||
        !class_exists('Lesson001\FireImpl') ||
        !class_exists('Lesson001\RandomImpl') ||
        !class_exists('Lesson001\BuilderImpl')) {
      $this->markTestSkipped();
    }
    $this->soldier = new SoldierImpl();
    $this->fire = new FireImpl();
    $this->random = new RandomImpl();
    $this->builder = new BuilderImpl($this->random);
  }

  public function test01() {
    $this->assertInstanceOf('Lesson001\Hitable', $this->soldier);
    $this->assertInstanceOf('Lesson001\ContinuousFire', $this->fire);
    $this->assertInstanceOf('Lesson001\Random', $this->random);
    $this->assertInstanceOf('Lesson001\FireBuilder', $this->builder);
  }

  /** @depends test01 */
  public function test02() {
    $fire = $this->builder
      ->createRandomFire(4);
    $this->soldier->hitBy($fire);
    $this->assertSame(4, $fire->shotsFired());
    $this->assertTrue($this->soldier->isAlive());
  }

  /** @depends test02 */
  public function test03() {
    $fire = $this->builder
      ->createRandomFire(5);
    $this->soldier->hitBy($fire);
    $this->assertSame(5, $fire->shotsFired());
    $this->assertFalse($this->soldier->isAlive());
  }

}

