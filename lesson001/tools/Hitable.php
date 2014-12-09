<?php

namespace Lesson001;

interface Hitable {
  public function hitBy(Killing $killing);
}
