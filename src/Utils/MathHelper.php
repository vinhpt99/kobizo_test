<?php

namespace App\Utils;

class MathHelper
{
  public static function exerciseS1(array $arr): ?int {
    if (empty($arr)) {
      return null;
    }

    $max = $arr[0];
    $min = $arr[0];

    foreach ($arr as $num) {
      if ($num > $max) {
        $max = $num;
      }
      if ($num < $min) {
        $min = $num;
      }
    }

    return $max - $min;
  }

  public static function exerciseS2(int $n): int {
    $sum = 0;
    for ($i = 1; $i <= $n; $i++) {
      $sum = $sum + $i;
    }
    return $sum;
  }
}
