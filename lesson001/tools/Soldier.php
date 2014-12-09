<?php

namespace Lesson001;

interface Soldier {
  /** @return boolean */
  public function isAlive();
  /** @return null */
  public function dieNow();
}

