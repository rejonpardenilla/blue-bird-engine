<?php 
require_once 'Entry.php';
require_once 'Hashing.php';

class HashTable {
  public $array;
  public $maxSize;
  public $size;

  function __construct($maxSize) {
    $this->size = 0;
    $this->maxSize = $maxSize;
    $this->array = new SplFixedArray($maxSize);
    for ($i=0; $i < $maxSize; $i++) { 
      $this->array[$i] = null;
    }
  }

  function insert($key, $value) {
    $index = $this->hash($key);
    $this->array[$index] = new Entry($key, $value);
    $this->size++;

    return true;
  }

  function find($key) {
    $index = $this->hash($key);
    $item = $this->array[$index];

    if ($item != null) {
      return $item->value;
    } else {
      return null;
    }
  }

  function delete($key) {
    $index = $this->hash($key);
    $this->array[$index] = null;
    $this->size--;

    return true;
  }

  function hash($key) {
    $value = Hashing::convertKey($key);
    $index = Hashing::multiplyMethod($this->maxSize, $value);

    // Sondeo cuadrático
    $i = 0;
    while ($this->array[$index] != null && $this->array[$index]->key != $key) {
      $i++;
      $index = $index + ($i * $i);
      $index = $index % $this->maxSize;
    }

    return $index;
  }

}



 ?>