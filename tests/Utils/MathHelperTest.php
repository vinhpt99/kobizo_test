<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\MathHelper;

class MathHelperTest extends TestCase
{
  public function testCalculateS1() {
    $this->assertEquals(9, MathHelper::exerciseS1([1, 5, 10]));
    $this->assertEquals(0, MathHelper::exerciseS1([7, 7, 7]));
    $this->assertEquals(15, MathHelper::exerciseS1([-5, 0, 10]));
    $this->assertNull(MathHelper::exerciseS1([]));
  }

  public function testCalculateS2() {
    $this->assertEquals(10, MathHelper::exerciseS2(4));
    $this->assertEquals(55, MathHelper::exerciseS2(10));
    $this->assertEquals(1, MathHelper::exerciseS2(1));
    $this->assertEquals(0, MathHelper::exerciseS2(0));
  }
}
