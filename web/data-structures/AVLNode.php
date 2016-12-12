<?php 

/**
* AVL Node model
*/
class AVLNode {
  public $data;
  public $parent;
  public $left;
  public $right;
  public $balance = 0;


  function __construct($parent, $data, $left, $right) {
    $this->parent = $parent;
    $this->data = $data;
    $this->left = $left;
    $this->right = $right;
  }

  // $node = AVLNode::withParentAndChildren($parent, $data, $left, $right);
  static function withParentAndChildren($parent, $data, $left, $right) {
    return new self($parent, $data, $left, $right);
  }

  static function withParent($parent, $data) {
    return new self($parent, $data, null, null);
  }

  static function withData($data) {
    return new self(null, $data, null, null);
  }


}




 ?>