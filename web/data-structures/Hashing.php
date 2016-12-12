<?php 
define('R', 0.618034);

class Hashing {

  static function convertKey($key) {
    $d = 0;
    for ($j=0; $j < min(strlen($key), 10); $j++) { 
      $d = $d * 27 + ord($key[$j]);
    }

    if ($d < 0) {
      $d = -$d;
    }

    return $d;
  }

  static function multiplyMethod($m, $x) {
    $d = R * $x - (floor(R * $x));
    $index = (int)($m * $d);
    return $index;
  }

}


 ?>